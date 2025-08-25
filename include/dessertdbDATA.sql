-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 04:24 PM
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
-- Database: `dessertdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int(10) NOT NULL,
  `level_des` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `level_des`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `staff_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total`, `status`, `staff_id`) VALUES
(1, 2, '2025-06-22 17:01:52', 4.30, 'Completed', 1),
(2, 2, '2025-06-22 17:02:02', 3.50, 'Completed', 1),
(3, 5, '2025-06-22 17:10:57', 11.50, 'Completed', 2),
(4, 2, '2025-06-22 17:22:05', 7.20, 'Cancelled', 1),
(6, 5, '2025-06-25 08:32:48', 10.70, 'Cancelled', 2),
(7, 5, '2025-05-01 08:13:04', 22.80, 'Completed', 2),
(8, 5, '2025-05-04 08:13:52', 7.90, 'Completed', 2),
(9, 7, '2025-05-10 08:17:50', 11.50, 'Completed', 1),
(10, 7, '2025-05-13 08:19:44', 12.00, 'Completed', 2),
(11, 7, '2025-05-20 08:20:25', 17.50, 'Completed', 1),
(12, 5, '2025-07-02 08:24:18', 8.00, 'Completed', 2),
(13, 5, '2025-07-02 08:47:11', 14.40, 'Cancelled', 2),
(14, 8, '2025-07-02 09:16:41', 33.80, 'Completed', 2),
(15, 8, '2025-07-02 09:17:33', 6.80, 'Completed', 2),
(16, 9, '2025-07-02 09:20:42', 22.70, 'Completed', 4),
(17, 10, '2025-07-02 09:26:43', 8.40, 'Completed', 4),
(18, 5, '2025-07-09 20:11:55', 15.10, 'Completed', 1),
(19, 11, '2025-06-01 11:00:56', 26.20, 'Completed', 4),
(20, 11, '2025-06-02 14:03:38', 12.00, 'Completed', 2),
(21, 9, '2025-06-02 14:04:03', 16.80, 'Completed', 1),
(22, 9, '2025-05-05 14:04:22', 56.70, 'Completed', 4),
(23, 15, '2025-05-05 14:05:08', 20.10, 'Cancelled', 2),
(24, 15, '2025-05-08 15:18:00', 16.40, 'Cancelled', 4),
(25, 14, '2025-05-08 15:20:31', 7.40, 'Completed', 4),
(26, 14, '2025-05-08 15:36:34', 19.40, 'Completed', 4),
(27, 14, '2025-05-11 17:37:45', 11.00, 'Completed', 1),
(28, 5, '2025-05-15 16:40:24', 37.80, 'Completed', 1),
(29, 10, '2025-05-15 16:41:01', 7.80, 'Completed', 2),
(31, 12, '2025-05-15 12:43:56', 11.10, 'Completed', 4),
(32, 12, '2025-05-20 12:44:24', 12.20, 'Completed', 1),
(33, 13, '2025-05-20 12:44:52', 14.40, 'Completed', 4),
(34, 10, '2025-05-22 15:45:42', 11.90, 'Completed', 1),
(35, 15, '2025-05-22 15:46:12', 16.00, 'Completed', 4),
(36, 12, '2025-05-27 19:47:03', 11.10, 'Completed', 4),
(37, 11, '2025-05-31 16:46:39', 18.90, 'Completed', 1),
(38, 15, '2025-05-31 16:46:56', 18.90, 'Completed', 4),
(39, 7, '2025-07-10 09:24:46', 28.70, 'Pending', NULL),
(40, 5, '2025-07-10 10:40:35', 49.20, 'Completed', 1),
(41, 19, '2025-07-10 11:25:28', 18.90, 'Pending', NULL),
(42, 5, '2025-07-10 12:21:50', 4.00, 'Completed', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(2, 2, 1, 1, 3.50),
(3, 3, 1, 1, 3.50),
(4, 3, 4, 2, 4.00),
(5, 4, 2, 1, 3.00),
(8, 6, 2, 1, 3.00),
(9, 6, 6, 1, 3.90),
(10, 6, 3, 1, 3.80),
(11, 7, 1, 1, 18.90),
(12, 7, 6, 1, 3.90),
(13, 8, 8, 1, 3.60),
(15, 9, 4, 1, 4.00),
(16, 9, 8, 1, 3.60),
(17, 9, 6, 1, 3.90),
(18, 10, 4, 1, 4.00),
(19, 10, 7, 1, 4.20),
(20, 10, 3, 1, 3.80),
(21, 11, 2, 1, 3.00),
(22, 11, 5, 1, 3.70),
(23, 11, 8, 3, 3.60),
(24, 12, 9, 1, 4.10),
(25, 12, 6, 1, 3.90),
(26, 13, 2, 1, 3.00),
(27, 13, 3, 1, 3.80),
(28, 13, 6, 1, 3.90),
(29, 13, 5, 1, 3.70),
(31, 14, 2, 1, 3.00),
(32, 14, 1, 1, 18.90),
(33, 14, 3, 2, 3.80),
(34, 15, 2, 1, 3.00),
(35, 15, 3, 1, 3.80),
(36, 16, 3, 1, 3.80),
(37, 16, 1, 1, 18.90),
(39, 17, 9, 1, 4.10),
(40, 18, 3, 3, 3.80),
(41, 18, 5, 1, 3.70),
(42, 19, 1, 1, 18.90),
(43, 19, 5, 1, 3.70),
(44, 19, 8, 1, 3.60),
(45, 20, 6, 1, 3.90),
(46, 20, 4, 1, 4.00),
(47, 20, 9, 1, 4.10),
(48, 21, 4, 1, 4.00),
(49, 21, 3, 1, 3.80),
(50, 21, 2, 3, 3.00),
(51, 22, 1, 3, 18.90),
(52, 23, 7, 2, 4.20),
(53, 23, 6, 3, 3.90),
(54, 24, 7, 2, 4.20),
(55, 24, 4, 2, 4.00),
(56, 25, 5, 2, 3.70),
(57, 26, 4, 3, 4.00),
(58, 26, 5, 2, 3.70),
(59, 27, 5, 2, 3.70),
(60, 27, 8, 1, 3.60),
(61, 28, 1, 2, 18.90),
(62, 29, 6, 2, 3.90),
(64, 31, 5, 3, 3.70),
(65, 32, 9, 2, 4.10),
(66, 32, 4, 1, 4.00),
(67, 33, 6, 2, 3.90),
(68, 33, 2, 1, 3.00),
(69, 33, 8, 1, 3.60),
(70, 34, 6, 2, 3.90),
(71, 34, 9, 1, 4.10),
(72, 35, 6, 2, 3.90),
(73, 35, 4, 1, 4.00),
(74, 35, 7, 1, 4.20),
(75, 36, 5, 3, 3.70),
(76, 37, 6, 3, 3.90),
(77, 37, 8, 2, 3.60),
(78, 38, 1, 1, 18.90),
(79, 39, 1, 1, 18.90),
(80, 39, 2, 2, 3.00),
(81, 39, 3, 1, 3.80),
(82, 40, 1, 2, 18.90),
(83, 40, 3, 3, 3.80),
(84, 41, 1, 1, 18.90),
(85, 42, 4, 1, 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `image_url`, `price`) VALUES
(1, 'Cromboloni', 'product-1.jpg', 18.90),
(2, 'Vanilla Cupcake', 'product-2.jpg', 3.00),
(3, 'Strawberry Cupcake', 'product-3.jpg', 3.80),
(4, 'Red Velvet Cupcake', 'product-4.jpg', 4.00),
(5, 'Blueberry Cupcake', 'product-5.jpg', 3.70),
(6, 'Caramel Cupcake', 'product-6.jpg', 3.90),
(7, 'Mint Chocolate Cupcake', 'product-7.jpg', 4.20),
(8, 'Lemon Cupcake', 'product-8.jpg', 3.60),
(9, 'Coffee Cupcake', 'product-9.jpg', 4.10),
(12, 'chicken pie', 'product-12.jpg', 12.00),
(13, 'karipap', 'product-2.jpg', 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff_profile`
--

