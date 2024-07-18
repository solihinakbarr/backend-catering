import { DataTypes } from "sequelize";
import sequelize from "../config/database.js";

const Testimoni = sequelize.define(
  "testimoni",
  {
    id: {
      type: DataTypes.INTEGER,
      primaryKey: true,
      autoIncrement: true,
    },
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    rate: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
    content: {
      type: DataTypes.TEXT,
      allowNull: false,
    },

    familyName: {
      type: DataTypes.STRING,
      allowNull: false,
    },
  },
  {
    tableName: "testimoni",
    timestamps: false,
  }
);

export default Testimoni;
