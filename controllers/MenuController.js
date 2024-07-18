import Menu from "../models/MenuModel.js";
import path from "path";
import fs from "fs";

export const getMenus = async (req, res) => {
  try {
    const response = await Menu.findAll();
    res.status(200).json(response);
  } catch (error) {
    console.log(error.message);
    res.status(500).json({ message: "Internal Server Error" });
  }
};

export const getMenuById = async (req, res) => {
  try {
    const response = await Menu.findOne({
      where: {
        id: req.params.id,
      },
    });
    if (!response) {
      return res.status(404).json({ message: "Menu not found" });
    }
    res.status(200).json(response);
  } catch (error) {
    console.error("Error fetching menu by ID:", error);
    res.status(500).json({ message: "Internal Server Error" });
  }
};
