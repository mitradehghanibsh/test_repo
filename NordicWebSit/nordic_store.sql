-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2026 at 07:14 PM
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
-- Database: `nordic_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `order_date`) VALUES
(9, 1, 895.50, '2026-02-19 16:52:54'),
(10, 3, 195.50, '2026-02-19 17:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(29, 9, 4, 1, 250.00),
(30, 9, 1, 5, 120.00),
(31, 9, 2, 1, 45.50),
(32, 10, 1, 1, 120.00),
(33, 10, 2, 1, 45.50),
(34, 10, 3, 1, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(1, 'Artek Chair', 'Classic Finnish chair, perfect for any room.', 120.00, 'artek44.jpg', '2026-02-19 10:03:16'),
(2, 'Iittala Glass', 'Hand-blown glassware from Iittala.', 45.50, 'marimekko4dl.jpg', '2026-02-19 10:03:16'),
(3, 'Marimekko Plate', 'Bold patterned plate for everyday use.', 30.00, 'marimekko.jpg', '2026-02-19 10:03:16'),
(4, 'Nanny Still Glass', 'Colorful Finnish art glass', 250.00, 'nannystill001.jpg', '2026-02-19 10:03:16'),
(5, 'Artek Chair', 'Classic Finnish wooden chair', 450.00, 'artek44.jpg', '2026-02-19 15:53:55'),
(6, 'Iittala Vase', 'Hand-blown glass masterpiece', 120.00, 'iittala16.jpg', '2026-02-19 15:53:55'),
(7, 'Marimekko Plate', 'Bold Nordic pattern tableware', 35.00, 'marimekko4dl.jpg', '2026-02-19 15:53:55'),
(8, 'Nanny Still Glass', 'Colorful Finnish art glass', 200.00, 'nannystill001.jpg', '2026-02-19 15:53:55'),
(9, 'Alvar Aalto Lamp', 'Iconic Scandinavian design lamp', 180.00, 'aalto_lamp.jpg', '2026-02-19 15:53:55'),
(10, 'Finlayson Towel', 'Soft cotton Finnish towel', 25.00, 'finlayson_towel.jpg', '2026-02-19 15:53:55'),
(11, 'Arabia Mug', 'Ceramic mug with minimalist design', 22.00, 'arabia_mug.jpg', '2026-02-19 15:53:55'),
(12, 'Pentik Bowl', 'Handcrafted ceramic bowl', 55.00, 'pentik_bowl.jpg', '2026-02-19 15:53:55'),
(13, 'Fiskars Scissors', 'Ergonomic design kitchen scissors', 15.00, 'fiskars_scissors.jpg', '2026-02-19 15:53:55'),
(14, 'Iittala Glass Set', 'Set of 4 drinking glasses', 80.00, 'iittala_glassset.jpg', '2026-02-19 15:53:55'),
(15, 'Marimekko Cushion', 'Decorative cushion with vibrant pattern', 60.00, 'marimekko_cushion.jpg', '2026-02-19 15:53:55'),
(16, 'Artek Stool', 'Minimalist wooden stool', 200.00, 'stool.jpg', '2026-02-19 15:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'mitra', 'mitra@gmail.com', '$2y$10$d2tuaWH3ZpGCGJStxd.ZcebW6ooAY7frBcQ.J8/Tv/wuLBcUVSN/.', '2026-02-19 09:46:41'),
(2, 'necky', 'neky@gmail.com', '$2y$10$aizUNZx9.r6TlX/L/Yd5bu.9UgXVId5zYuwcTCySYjzcAnrWCwiJC', '2026-02-19 10:08:33'),
(3, 'mehrsam', 'mehrsam@gmail.com', '$2y$10$1Xm/NgYGXVdLC3i9fDujFumVucmzp9iFVpxj1pM4py3m7hiNF6vA.', '2026-02-19 10:48:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
