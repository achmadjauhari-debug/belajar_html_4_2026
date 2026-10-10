import pool from "../config/db.js";

const USERS = [
  {
    id: 1,
    name: "Reza",
    email: "admin@gmail.com",
    password: "12345678",
  },
  {
    id: 2,
    name: "Ratna",
    email: "ratna@gmail.com",
    password: "12345678",
  },
  {
    id: 3,
    name: "Laras",
    email: "laras@gmail.com",
    password: "12345678",
  },
];

// crud (create read update delete)

//read
export const getAllUser = async (req, res) => {
  try {
    const [rows] = await pool.query(
      //row di destruct [] biat gak banyak array yg keluar
      "SELECT id, name, email, is_Active FROM users",
    );
    return res.status(200).json({
      status: true,
      message: "Fetch user success",
      total: rows.length,
      data: rows,
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: "Fail fetch user",
      error: error.message,
    });
  }
};

// export const getUserById = async (req, res) => {
//   const { id } = req.params;
//   try {
//     const [rows] = await pool.query(
//       "SELECT id, name, email, is_Active FROM users where id =?, [id] ",
//     );
//     if (rows.length === 0) {

//       return res.status(400).json({
//         status: false,
//         message: "User not found",
//         total: rows.length,
//         data: rows,
//     }
//     });
//   } catch (error) {
//     return res.status(404).json({
//       status: false,
//       message: "User not found",
//     });
//   }

//   res.status(200).json({
//     status: true,
//     message: "User found",
//     data: user,
//   });
// };

export const getUserById = async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    //find
    const [user] = await pool.query(
      "SELECT id, name, email, is_Active FROM users where id=?",
      [id],
    );
    if (!user) {
      res.status(404).json({
        status: false,
        message: "User not found",
      });
    }
    res.status(200).json({
      status: true,
      message: "User found",
      data: user,
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: "Fail fetch user",
      error: error.message,
    });
  }
};
// const id = parseInt(req.params.id);
// find
//   const user = await pool.query("SELECT id, name, email, is_Active FROM users where id=?, [id]");
//   if (!user) {
//     res.status(404).json({
//       status: false,
//       message: "User not found",
//     });
//   }

//   res.status(200).json({
//     status: true,
//     message: "User found",
//     data: user,
//   });
// };

export const createUser = async (req, res) => {
  const { name, email, password } = req.body;

  try {
    const [user] = await pool.query(
      "INSERT INTO USERS(name,email,password) VALUES (?,?,?)",
      [name, email, password],
    );

    return res.status(201).json({
      status: true,
      message: "Create user success",
      data: { id: user.insertId, name, email },
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: "Create user failed",
      error: error.message,
    });
  }
};

export const updateUser = async (req, res) => {
  const id = parseInt(req.params.id);
  const { name, email, password } = req.body;
  try {
    const [user] = await pool.query(
      "UPDATE users SET name=?, email=?, password=? WHERE id=?",
      [name, email, password, id],
    );

    return res.status(200).json({
      status: true,
      message: "Update user success",
      data: { id, name, email },
    });
  } catch (error) {}
};

export const deleteUser = async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    // if (!id) {
    //   return res.status(404).jsonm({
    //     status: false,
    //     message: "Not Found"
    //   })
    // }

    await pool.query("DELETE FROM users WHERE id=?", [id]);
    //tidak pakai const [user] karena cuma delete berdasarkan id

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

// const userIndex = USERS.findIndex((u) => u.id === id);

// if (userIndex === -1) {
//   return res.status(404).json({
//     status: false,
//     message: "User not found",
//   });
// }

// const deletedUser = USERS.splice(userIndex, 1)[0];
// return res.status(200).json({
//   status: true,
//   message: "Delete user success",
// });
