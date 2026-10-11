-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2026 at 09:14 AM
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
-- Database: `php`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pname` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `pname`, `category`, `price`, `quantity`, `description`) VALUES
(1, NULL, 'chochlate', 'dairy', 100, '1', 'buy 1 get 1 free'),
(2, NULL, 'curd', 'dairy', 230, '2', 'curd is nutricious for health!!!'),
(3, NULL, 'milk', 'dairy', 300, '4', 'amul doodh pita he india!!!'),
(4, 2, 'oil', 'grocery', 100, '2', 'buy 1 get 1 free'),
(5, 2, 'chochlate', 'dairy', 100, '2', 'buy 1 get 1 free'),
(6, 1, 'oil', 'grocery', 100, '56', 'but 1 get 1 free');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `email`, `phone`, `username`, `password`) VALUES
(1, 'Gauri', 'sonavanepoonam30@gmail.com', 2147483647, 'gauri', '$2y$10$HUGyohKAIUrcYVvL7KgJFOPdwQvb7LiCl92wO/wTYyMG9K41ShjKu'),
(2, 'Poonam Sonavane', 'sonavanepoonam30@gmail.com', 2147483647, 'poonam', '$2y$10$J1z2VRGz0cZ0QAifrJ7wY.m/f.4X4LotOJjdodHf/ppUfaEPWkUl2'),
(3, 'Gauring', 'guagd', 2147483647, 'gauri', '$2y$10$thGNBMjK4Rh.mrmBu7mtnuS.6P4.VKXQdV1.m3N/VV4TVVv0O74JK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
