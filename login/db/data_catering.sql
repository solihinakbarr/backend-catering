-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 06:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `min_order` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `detail` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `min_order`, `unit`, `price`, `description`, `detail`, `image`) VALUES
(1, 'Paket Weddings', 100, 'Porsi', 10000, 'Paket yang cocok untuk pernikahan dengan hidangan lezat dan bervariasi.', 'Paket ini sudah berisikan nasi, ayam, sambal, kerupuk, sayur, dan satu air mineral.', '6679a44bf2d5a.jpg'),
(2, 'Paket Arisan', 20, 'Porsi', 50000, 'Paket yang cocok untuk arisan dengan pilihan hidangan yang menggugah selera.', 'Paket ini sudah berisikan nasi, ikan bakar, sambal, lalapan, kerupuk, dan satu air mineral.', '6679a461152a2.jpg'),
(3, 'Paket Ulang Tahun', 20, 'Porsi', 10000, 'Paket yang pas untuk ulang tahun dengan menu-menu favorit anak-anak.', 'Paket ini sudah berisikan nasi, nugget, sosis, kentang goreng, dan jus buah.', '6679a47630342.jpg'),
(4, 'Paket Corporate', 40, 'Porsi', 20000, 'Paket yang ideal untuk acara kantor dengan hidangan yang praktis dan lezat.', 'Paket ini sudah berisikan nasi, daging sapi, sayur, sambal, kerupuk, dan satu air mineral.', '6679a4818e379.jpg'),
(5, 'Paket Khitan', 50, 'Porsi', 20000, 'Paket spesial untuk acara khitanan dengan berbagai macam hidangan.', 'Paket ini sudah berisikan nasi, ayam goreng, sayur, sambal, kerupuk, dan satu air mineral.', '6679a48e783f5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` enum('Pending','Proses','Done') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `phone_number`, `address`, `start_date`, `end_date`, `menu_id`, `quantity`, `total_price`, `status`, `created_at`) VALUES
(1, 'John Doe', '08123456789', 'Jl. Kebon Jeruk No. 15', '2024-07-01', '2024-07-10', 1, 2, 0, 'Done', '2024-06-22 19:09:53'),
(2, 'Jane Smith', '08123456780', 'Jl. Kebon Mawar No. 20', '2024-06-26', '2024-06-28', 2, 3, 0, 'Done', '2024-06-24 03:16:32'),
(3, 'Alex Johnson', '08123456781', 'Jl. Kebon Melati No. 30', '2024-07-05', '2024-07-06', 3, 2, 0, 'Done', '2024-06-24 04:16:32'),
(4, 'Emily Davis', '08123456782', 'Jl. Kebon Anggrek No. 40', '2024-07-10', '2024-07-12', 4, 4, 0, 'Done', '2024-06-24 05:16:32'),
(5, 'Michael Brown', '08123456783', 'Jl. Kebon Melur No. 50', '2024-07-15', '2024-07-16', 5, 2, 500000, 'Done', '2024-06-24 06:16:32'),
(11, 'Aisyah', '08123456780', 'Jl. Anggrek No. 12', '2024-07-01', '2024-07-01', 2, 2, 100000, 'Done', '2024-06-25 01:16:32'),
(12, 'Bagas', '08123456781', 'Jl. Mawar No. 10', '2024-07-02', '2024-07-02', 1, 3, 0, 'Proses', '2024-06-25 01:16:32'),
(13, 'Adi', '08123456782', 'Jl. Melati No. 8', '2024-07-03', '2024-07-03', 3, 2, 0, 'Proses', '2024-06-25 01:16:32'),
(26, 'Dhani', '08971267513', 'Jalanjadjahdjajdb', '2024-06-29', '2024-06-30', 1, 100, 1000000, 'Done', '2024-06-28 16:32:18'),
(27, 'Aku', '0891289182918', 'asndjanskjdan', '2024-06-29', '2024-06-30', 4, 50, 1000000, 'Done', '2024-06-28 16:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `familyName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `name`, `rate`, `content`, `familyName`) VALUES
(1, 'Fajar', 5, 'Makanannya enak dan pengirimannya tepat waktu.', 'Fajar Family'),
(2, 'Gina', 4, 'Layanan memuaskan dan rasa makanan oke.', 'Gina Family'),
(3, 'James', 5, 'Sangat direkomendasikan untuk acara besar.', 'James Family'),
(4, 'Ika', 3, 'Rasa makanan cukup baik, pengiriman agak terlambat.', 'Ika Family'),
(5, 'Michael', 4, 'Harga sesuai dengan kualitas makanan yang diberikan.', 'Michael Family'),
(7, 'Aisyah', 5, 'Pelayanan sangat memuaskan, makanan enak.', 'Aisyah Family'),
(8, 'Bagas', 4, 'Layanan memuaskan dan makanan lezat.', 'Bagas Family'),
(9, 'Adi', 5, 'Sangat direkomendasikan untuk acara besar.', 'Adi Family'),
(10, 'Rina', 3, 'Rasa makanan cukup baik, pengiriman agak terlambat.', 'Rina Family'),
(11, 'Wulan', 4, 'Harga sesuai dengan kualitas makanan yang diberikan.', 'Wulan Family'),
(12, 'saya ', 2, 'jasndjkandknad', 'jasjkajk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@example.com', '0192023a7bbd73250516f069df18b500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
