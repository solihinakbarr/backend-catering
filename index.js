import express from "express";
import cors from "cors";
import bodyParser from "body-parser";
import MenuRoute from "./routes/MenuRoute.js";
import DescriptionRoutes from "./routes/DescriptionRoutes.js";
import testimoniRoutes from "./routes/TestimoniRoute.js";
import orderRoutes from "./routes/orderRoutes.js";

const app = express();

app.use(cors());
app.use(express.json());
app.use(bodyParser.json());
app.use(express.urlencoded({ extended: true }));
app.use("/images", express.static("public/images"));

app.use("/api", MenuRoute);
app.use("/api", DescriptionRoutes);
app.use("/api", testimoniRoutes);
app.use("/api", orderRoutes);

app.listen(5000, () => console.log("Server up and running..."));
