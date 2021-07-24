-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2021 at 05:22 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `prepaid`
--

CREATE TABLE `prepaid` (
  `id_prepaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `mobile_no` varchar(12) NOT NULL,
  `pre_value` varchar(11) NOT NULL,
  `types` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prepaid`
--

INSERT INTO `prepaid` (`id_prepaid`, `userid`, `mobile_no`, `pre_value`, `types`) VALUES
(1, 1, '081234567890', '10000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `pshipping` varchar(150) NOT NULL,
  `pprice` varchar(12) NOT NULL,
  `types` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `userid`, `pname`, `pshipping`, `pprice`, `types`) VALUES
(1, 1, 'Bucket', 'Jakarta', '10000', '2');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_trans` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `no_order` varchar(10) NOT NULL,
  `total` varchar(255) NOT NULL,
  `pre_value` varchar(12) NOT NULL,
  `mobile_no` varchar(12) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `pprice` varchar(12) NOT NULL,
  `types` varchar(1) NOT NULL,
  `status` varchar(10) NOT NULL,
  `shipping_code` varchar(8) NOT NULL,
  `time_stamp` varchar(255) NOT NULL,
  `paid_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id_trans`, `userid`, `no_order`, `total`, `pre_value`, `mobile_no`, `pname`, `pprice`, `types`, `status`, `shipping_code`, `time_stamp`, `paid_at`) VALUES
(1, 1, '6875094750', '10500', '10000', '081234567890', '', '', '1', 'paid', '', '1626965490', '2021-07-22 21:51:37'),
(2, 1, '5605983363', '20000', '', '', 'Bucket', '10000', '2', 'cancel', '', '1627020670', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$IMJCTJSzJyGK7k64Fg6WwuJf5/pxWIjlWU3vonHu.5YY9ZrKC2XCS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prepaid`
--
ALTER TABLE `prepaid`
  ADD PRIMARY KEY (`id_prepaid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_trans`),
  ADD KEY `no_order` (`no_order`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prepaid`
--
ALTER TABLE `prepaid`
  MODIFY `id_prepaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