CREATE TABLE `staff_profile` (
  `staff_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_profile`
--

INSERT INTO `staff_profile` (`staff_id`, `user_id`) VALUES
(1, 3),
(2, 4),
(4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `level_id` int(10) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `telephone`, `password`, `level_id`, `fullName`, `email`) VALUES
(2, 'Admin', '0135031234', 'admin', 1, 'NURUL ALYA BINTI RUDUAN', 'nurul@gmail.com'),
(3, 'StaffSakinah', '0112347650', 'staff1', 3, 'SAKINAH BINTI AHMAD HIZLAN', 'sakinah@gmail.com'),
(4, 'StaffEliya', '0129855217', 'staff2', 3, 'ELIYA MAISARAH BINTI ELIAS', 'eliya@gmail.com'),
(5, 'User Aida', '0191789977', 'user1', 2, 'AIDA AFIQAH BINTI AMRAN', 'aida12@gmail.com'),
(7, 'User Ali', '0192688921', 'ali1', 2, 'ALI BIN KASSIM', 'ali@gmail.com'),
(8, 'StaffSarah', '019-453367', 'Sarah123', 3, 'SARAH BINTI MOHD ADAM', 'Sarah00@gmail.com'),
(9, 'Ahmad', '0116789556', 'ahmad678', 2, 'Ahmad Bin Zainol', 'ahmad@gmail.com'),
(10, 'Lily', '0128456799', 'Lily', 2, 'ADRIANA BINTI MUHAMMAD', 'Lily@gmail.com'),
(11, 'Abu', '0198765434', 'Abu', 2, 'Abu Bin Ramli', 'Abu@gmail.com'),
(12, 'Ramli', '0157835467', 'ramli', 2, 'Ramli Bin Rahmat', 'Ramli@gmail.com'),
(13, 'Sazali', '017683546', 'Sala12', 2, 'Sazali Bin Suzuli', 'Sazali@gmail.com'),
(14, 'Farah', '0116378846', 'Farah', 2, 'Farah Ain Binti Ahmad', 'Farah@gmail.com'),
(15, 'Aina', '0165437658', 'Aina', 2, 'Aina Abdul Binti Abdullah', 'Aina@gmail.com'),
(19, 'syhmaira', '0136136596', 'saujana', 2, 'ASIDYSHJDNDJ', 'saujana@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `orders_ibfk_1` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_details_ibfk_2` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `staff_profile`
--
ALTER TABLE `staff_profile`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff_profile`
--
ALTER TABLE `staff_profile`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_profile` (`staff_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_profile`
--
ALTER TABLE `staff_profile`
  ADD CONSTRAINT `staff_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`level_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
