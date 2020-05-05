-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 03, 2020 at 08:14 PM
-- Server version: 10.2.31-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u679875601_farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cardname` varchar(50) NOT NULL,
  `cardtype` varchar(50) NOT NULL,
  `expmonth` varchar(50) NOT NULL,
  `expyear` varchar(50) NOT NULL,
  `cvv` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `id` int(11) NOT NULL,
  `u_id` int(3) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `card_num` varchar(50) NOT NULL,
  `exp_month` varchar(10) NOT NULL,
  `exp_year` varchar(10) NOT NULL,
  `cvv` varchar(10) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`id`, `u_id`, `card_name`, `card_num`, `exp_month`, `exp_year`, `cvv`, `status`) VALUES
(1, 24, '121345', 'azeem h', '423', '423', '3423', '1'),
(2, 24, '', '', '42356', '4352', '5454', '1'),
(3, 24, 'azee', '1234', '3245', '342', '324', '1'),
(4, 24, '123456', '3142', '3214', '1324', '3142', '1'),
(5, 29, 'azeem', '4929528466157500', '12', '2012', '111', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(10, 9, 11, 1),
(11, 9, 29, 4),
(12, 9, 7, 1),
(13, 9, 30, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) DEFAULT NULL,
  `c_photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`, `c_photo`) VALUES
(7, 'Fruits', 'fruits', 'fruits.jpg'),
(8, 'Vegetable', 'vegetable', 'vegetable.jpg'),
(9, 'Beans', 'beans', 'beans.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES
(14, 9, 11, 2),
(15, 9, 13, 5),
(16, 9, 3, 2),
(17, 9, 1, 3),
(18, 10, 13, 3),
(19, 10, 2, 4),
(20, 10, 19, 5),
(21, 11, 30, 1),
(22, 12, 30, 2),
(23, 13, 30, 1),
(24, 18, 34, 1),
(25, 19, 32, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_view` date DEFAULT NULL,
  `counter` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `photo`, `date_view`, `counter`, `stock`) VALUES
(32, 7, 'Water Melon', '<p>Water Melon</p>\r\n', 'water-melon', 23, 'water-melon.jpg', '2020-05-03', 5, 12),
(33, 7, 'Papaya', '<p>papaya</p>\r\n', 'papaya', 12, 'papaya.jpg', '2020-05-03', 5, 15),
(34, 8, 'okrap', '<p>Vegetable</p>\r\n', 'okrap', 14, 'okrap.png', '2020-05-03', 6, 23),
(35, 9, 'Beans', '<p>Beans</p>\r\n', 'beans', 45, 'beans.jpg', '2020-05-03', 1, 1100);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES
(9, 9, 'PAY-1RT494832H294925RLLZ7TZA', '2018-05-10'),
(10, 9, 'PAY-21700797GV667562HLLZ7ZVY', '2018-05-10'),
(11, 24, '1588502361', '2020-05-03'),
(12, 24, '1588503859', '2020-05-03'),
(13, 24, '1588503964', '2020-05-03'),
(14, 24, '1588504056', '2020-05-03'),
(15, 24, '1588505933', '2020-05-03'),
(16, 24, '1588506178', '2020-05-03'),
(17, 24, '1588508116', '2020-05-03'),
(18, 29, '1588516739', '2020-05-03'),
(19, 30, '1588518015', '2020-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `activate_code` varchar(15) DEFAULT NULL,
  `reset_code` varchar(15) DEFAULT NULL,
  `created_on` date NOT NULL,
  `street_num` varchar(50) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `contact_info`, `photo`, `status`, `activate_code`, `reset_code`, `created_on`, `street_num`, `sector`, `district`, `city`) VALUES
