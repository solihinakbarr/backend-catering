import { DataTypes } from "sequelize";
import db from "../config/database.js";

const Testimoni = db.define(
  "Testimoni",
  {
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    familyName: {
      type: DataTypes.STRING,
      allowNull: true,
    },
    content: {
      type: DataTypes.TEXT,
      allowNull: false,
    },
    rate: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
    created_at: {
      type: DataTypes.DATE,
      allowNull: false,
      defaultValue: DataTypes.NOW,
    },
  },
  {
    timestamps: false,
    tableName: "testimonis",
  }
);

export default Testimoni;
