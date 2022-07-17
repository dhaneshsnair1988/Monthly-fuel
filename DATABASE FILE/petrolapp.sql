-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 17, 2022 at 08:08 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petrolapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuel_order`
--

DROP TABLE IF EXISTS `fuel_order`;
CREATE TABLE IF NOT EXISTS `fuel_order` (
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_amount_paid` varchar(255) NOT NULL,
  `type_of_fuel` int(11) NOT NULL,
  `month_of_order` varchar(55) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fuel_order`
--

INSERT INTO `fuel_order` (`user_id`, `order_id`, `order_amount_paid`, `type_of_fuel`, `month_of_order`, `order_date`) VALUES
(1, 3, '21', 4, 'MAR', '2022-07-17 13:03:37'),
(1, 4, '1288', 3, 'JUN', '2022-07-17 13:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_order_item`
--

DROP TABLE IF EXISTS `fuel_order_item`;
CREATE TABLE IF NOT EXISTS `fuel_order_item` (
  `order_id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `order_item_quantity` varchar(255) NOT NULL,
  `order_item_price` varchar(255) NOT NULL,
  `order_item_final_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fuel_order_item`
--

INSERT INTO `fuel_order_item` (`order_id`, `item_code`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`) VALUES
(3, '1', '2', '3', '6'),
(3, '4', '3', '5', '15'),
(4, '1', '12', '23', '276'),
(4, '2', '23', '44', '1012');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_user`
--

DROP TABLE IF EXISTS `fuel_user`;
CREATE TABLE IF NOT EXISTS `fuel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fuel_user`
--

INSERT INTO `fuel_user` (`id`, `email`, `password`, `first_name`, `last_name`, `address`, `mobile`) VALUES
(1, 'demo@demo.com', 'Password@123', 'Demo', 'Account', 'demo address', '7412580000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
