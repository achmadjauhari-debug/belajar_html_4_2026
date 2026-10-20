import mysql from "mysql2/promise";
import dotenev from "dotenv";

//Process.DB_HOST

dotenev.config();

const pool = mysql.createPool({
  host: process.env.DB_HOST || "localhost",
  user: process.env.DB_USER || "root",
  password: process.env.DB_PASSWORD || "",
  database: process.env.DB_NAME,
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});

try {
  const connection = await pool.getConnection();
  console.log("✅ Database connection success via MySQL2 Pool!");
  connection.release();
} catch (error) {
  console.log("❌ Connection failed:", error.message);
}

export default pool;

// import { PrismaClient } from "./generated/prisma/index.js";

// const prisma = new PrismaClient({
//   log: ["query", "info", "warn", "error"],
// });

// export default prisma;
