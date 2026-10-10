import pool from "../config/db.js";

//get all
export const getAllProducts = async (req, res) => {
  const [products] = await pool.query(
    "SELECT products.*, categories.name AS category_namezzzxx FROM products LEFT JOIN categories ON products.category_id=categories.id",
  );
  return res.status(200).json({
    status: true,
    total: products.length,
    data: products,
  });
};

//get one data
export const getOneProduct = async (req, res) => {
  const id = parseInt(req.params.id);
  const [product] = await pool.query(
    "SELECT products.*, categories.name AS category_namezzzxx FROM products LEFT JOIN categories ON products.category_id=categories.id where products.id=?",
    [id],
  );
  return res.status(200).json({
    status: true,
    total: product.length,
    data: product,
  });
};
//create
export const createProduct = async (req, res) => {
  try {
    const { id, category_id, name, price, stock, description, is_Active } = req.body;
    if (!name) {
      return res.status(400).json({
        status: false,
        message: "Name is required",
      });
    }
    const category = await pool.query(
      "INSERT INTO products(id,category_id,name,price,stock,description, is_Active) VALUES (?,?,?,?,?,?,?)",
      [id, category_id, name, price, stock, description, is_Active],
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

//update
//delete
