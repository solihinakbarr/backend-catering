import express from "express";
import { getDescriptionById } from "../controllers/DescriptionController.js";

const router = express.Router();

router.get("/description/:id", getDescriptionById);

export default router;
