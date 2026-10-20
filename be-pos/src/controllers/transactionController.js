import pool from "../config/db.js";
import { snap } from "../config/midtrans.js";

export const createTransaction = async (req, res) => {
  // 1. 🟩 Ambil koneksi dari pool terlebih dahulu
  const connection = await pool.getConnection();

  try {
    // 2. 🟩 Jalankan beginTransaction setelah koneksi didapatkan
    await connection.beginTransaction();
    const {
      order_number,
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
    console.log(req.user);
    console.log("order number", orderNumber);

    const [transaction] = await connection.query(
      "INSERT INTO orders (order_number, user_id, payment_method, subtotal, tax, total, pay, status) VALUES (?,?,?,?,?,?,?,?)",
      [orderNumber, userId, payment_method, subtotal, tax, total, pay, status],
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
          order_id: orderNumber,
          gross_amount: subtotal,
        },
        enable_payments: ["gopay"],
        item_details: items.map((item) => ({
          id: item.product_id,
          price: item.price,
          quantity: item.qty,
          name: `Product ID ${item.product_id}`,
        })),
      };
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

export const getAllTransaction = async (req, res) => {
  try {
    const [rows] = await pool.query(`SELECT
        orders.id,
        orders.order_number,
        orders.payment_method, 
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

//bikin nomor urut
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
