import { verifyToken } from "../middlewares/middleware.js";
import { Router } from "express"
import { createTransaction, getAllTransaction, getTransactionById, deleteTransaction } from "../controllers/transactionController.js"

const router = Router()
router.use(verifyToken);

router.post("/", createTransaction)
router.get("/", getAllTransaction)
router.get("/:id", getTransactionById)
router.delete("/:id", deleteTransaction);

export default router