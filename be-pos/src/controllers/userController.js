import pool from "../config/db.js";
import prisma from "../config/prisma.js";
import bcrypt from "bcrypt";

// const USERS = [
//   {
//     id: 1,
//     name: "Reza",
//     email: "admin@gmail.com",
//     password: "12345678",
//   },
//   {
//     id: 2,
//     name: "Ratna",
//     email: "ratna@gmail.com",
//     password: "12345678",
//   },
//   {
//     id: 3,
//     name: "Laras",
//     email: "laras@gmail.com",
//     password: "12345678",
//   },
// ];

// crud (create read update delete)

//read

export const getAllUser = async (req, res) => {
  try {
    const users = await prisma.user.findMany({
      select: {
        id: true,
        name: true,
        email: true,
        created_at: true,
        updated_at: true,
      },
      orderBy: { id: "desc" },
    });

    //KODE PAKAI mysql2
    // const [rows] = await pool.query(
    //   //row di destruct [] biat gak banyak array yg keluar
    //   "SELECT id, name, email, is_Active FROM users",
    // );

    return res.status(200).json({
      status: true,
      message: "Fetch user success",
      total: users.length,
      data: users,
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

//GET USER BY ID
export const getUserById = async (req, res) => {
  try {
    const id = parseInt(req.params.id);

    // const [user] = await pool.query(
    //   "SELECT id, name, email, is_Active FROM users where id=?",
    //   [id],
    // );

    const user = await prisma.user.findUnique({
      where: { id: id },
    });

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

//CREATE USER

export const createUser = async (req, res) => {
  const { name, email, password } = req.body;

  try {
    // Hash password sebelum disimpan ke database
    const hashedPassword = await bcrypt.hash(password, 10);

    const user = await prisma.user.create({
      data: {
        name,
        email,
        password: hashedPassword,
      },
      select: {
        id: true,
        name: true,
        email: true,
        created_at: true,
      },
    });

    // const [user] = await pool.query(
    //   "INSERT INTO USERS(name,email,password) VALUES (?,?,?)",
    //   [name, email, password],
    // );

    return res.status(201).json({
      status: true,
      message: "Create user success",
      data: user,
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
  try {
    const id = parseInt(req.params.id);
    const { name, email, password, is_Active } = req.body;
    let update = "";

    const dataUpdate = {};
    if (email) dataUpdate.email = email;
    if (name) dataUpdate.name = name;
    if (password) {
      dataUpdate.password = await bcrypt.hash(password, 10);
    }

    const user = await prisma.user.update({
      where: {id: id},
      data: dataUpdate,
      select: {
        id: true,
        name: true,
        email: true,
        created_at: true,
        updated_at: true,
      }
    })

    // if (!password) {
    //   update = await pool.query(
    //     "UPDATE users SET name=?, email=?, is_Active=? WHERE id=?",
    //     [name, email, is_Active, id],
    //   );
    // } else {
    //   update = pool.query(
    //     "UPDATE users SET name=?, email=?, password=?, is_Active=? WHERE id=?",
    //     [name, email, password, is_Active, id],
    //   );
    // }
    // const [data] = await pool.query("SELECT * FROM user WHERE is = ?", [id]);

    return res.status(200).json({
      status: true,
      message: "User updated successfully!",
      data: user,
    });
  } catch (error) {
    return res.status(500).json({
      status: false,
      message: error.message,
    });
  }
};

// DELETE USER

export const deleteUser = async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    // if (!id) {
    //   return res.status(404).jsonm({
    //     status: false,
    //     message: "Not Found"
    //   })
    // }

    // await pool.query("DELETE FROM users WHERE id=?", [id]);
    //tidak pakai const [user] karena cuma delete berdasarkan id

    await prisma.user.delete({
      where: { id: id },
    });

    return res.status(200).json({
      status: true,
      message: "User deletion successful",
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
