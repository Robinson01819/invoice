-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2023 at 07:36 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` bigint(11) NOT NULL,
  `invoice_date` text NOT NULL,
  `cname` varchar(50) NOT NULL,
  `caddress` varchar(100) NOT NULL,
  `ccity` varchar(50) NOT NULL,
  `grand_total` double(10,2) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`sid`, `invoice_no`, `invoice_date`, `cname`, `caddress`, `ccity`, `grand_total`) VALUES
(1, 2023419165941, '23-04-19', 'Tamil', '4/331, South St, Sellayepuram.', 'Madurai', 25000.00),
(2, 2023419165959, '23-04-19', 'Ajith', '4/331, South St, vellimalai.', 'Kallakurichy', 75000.00),
(3, 202341917114, '23-04-19', 'Vicky', '100, north st, Town.', 'Tirunelveli', 325000.00),
(4, 202341917622, '23-04-19', 'robin', '100, north st', 'tirunelveli', 1000.00),
(5, 202341917622, '23-04-19', 'robin', '100, north st', 'tirunelveli', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `price` double(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sid`, `pname`, `price`, `qty`, `total`) VALUES
(1, 1, 'Samsung TV', 25000.00, 1, 25000.00),
(2, 2, 'Samsung TV', 25000.00, 1, 25000.00),
(3, 2, 'p1', 25000.00, 2, 50000.00),
(4, 3, 'p1', 25000.00, 11, 275000.00),
(5, 3, 'Samsung TV', 25000.00, 2, 50000.00),
(6, 4, 'p1', 1000.00, 1, 1000.00),
(7, 5, 'p1', 1000.00, 1, 1000.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