(1, 'm.mpundu@alustudent.com', '$2y$10$Y2pAwBcbUG6TK.HcZpq1CO/7uJny9tyHEHOPSecQB4PIr9tfDCHiy', 1, 'Rumo', 'farm', '', '', 'thanos1.jpg', 1, '', '', '2018-05-01', NULL, NULL, NULL, NULL),
(9, 'harry@den.com', '$2y$10$Oongyx.Rv0Y/vbHGOxywl.qf18bXFiZOcEaI4ZpRRLzFNGKAhObSC', 0, 'Harry', 'Den', 'Silay City, Negros Occidental', '09092735719', 'male2.png', 1, 'k8FBpynQfqsv', 'wzPGkX5IODlTYHg', '2018-05-09', NULL, NULL, NULL, NULL),
(12, 'test@gmail.com', '$2y$10$W2U4DsqGO2McwzI86u/jqOgQtvM4hXc/QnxNoIfMYKzYnuMWRmo76', 0, 'Christine', 'becker', 'demo', '7542214500', 'female3.jpg', 1, '', '', '2018-07-09', NULL, NULL, NULL, NULL),
(13, 'webeedream@gmail.com', '$2y$10$IF2kv.kpWoOMDTMHT6trzu6TJSQmMPMCVcBO/UBXLbMfRvidFQ7ze', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'tYdyr8e4UGRc', 'knGSYiVuQdNB17P', '2020-05-03', NULL, NULL, NULL, NULL),
(14, 'webeedream1@gmail.com', '$2y$10$9CM6cZokzUPanjIUWkwDOeqORcxXUWwk5vq.08MsfMA.DPMoymKyy', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'WvCkSf1QJZR7', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(15, 'webeedream12@gmail.com', '$2y$10$I86fjtbmWCYUKb3nDC8UkO54Qp34Si5nUVGGa2I25gsh/zrD.S09K', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'sFoErpBezV4h', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(16, 'webeedream123@gmail.com', '$2y$10$7UXSPYO9BH7dW.q8sw6L/Oi7iuIcJMzLhKC7xReXKCrr3OSsYQrCa', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'tZiJ984QesPO', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(17, 'webeedream1223@gmail.com', '$2y$10$8cn440kGAJyuUrHwxXLSZOx4j5sHyFMZq2YLVL0DmsXHk1ZP94wJS', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, '5G3gCi4rnAQc', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(18, 'webeedream1223b@gmail.com', '$2y$10$w9eB1BHUEMjy.EPXDPZLye0.BJPN4ZykT0dKYkibSMWVXGRgONRV2', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'dQ3hBVYUOTZr', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(19, 'webeedream1223dsb@gmail.com', '$2y$10$nHXOQy49H52w1923Wsu29ePx3pGtAnZuAzvUozg1u3fBo/d9IKgUW', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, '4tkON2yhrHLq', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(20, 'webeedream1223qqdsb@gmail.com', '$2y$10$KMpbw812GXhZIB9PEJG2huoUwgUtWnNvJY.OR6YeS0Vgr5rlGjw/O', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'MKN74xFfovlw', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(21, 'webeedream12231qqdsb@gmail.com', '$2y$10$u49QpvZSYORvrvckDJtLPe/0gTnzVhugGm4chmeOqKPWjaTSkaXyW', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'g4tlzhwbRJp6', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(22, 'webeedream12231qqqdsb@gmail.com', '$2y$10$FT0Pyxydr540qP3P7O1Hv.y3/BQrIk7K01CtK0AKfMfqg6kvudAJu', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 't81mIVNDKgde', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(23, 'webeedream12231qqqsadsb@gmail.com', '$2y$10$9cKAMmfJRFDwWFAIvvsYvuOSA6vtgC1uZvzI5O1D8Q/xjHih6h2T6', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, NULL, 'FCUmnqy83Puk', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(24, 'webeedream12231qqqsadswb@gmail.com', '$2y$10$SAVNi47B08uLE9BwU.Sj4uMGeHiLGt7Hobh7n7ZQe3473YebkPiui', NULL, 'Pooja', 'Singh', NULL, NULL, NULL, 1, 'C4UGy8xADuSj', NULL, '2020-05-03', 'test12', 'test', 'test', 'kigali'),
(25, 'test12@gmail.com', '$2y$10$ZDK4FkVz/Dt7aj5DYN7Q5elDBlOSnSfQhdjgxWicBt4ArKhQwPnTW', NULL, 'Pooja', 'Singh', 'Village sikandar pur\r\npost jamalpur', 'test', '', 1, NULL, NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(26, 'it@gmail.com', '$2y$10$NFCkZHLxs55PPdyj1NX3w.lsKmL2c2aubyk2f4gpCBT/F5jZselde', 0, 'Pooja', 'Singh', NULL, NULL, NULL, 1, 'e7xnHNwt12Fp', NULL, '2020-05-03', 'test', 'test', 'test', 'Kigali'),
(27, 'test@admin.com', '$2y$10$Mu8KdbVMbGwT3l1DNNeNZO3zhd1oEj5P8f5NXTJltK7aS4npmUKPG', 0, 'test', 'Singh', NULL, NULL, NULL, 1, 'acgUmC8fkjb6', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(28, 'test1233@admin.com', '$2y$10$.Vj9Kkob0cQ6YaUE8njo..2nv99FOyUh4kcTN4T6QQI9FLPhFrms2', 0, 'test', 'Singh', NULL, NULL, NULL, 1, 'cm8ZT45EkRrJ', NULL, '2020-05-03', NULL, NULL, NULL, NULL),
(29, 'rockersam998@gmail.com', '$2y$10$UxyszIYsvp2B8UoUYL7.1O19FRytCK5Pjt5VmLmpcFdDHOdIFD74.', 0, 'Pooja', 'Singh', NULL, NULL, NULL, 1, 'r68GNW5yu2sI', NULL, '2020-05-03', 'test', 'test sector', 'test city', 'Kigali'),
(30, 'mika@kalogs.net', '$2y$10$QspUMrktQ2JWArt0Z87cLu0Knj.Dv5uEM9akU6GICZtcEjZimNxrC', 0, 'Michaella Mpundu', 'M', NULL, NULL, NULL, 1, '9sjmQhC8yR5v', NULL, '2020-05-03', 'H', 'H', 'H', 'Kigali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_details`
--
ALTER TABLE `card_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
