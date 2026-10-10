import { Router } from "express"
import { getAllProducts, getOneProduct, createProduct } from "../controllers/productController.js"

const router = Router()

router.get("/", getAllProducts);
router.get("/:id", getOneProduct);
router.post("/", createProduct)
// router.put("/:id", updateCategory);
// router.delete("/:id", deleteCategory);

export default router;