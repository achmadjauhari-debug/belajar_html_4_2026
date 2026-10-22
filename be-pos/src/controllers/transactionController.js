import pool from "../config/db.js";
import { snap } from "../config/midtrans.js";

export const createTransaction = async (req, res) => {
  // 1. 🟩 Ambil koneksi dari pool terlebih dahulu
  const connection = await pool.getConnection();

  try {
    // 2. 🟩 Jalankan beginTransaction setelah koneksi didapatkan

    await connection.beginTransaction();

    const {
      user_id,
      payment_method,
      subtotal,
      tax,
      total,
      items = [],
      pay = 0,
    } = req.body;

    const userId = req.user?.id || req.user?.user_id || req.user?.userId || 1;

    const isMidtrans =
      String(payment_method) === "1" || payment_method === "midtrans";
    let change = 0;
    let status = "pending";
    let cashReceive = 0;

    if (payment_method === 2) {
      cashReceive = Number(pay);
      if (cashReceive < Number(total)) {
        await connection.rollback();
        return res.status(400).json({
          status: false,
          message: "Cash less than the total",
        });
      }
      change = cashReceive - Number(total);
      status = "settlement";
    }

    const orderNumber = await generateOrderNumber(connection);
    console.log("Order baru berhasil dibuat:", orderNumber);

    const [transaction] = await connection.query(
      "INSERT INTO orders (order_number, user_id, payment_method, subtotal, tax, total, pay, status) VALUES (?,?,?,?,?,?,?,?)",
      [
        orderNumber,
        userId,
        payment_method,
        subtotal,
        tax,
        total,
        cashReceive,
        status,
      ],
    );

    const orderId = transaction.insertId;

    if (items && items.length) {
      for (const item of items) {
        await connection.query(
          "INSERT INTO order_details (order_id, product_id, qty, price) VALUES (?,?,?,?)",
          [orderId, item.product_id, item.qty, item.price],
        );
      }
    }
    let midtransResponse = null;
    if (Number(payment_method) === 1) {
      const parameter = {
        // cari di docnya midtrans

        transaction_details: {
          // 🟩 TAMBAHKAN `-${Date.now()}` agar nomor order_id selalu unik dan tidak pernah bentrok di Midtrans
          order_id: `${orderNumber}-${Date.now()}`,
          gross_amount: Number(total),
        },
        callbacks: {
          finish: "http://localhost:5173/transaction/print",
        },

        enable_payments: ["gopay", "qris"],
        item_details: [
          ...items.map((item) => ({
            id: String(item.product_id),
            price: Number(item.price),
            quantity: Number(item.qty),
            name: `Product ID ${item.product_id}`,
          })),
          {
            id: "TAX-10",
            price: Number(tax), // 🟩 Masukkan Pajak sebagai item terpisah agar hitungan item_details MATCH dengan gross_amount (total)
            quantity: 1,
            name: "Tax (10%)",
          },
        ],
      };
      console.log(
        "Parameter dikirim ke midtrans snap :",
        JSON.stringify(parameter, null, 2),
      );
      midtransResponse = await snap.createTransaction(parameter);
    }
    await connection.commit();
    // connection.release();
    return res.status(201).json({
      status: true,
      message:
        Number(payment_method) === 1
          ? "Order berhasil silahkan bayar dengan Gopay"
          : "Payment cash berhasil",
      order_id: orderId,
      order_number: orderNumber,
      payment_details:
        payment_method === 2
          ? {
              total: Number(total),
              cashReceive: cashReceive,
              change: change,
            }
          : null,
      payment_gateway: midtransResponse
        ? {
            token: midtransResponse.token,
            redirect_url: midtransResponse.redirect_url,
          }
        : null,
    });
  } catch (error) {
    console.error("createTransaction error:", error);
    await connection.rollback();
    return res.status(500).json({ status: false, message: "Create is Failed" });
  } finally {
    connection.release();
  }
};

// GET ALL TRANSACTION
export const getAllTransaction = async (req, res) => {
  try {
    const [rows] = await pool.query(`SELECT
        orders.id,
        orders.order_number,
        orders.payment_method,
        orders.total, 
        order_details.product_id,
        products.name
        FROM orders
        LEFT JOIN order_details ON orders.id = order_details.order_id
        LEFT JOIN products ON order_details.product_id = products.id ORDER BY orders.id DESC`);

    const orderMap = {};
    rows.forEach((row) => {
      if (!orderMap[row.id]) {
        orderMap[row.id] = {
          id: row.id,
          order_number: row.order_number,
          payment_method: row.payment_method,
          total: row.total,
          items: [],
        };
      }
      if (row.product_id) {
        orderMap[row.id].items.push({
          product_id: row.product_id,
          name: row.name,
        });
      }
    });
    const orders = Object.values(orderMap);
    return res.status(200).json({
      status: true,
      data: orders,
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: error.message,
    });
  }
};

