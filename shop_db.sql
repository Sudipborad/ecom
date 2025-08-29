-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2025 at 06:10 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin1'),
(2, 'Admin', 'Admin2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(1, 1, 4, 'Citizen Watch', 890, 1, 'watch-1.webp'),
(2, 9, 11, 'Mouse ', 400, 1, 'mouse-1.webp'),
(3, 10, 11, 'Mouse ', 400, 2, 'mouse-1.webp');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'Kushal Lakhani', 'dmkukadiya@2005.com', '7898584250', 'Hello I Want To Join This Shopie'),
(2, 1, 'admin', 'dmkukadiya@2005.com', '9087789076', 'hello'),
(3, 6, 'Kushal Lakhani', 'dmkukadiya@2005.com', '1111111111', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(2, 'LAPTOP LENOVO', 'Lenovo Laptop,I3 Processor,256 SSD', 48000, 'laptop-1.webp', 'laptop-2.webp', 'laptop-3.webp'),
(4, 'Citizen Watch', 'Best Watch With Water Proof', 890, 'watch-1.webp', 'watch-2.webp', 'watch-3.webp'),
(6, 'Macbook', 'Mackbook laptop 256 GB SSD', 120000, 'mackbook.jpg', 'mackbook1.jpg', 'mackbook2.jpg'),
(7, 'HP LAPTOP', 'HP LAPTOP 512 GB SSD', 50000, 'hp.jpg', 'hp2.jpg', 'hp1.jpg'),
(8, 'Samsung Fridge', 'Samsung Fridge 4 star', 25000, 'fridge-1.webp', 'fridge-2.webp', 'fridge-3.webp'),
(9, 'Rolex Watch', 'Rolex Watch Branded Piece With Day Showing', 30000, 'rolex.jpg', 'rolex1.jpg', 'rolex2.jpg'),
(10, 'Realme Smart Watch', 'Realme Smart Watch With New Features And Extra  Battery Backup', 2500, 'rewatch.jpg', 'rewatch1.jpg', 'rewatch2.jpg'),
(11, 'Mouse ', 'Wired Mouse ', 400, 'mouse-1.webp', 'mouse-2.webp', 'mouse-3.webp'),
(12, 'Sony Tv', 'Sony Tv Smart Tv With WIFI Connections', 40000, 'sontv.jpg', 'sontv1.jpg', 'sontv2.jpg'),
(13, 'Canon Camera', 'Canon Camera With Best Lens', 1200, 'camera-1.webp', 'camera-2.webp', 'camera-3.webp'),
(14, 'Realme phone', 'phonre realme', 10000, 'smartphone-2.webp', 'smartphone-1.webp', 'smartphone-3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Dharmik Kukadiya', 'dmkukadiya@2005.com', 'b08fff87998d20605f134b632cb8fa3398008116'),
(2, 'Khushi  Hemani', 'khushi@2006gmail.com', 'e70e9aed0e2c52cde2c57f01f3707c48ac4501ef'),
(3, 'Kishan Rughani', 'kishan@2007gmail.com', 'e4a94d934c4323d57c8ff0a8bf3c4046cdced69f'),
(4, 'Kushal Lakhani', 'kushal2003@gmail.com', '43bfbb322dc68f859cd7f240ffa89fc18432796d'),
(5, 'Kishan Rughani', 'kishanrughani@1990gmail.com', 'e4a94d934c4323d57c8ff0a8bf3c4046cdced69f'),
(6, 'Kushal Lakhani', 'klakhani2803@gmail.com', '095b24843ada5326fde9dfc53b505ee83803ef95'),
(7, 'Prem Dave', 'premdave@gmail.com', '55d2c5c4d7ca0c1b014112cb367848c4ab9ad30a'),
(8, 'Vanraj', 'architshah2017@gmail.com', 'b5110b6f2a45f9a6fffbe09d2e76e275a3cfc4a4'),
(9, 'Fayan', 'fayansuthar2@gmail.com', 'eee76a3b8d7c98c28755f3267648f54eb0c2debf'),
(10, 'jatin', 'jatincs@gmail.com', '6266cb331cc142ca56685ca13f5c4d00306f6787');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(1, 4, 2, 'LAPTOP', 1000, 'laptop-1.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
