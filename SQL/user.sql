-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 06:55 AM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cid`, `pid`, `id`, `qty`) VALUES
(35, 1, 29, 1),
(36, 3, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ordertype` varchar(100) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `pid`, `qty`, `ordertype`, `time`, `address`, `id`, `status`, `discount`) VALUES
(14, 2, 1, 'COD', '2022-06-07 10:11:41', 'Darji Vas , Vasna(vatam) ,lakhni , Gujrat', 29, 'Dispatched', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `price` int(50) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `max_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `brand`, `photo`, `price`, `description`, `type`, `max_qty`) VALUES
(1, 'Iphone', 'Apple', 'image/iphone.jpg', 59999, 'This is Most Afordable mobile in midrange', 'mobile', 13),
(2, 'IQOO Z6PRO', 'IQOO', 'image/z5.jpg', 29999, 'this is iqoo new phone', 'mobile', 4),
(3, 'ONEPLUS NORD BUDS 2 8GB ', 'ONEPLUS', 'image/budds.jpg', 29999, 'this is oneplus new phone', 'headphone', 53),
(4, 'IQOO Z6', 'IQOO', 'image/z5.jpg', 25999, 'THIS IS IQOO NEW MOBILE', 'mobile', 13),
(5, 'Boat Rockerz 400 headphone', 'boat', 'image/boat400.jpg', 2000, 'this is boat headphone', 'headphone', 23),
(6, 'Boat Rockerz 400 headphone', 'boat', 'image/boat450.jpg', 3000, 'this is boat headphone', 'headphone', 23),
(7, 'Boat Rockerz 400 Buds bluetooth', 'boat', 'image/boat121buds.jpg', 1500, 'this is boat buds', 'headphone', 23),
(8, 'ONEPLUS NORD CE 2', 'oneplus', 'image/nordce2.jpg', 23000, 'this is oneplus mobile', 'mobile', 23),
(9, 'MI notebook 8gb 512gb SSD', 'MI', 'image/mi_motebook.jpg', 45999, 'this is mi laptop', 'laptop', 23),
(10, 'samsung galaxy book 2 8gb 512gb SSD', 'samsung galaxy', 'image/galaxy_book2.jpg', 59999, 'this is samsung laptop', 'laptop', 23),
(11, 'apple macbook air 8gb 512gb SSD', 'Apple', 'image/macair.jpg', 79999, 'this is Aple laptop ', 'laptop', 23),
(12, 'apple macbook pro 8gb 512gb SSD', 'Apple', 'image/macpro.jpg', 125999, 'this is Apple laptop ', 'laptop', 23),
(13, 'samsung galaxy tab s7 FE', 'samsung galaxy', 'image/samsungtabs7fe.jpg', 39999, 'this is samsung tablet', 'tablet', 23),
(14, 'nokia T20 tab ', 'nokia', 'image/nokiat20tab.jpg', 29999, 'this is nokia tablet', 'tablet', 0),
(15, 'MI pad 5', 'MI', 'image/mipad5.jpg', 29999, 'this is mi tablet', 'tablet', 23),
(16, 'LENOVO TAB M10 5G', 'lenovo ', 'image/lenovotabm10.jpg', 19999, 'this is lenovo tablet', 'tablet', 23),
(17, 'Boat Xtend Smartwatch', 'Boat', 'image/boatxtendwatch.jpg', 2799, 'boat smartwatch', 'other', 20);

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
(23, 'nepal', 'nepalsinhrajput007773@gmail.com', '$2y$10$n4Lo0I7FJBH/fnSoVzl3LOYv9NU5m6jLtZeZ/0Hz3s76.7UobedAS', 0, 1, '$2y$10$FB0cdB1qHLyGM4rz6sUImurb6lX/ZM9KOczGxpnvKm4pKFfzi/zCG', '2022-05-17 17:24:33', '2022-05-16 20:55:31', '2022-05-16 15:24:33', '2022-06-07 10:08:24', 'nadiad|gujrat', 387001),
(28, 'admin', 'nileshdarji282003@gmail.com', '$2y$10$Y8PWN032m7GtllNkiObFfefrFin/bUmig85KB1bWvyxx91clFpJU6', 1, 1, '$2y$10$OiXUew4cQXWR88p6GNkuIOL9YCHW6oHy42o30S.dqcNrOol6mJXq2', '2022-06-07 14:30:04', '2022-06-06 18:02:07', '2022-06-06 12:30:04', '2022-06-07 10:08:33', 'Nadiad|Gujrat', 387001),
(29, 'noname', 'nilesh.28.2003@gmail.com', '$2y$10$UYthrmyoYbqMk7FdPOj83O6ga23a7032WSQ8aFcFbisR9CiYw.BBG', 0, 1, '$2y$10$hI6hqnL.PN8orhOoeaOa9eq3dothdIrFvjiCOvqVI0z96IXcGWkiW', '2022-06-07 15:40:19', '2022-06-06 19:10:58', '2022-06-06 13:40:19', '2022-06-07 10:08:41', 'Vasna(vatam) ,lakhni|Gujrat', 385535);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

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
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
