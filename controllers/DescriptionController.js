import Description from "../models/DescriptionModel.js";

export const getDescriptionById = async (req, res) => {
  try {
    const response = await Description.findOne({
      where: {
        id: req.params.id,
      },
    });
    if (response) {
      res.status(200).json(response);
    } else {
      res.status(404).json({ message: "Description not found" });
    }
  } catch (error) {
    console.log(error.message);
    res.status(500).json({ message: error.message });
  }
};
