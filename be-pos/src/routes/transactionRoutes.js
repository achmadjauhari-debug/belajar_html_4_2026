import { verifyToken } from "../middlewares/middleware.js";
import { Router } from "express"
import { createTransaction, getAllTransaction, deleteTransaction } from "../controllers/transactionController.js"

const router = Router()
router.use(verifyToken);

router.post("/", createTransaction)
router.get("/", getAllTransaction)
router.delete("/:id", deleteTransaction);

export default router