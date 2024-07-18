import Order from "../models/Order.js";
import Menu from "../models/MenuModel.js"; // Asumsi model Menu sudah dibuat

export const createOrder = async (req, res) => {
  const {
    menu_id,
    name,
    phone_number,
    address,
    start_date,
    end_date,
    quantity,
  } = req.body;

  try {
    const menu = await Menu.findByPk(menu_id);
    if (!menu) {
      return res.status(404).json({ message: "Menu not found" });
    }

    const total_price = menu.price * quantity;

    const order = await Order.create({
      menu_id,
      name,
      phone_number,
      address,
      start_date,
      end_date,
      quantity,
      total_price,
    });
    res.status(201).json(order);
  } catch (error) {
    res.status(500).json({ message: "Gagal membuat order", error });
  }
};
