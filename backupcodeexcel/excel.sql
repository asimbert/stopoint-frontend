-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2015 at 04:42 PM
-- Server version: 5.5.23
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `excel`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductCode` varchar(500) NOT NULL,
  `Category` varchar(500) NOT NULL,
  `Brand` varchar(500) NOT NULL,
  `Carrier` varchar(500) NOT NULL,
  `Family` varchar(500) NOT NULL,
  `ProductModel` varchar(500) NOT NULL,
  `GoodPrice` varchar(500) NOT NULL,
  `FlawlessPrice` varchar(500) NOT NULL,
  `AdjustedPrice` varchar(500) NOT NULL,
  `Generation` varchar(500) NOT NULL,
  `StorageCapacity` varchar(500) NOT NULL,
  `CPU` varchar(500) NOT NULL,
  `ScreenSize` varchar(500) NOT NULL,
  `RAM` varchar(500) NOT NULL,
  `Band` varchar(500) NOT NULL,
  `Description` text NOT NULL,
  `SubFamily` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