// GET TRANSACTION BY ID
export const getTransactionById = async (req, res) => {
  try {
    const { id } = req.params; // Ambil parameter dari URL
    let queryTarget = String(id).trim();

    // 🟩 Debugging: Lihat format ID asli yang dikirim dari React frontend
    console.log("Nomor Order masuk dari frontend:", queryTarget);

    // 1. 🟩 Pembersihan Timestamp Midtrans Callback (TR-XXXX-XXXX-TIMESTAMP)
    // Mencari posisi tanda hubung (-) terakhir untuk mendeteksi ID unik panjang dari Midtrans
    if (queryTarget.includes("-")) {
      const parts = queryTarget.split("-");
      // Format order_number dari generateOrderNumber biasanya memiliki 3 bagian: TR - YYYYMMDD - NNNN
      // Jika digabung dengan timestamp Midtrans, panjang array parts akan menjadi 4 atau lebih.
      if (parts.length >= 4) {
        // Ambil kembali bagian nota bersih (Indeks 0, 1, dan 2)
        queryTarget = `${parts[0]}-${parts[1]}-${parts[2]}`;
      }
    }
    // 2. 🟩 Cek apakah parameter murni Angka (Primary Key ID database) atau String (Order Number)
    // Menggunakan Number.isInteger untuk menghindari bug penulisan regex yang bocor
    const isParamNumeric =
      !isNaN(queryTarget) && Number.isInteger(Number(queryTarget));

    console.log(
      `Mencari Transaksi berdasarkan Kolom [${isParamNumeric ? "id" : "order_number"}]: "${queryTarget}"`,
    );

    // 2. Tentukan Query SQL secara dinamis berdasarkan jenis parameter yang masuk
    const sqlQuery = `
      SELECT
        orders.id AS order_id_key,
        orders.order_number,
        orders.user_id,
        orders.payment_method,
        orders.subtotal,
        orders.total,
        orders.tax,
        orders.pay,
        orders.status, 
        orders.created_at,
        order_details.product_id,
        order_details.qty,
        order_details.price,
        products.name
      FROM orders
      LEFT JOIN order_details ON orders.id = order_details.order_id
      LEFT JOIN products ON order_details.product_id = products.id 
      WHERE ${isParamNumeric ? "orders.id = ?" : "orders.order_number = ?"}`;

    // 2. 🟩 Jalankan Query ke Database
    const [rows] = await pool.query(sqlQuery, [queryTarget]);

    // 3. 🟩 Validasi eksistensi baris data array hasil database
    if (!rows || rows.length === 0)
      return res.status(404).json({
        status: false,
        message: `Transaction data not found for identifier: ${queryTarget}`,
      });

    // 4. 🟩 Mapping data induk transaksi menggunakan baris indeks pertama [0]
    const firstRow = rows[0];
    const transaction = {
      id: firstRow.order_id_key,
      order_number: firstRow.order_number,
      created_at: firstRow.created_at,
      user_id: firstRow.user_id,
      payment_method: firstRow.payment_method,
      subtotal: firstRow.subtotal,
      total: firstRow.total,
      tax: firstRow.tax,
      pay: firstRow.pay,
      status: firstRow.status,
      items: [],
    };

    // 5. 🟩 GABUNGKAN RINCIAN PRODUK BELANJA DARI SELURUH BARIS JOIN DATABASE
    rows.forEach((row) => {
      if (row.product_id) {
        transaction.items.push({
          product_id: row.product_id,
          name: row.name,
          qty: row.qty,
          price: row.price,
        });
      }
    });

    // 6. 🟩 KIRIM RESPONS SUKSES UTUH KE FRONTEND REACT
    return res.status(200).json({
      status: true,
      message: "Fetch transaction data successful",
      data: transaction,
    });

  } catch (error) {
    console.error("Error di getTransactionById:", error);
    return res.status(500).json({
      status: false,
      message: error.message,
    });
  }
};


// GENERATE ORDER NUMBER AUTOMATICALLY
const generateOrderNumber = async (connection) => {
  // Format target: TR-20261019-
  const now = new Date();
  const year = now.getFullYear();

  // JavaScript month dimulai dari 0 (Januari = 0), jadi wajib ditambah 1
  const month = String(now.getMonth() + 1).padStart(2, "0");
  const date = String(now.getDate()).padStart(2, "0");

  // 🟩 Gunakan pemisah '-' agar terbaca rapi oleh sistem Midtrans
  const prefix = `TR-${year}${month}${date}-`;

  //QUERY
  const [lastOrder] = await connection.query(
    "SELECT order_number FROM orders WHERE order_number LIKE ? ORDER BY id DESC",
    [`${prefix}%`],
  );

  let nextNumber = 1;
  if (lastOrder.length > 0) {
    const lastNumberStr = lastOrder[0].order_number;
    const parts = lastNumberStr.split("-");

    // Mengambil digit urutan paling belakang (index ke-2)
    const currentNumber = parseInt(parts[2], 10);
    if (!isNaN(currentNumber)) {
      nextNumber = currentNumber + 1;
    }
  }

  // Menghasilkan format akhir seperti: TR-20261019-0001
  return `${prefix}${String(nextNumber).padStart(4, "0")}`;
};

export const deleteTransaction = async (req, res) => {
  try {
    const id = parseInt(req.params.id);

    await pool.query("DELETE FROM orders WHERE id=?", [id]);
    return res.status(200).json({
      status: true,
      message: "Delete is Success",
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: error.message,
    });
  }
};
