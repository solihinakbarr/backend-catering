import express from "express";
import {
  createTestimoni,
  getTestimonis,
  getTestimoniById,
} from "../controllers/TestimoniController.js";

const router = express.Router();

router.get("/testimonis", getTestimonis);
router.get("/testimoni/:id", getTestimoniById);
router.post("/testimonis", createTestimoni);

export default router;
