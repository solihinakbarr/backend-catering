import express from "express";
import { getMenus, getMenuById } from "../controllers/MenuController.js";

const router = express.Router();

router.get("/menu", getMenus);
router.get("/menu/:id", getMenuById);

export default router;
