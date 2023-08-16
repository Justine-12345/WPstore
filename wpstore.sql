-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 06:53 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brandId` int(100) NOT NULL,
  `brandName` varchar(100) NOT NULL,
  `brandSize` varchar(100) DEFAULT NULL,
  `itemId` int(100) DEFAULT NULL,
  `brandImage` varchar(100) DEFAULT NULL,
  `brandPrice` decimal(60,0) NOT NULL,
  `brandStock` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brandId`, `brandName`, `brandSize`, `itemId`, `brandImage`, `brandPrice`, `brandStock`) VALUES
(1, 'Alaska', NULL, 1, 'Alaska.jpg', '350', 287),
(2, 'Adidas', '8', 2, 'Adidas.jpg', '3000', 197),
(3, 'Nike', '9', 2, 'Nike.jpg', '5000', 195),
(4, 'UnderArmour', '10', 2, 'UA.jpg', '4500', 195),
(5, 'No Brand', NULL, 3, 'oven.jpg', '5000', 99),
(6, 'No brand', NULL, 4, 'fan.jpg', '700', 196),
(7, 'Sanyo', '40\"', 5, 'sanyo.jpg', '18000', 99),
(8, 'Sharp', '50\"', 5, 'sharp.jpg', '29000', 149);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(100) NOT NULL,
  `itemDesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `itemDesc`) VALUES
(1, 'Milk'),
(2, 'Shoes'),
(3, 'Oven'),
(4, 'Electric Fan'),
(5, 'Television'),
(6, 'Refrigerator ');

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `orderlineId` int(11) NOT NULL,
  `ordelineQty` int(11) NOT NULL,
  `orderlinePrice` double(10,0) NOT NULL,
  `orderId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`orderlineId`, `ordelineQty`, `orderlinePrice`, `orderId`, `brandId`) VALUES
(38, 2, 700, 34, 1),
(39, 2, 6000, 34, 2),
(40, 1, 5000, 34, 3),
(41, 1, 4500, 34, 4),
(42, 1, 350, 35, 1),
(43, 1, 4500, 36, 4),
(44, 1, 350, 37, 1),
(45, 1, 3000, 37, 2),
(46, 1, 3000, 38, 2),
(47, 5, 1750, 39, 1),
(48, 2, 9000, 40, 4),
(49, 3, 15000, 41, 3),
(50, 2, 10000, 42, 3),
(51, 3, 13500, 43, 4),
(52, 1, 350, 44, 1),
(53, 2, 700, 45, 1),
(54, 1, 350, 46, 1),
(55, 2, 700, 47, 1),
(56, 1, 700, 48, 6),
(57, 1, 5000, 49, 5),
(58, 1, 700, 49, 6),
(59, 1, 29000, 49, 8),
(60, 1, 3000, 50, 2),
(61, 1, 700, 51, 6),
(62, 1, 18000, 51, 7),
(63, 1, 3000, 52, 2),
(64, 1, 700, 52, 6),
(65, 2, 700, 53, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(100) NOT NULL,
  `orderDate` date NOT NULL,
  `orderTotal` varchar(100) NOT NULL,
  `orderCode` varchar(100) NOT NULL,
  `userId` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `orderDate`, `orderTotal`, `orderCode`, `userId`) VALUES
(34, '2021-04-09', '16200', '1569048144', 7),
(35, '2021-04-09', '350', '1139489609', 7),
(36, '2021-04-09', '4500', '838939291', 7),
(37, '2021-04-09', '3350', '988036119', 7),
(38, '2021-04-09', '3000', '1045470196', 7),
(39, '2021-04-09', '1750', '201154366', 7),
(40, '2021-04-09', '9000', '1813650212', 7),
(41, '2021-04-09', '15000', '2075332560', 7),
(42, '2021-04-09', '10000', '905626353', 7),
(43, '2021-04-09', '13500', '1208871925', 7),
(44, '2021-04-10', '350', '1808134860', 7),
(45, '2021-04-10', '700', '1451160059', 7),
(46, '2021-04-10', '350', '1332807813', 7),
(47, '2021-04-10', '700', '248383391', 7),
(48, '2021-04-11', '700', '725657685', 7),
(49, '2021-04-11', '34700', '446516991', 7),
(50, '2021-04-11', '3000', '1297524324', 7),
(51, '2021-04-11', '18700', '2021497159', 7),
(52, '2021-04-11', '3700', '832310114', 7),
(53, '2023-02-01', '700', '1256166660', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(100) NOT NULL,
  `userFName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `userLName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userFName`, `userEmail`, `userPassword`, `userLName`) VALUES
(7, 'aria', 'aria@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Castaneda'),
(11, 'justine', 'jus@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'castaneda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandId`),
  ADD KEY `fk_items_brands` (`itemId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`orderlineId`),
  ADD KEY `fk_orders_orderline` (`orderId`),
  ADD KEY `fk_orderline_brands` (`brandId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `fk_users_orders` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderline`
--
ALTER TABLE `orderline`
  MODIFY `orderlineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `fk_items_brands` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`);

--
-- Constraints for table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `fk_orderline_brands` FOREIGN KEY (`brandId`) REFERENCES `brands` (`brandId`),
  ADD CONSTRAINT `fk_orders_orderline` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_users_orders` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
