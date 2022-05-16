-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2022 at 05:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `max_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `brand`, `photo`, `price`, `description`, `type`, `max_qty`) VALUES
(1, 'Iphone', 'Apple', 'image/22/iphone.jpg', '59999', 'This is Most Afordable mobile in midrange', 'mobile', 10),
(2, 'IQOO Z6PRO', 'IQOO', 'image/22/z5.jpg', '29999', 'this is iqoo new phone', 'mobile', 20),
(3, 'ONEPLUS NORD BUDS 2 8GB ', 'ONEPLUS', 'image/22/budds.jpg', '29999', 'this is oneplus new phone', 'headphone', 50),
(4, 'IQOO Z6', 'IQOO', 'image/22/z5.jpg', '25999', 'THIS IS IQOO NEW MOBILE', 'mobile', 10),
(5, 'Boat Rockerz 400 headphone', 'boat', 'image/22/boat400.jpg', '2000', 'this is boat headphone', 'headphone', 20),
(6, 'Boat Rockerz 400 headphone', 'boat', 'image/22/boat450.jpg', '3000', 'this is boat headphone', 'headphone', 20),
(7, 'Boat Rockerz 400 Buds bluetooth', 'boat', 'image/22/boat121buds.jpg', '1500', 'this is boat buds', 'headphone', 20),
(8, 'ONEPLUS NORD CE 2', 'oneplus', 'image/22/nordce2.jpg', '23000', 'this is oneplus mobile', 'mobile', 20),
(9, 'MI notebook 8gb 512gb SSD', 'MI', 'image/22/mi_motebook.jpg', '45999', 'this is mi laptop', 'laptop', 20),
(10, 'samsung galaxy book 2 8gb 512gb SSD', 'samsung galaxy', 'image/22/galaxy_book2.jpg', '59999', 'this is samsung laptop', 'laptop', 20),
(11, 'apple macbook air 8gb 512gb SSD', 'Apple', 'image/22/macair.jpg', '79999', 'this is Aple laptop ', 'laptop', 20),
(12, 'apple macbook pro 8gb 512gb SSD', 'Apple', 'image/22/macpro.jpg', '125999', 'this is Apple laptop ', 'laptop', 20),
(13, 'samsung galaxy tab s7 FE', 'samsung galaxy', 'image/22/samsungtabs7fe.jpg', '39999', 'this is samsung tablet', 'tablet', 20),
(14, 'nokia T20 tab ', 'nokia', 'image/22/nokiat20tab.jpg', '29999', 'this is nokia tablet', 'tablet', 20),
(15, 'MI pad 5', 'MI', 'image/22/mipad5.jpg', '29999', 'this is mi tablet', 'tablet', 20),
(16, 'LENOVO TAB M10 5G', 'lenovo ', 'image/22/lenovotabm10.jpg', '19999', 'this is lenovo tablet', 'tablet', 20);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `rid` int(11) NOT NULL,
  `message` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`rid`, `message`, `username`, `time`) VALUES
(2, 'hello i am nilesh', 'nilesh', '2022-05-16 20:52:47'),
(3, 'hello my name is nepal', 'nepal', '2022-05-16 20:56:29'),
(4, 'hello  2', 'nepal', '2022-05-16 20:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) DEFAULT 0,
  `activation_code` varchar(255) NOT NULL,
  `activation_expiry` datetime NOT NULL,
  `activated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `active`, `activation_code`, `activation_expiry`, `activated_at`, `created_at`, `updated_at`, `address`, `pincode`) VALUES
(22, 'nilesh', 'nileshdarji282003@gmail.com', '$2y$10$b.LEHI6elwRM7kWsMJY8mumgtyD3A3Z5Kt5JNE5pkT.u6PV/1fKnm', 1, 1, '$2y$10$YiOzpXtUNBEh1OL350hv3uh7HCNIVbZX5z4ieeo/tgDJwzokJEeEa', '2022-05-15 15:39:13', '2022-05-14 19:11:18', '2022-05-14 13:39:13', '2022-05-14 23:56:47', 'nadiad gujrat', 380001),
(23, 'nepal', 'nepalsinhrajput007773@gmail.com', '$2y$10$n4Lo0I7FJBH/fnSoVzl3LOYv9NU5m6jLtZeZ/0Hz3s76.7UobedAS', 0, 1, '$2y$10$FB0cdB1qHLyGM4rz6sUImurb6lX/ZM9KOczGxpnvKm4pKFfzi/zCG', '2022-05-17 17:24:33', '2022-05-16 20:55:31', '2022-05-16 15:24:33', '2022-05-16 20:55:31', 'nadiad gujrat', 387001);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
