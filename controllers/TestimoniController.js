import Testimoni from "../models/TestimoniModel.js";

export const getTestimonis = async (req, res) => {
  try {
    const testimonis = await Testimoni.findAll();
    res.status(200).json(testimonis);
  } catch (error) {
    console.error("Error fetching testimonis:", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
};

export const getTestimoniById = async (req, res) => {
  const { id } = req.params;
  try {
    const testimoni = await Testimoni.findByPk(id);
    if (!testimoni) {
      return res.status(404).json({ message: "Testimoni not found" });
    }
    res.status(200).json(testimoni);
  } catch (error) {
    console.error("Error fetching testimoni:", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
};

export const createTestimoni = async (req, res) => {
  const { name, familyName, content, rate } = req.body;
  try {
    const testimoni = await Testimoni.create({
      name,
      familyName,
      content,
      rate,
    });
    res.status(201).json(testimoni);
  } catch (error) {
    res.status(500).json({ message: "Gagal membuat testimoni", error });
  }
};
