import pool from "../config/db.js";

// GET ALL DATA
// GET ONE DATA
// CREATE
// UPDATE
// DELETE

export const getAllCategories = async (req, res) => {
  try {
    const [categories] = await pool.query(
      "SELECT * FROM categories ORDER BY id ASC",
    );
    return res.status(200).json({
      status: true,
      total: categories.length,
      data: categories,
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: "Fail fetch user",
      error: error.message,
    });
  }
};

export const getOneCategory = async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    if (isNaN(id)) {
      return res.status(400).json({ status: false, message: "Not a Number" });
    }
    const [category] = await pool.query("SELECT * FROM categories WHERE id=?", [
      id,
    ]);
    if (category.length === 0) {
      return res
        .status(404)
        .json({ status: false, message: "There is No Data" });
    }
    return res.status(200).json({ status: true, data: category });
  } catch (error) {
    return res.status(500).json({ status: false, message: error.message });
  }
};

//CREATE
export const createCategory = async (req, res) => {
  try {
    const { name } = req.body;
    if (!name) {
      return res.status(400).json({
        status: false,
        message: "Name is required",
      });
    }
    const category = await pool.query(
      "INSERT INTO categories (name) VALUES (?)",
      [name],
    );
    return res.status(201).json({
      status: true,
      // data: category,
      message: "Insert is Successful",
    });
  } catch (error) {
    if (error.code === "ER_DUP_ENTRY") {
      return res.status(400).json({
        status: false,
        message: "Name is already exist",
      });
    }
    return res.status(500).json({
      status: false,
      message: error.message,
    });
  }
};

//UPDATE berdasarkan ID
export const updateCategory = async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    const { name } = req.body;

    if (isNaN(id)) {
      return res
        .status(400)
        .json({ status: false, message: "is not a number" });
    }
    await pool.query("UPDATE categories SET name=? WHERE id=?", [name, id]);
    //cek id ada apa enggak:
    const [categorySelect] = await pool.query(
      "SELECT id FROM categories WHERE id=?",
      [id],
    );
    if (categorySelect.length === 0) {
      return res
        .status(404)
        .json({ status: false, message: "Data is not Found" });
    }

    return res.status(200).json({
      status: true,
      message: "update success",
    });
  } catch (error) {
    return res.status(500).json({
      statsu: false,
      message: error.message,
    });
  }
};

// export const deleteCategory = async (req, res) => {
//   try {
//     const id = parseInt(req.params.id);

//     // 1. Cek terlebih dahulu apakah data yang akan dihapus ada di database
//     const [categorySelect] = await pool.query(
//       "SELECT id FROM categories WHERE id=?",
//       [id],
//     );

//     if (categorySelect.length === 0) {
//       return res
//         .status(404)
//         .json({ status: false, message: "Data is not Found" });
//     }
//     // 2. Jika data ditemukan, baru lakukan proses penghapusan
//     await pool.query("DELETE FROM categories WHERE id=?", [id]);
//     return res.status(200).json({
//       status: true,
//       message: "DELETE IS SUCCESS",
//     });
//   } catch (error) {
//     return res.status(500).json({
//       status: false,
//       message: error.message,
//     });
//   }
// };

// javascript: using affectedRows - lebih efisien
// Jika Anda menggunakan library MySQL modern (seperti mysql2), Anda sebenarnya tidak perlu melakukan SELECT terlebih dahulu.
// Anda bisa langsung mengecek properti affectedRows dari hasil query DELETE untuk mengetahui apakah ada baris yang terhapus:

export const deleteCategory = async (req, res) => {
  try {
    const id = parseInt(req.params.id);

    // Langsung hapus dan ambil informasi hasilnya
    const [result] = await pool.query("DELETE FROM categories WHERE id=?", [
      id,
    ]);

    // Jika tidak ada baris yang terpengaruh, berarti ID tidak ditemukan
    if (result.affectedRows === 0) {
      return res
        .status(404)
        .json({ status: false, message: "Data is not Found" });
    }

    return res.status(200).json({
      status: true,
      message: "DELETE IS SUCCESS",
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: error.message,
    });
  }
};
