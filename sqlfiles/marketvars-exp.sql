-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 05:01 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oneems`
--

-- --------------------------------------------------------

--
-- Table structure for table `marketvars`
--

CREATE TABLE IF NOT EXISTS `marketvars` (
  `mvarid` int(11) NOT NULL AUTO_INCREMENT,
  `mvarname` text,
  `mvarval` text,
  `deviceseries` text,
  `templname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mvarid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `marketvars`
--

INSERT INTO `marketvars` (`mvarid`, `mvarname`, `mvarval`, `deviceseries`, `templname`) VALUES
(1, 'User_Name', 'admin', 'deviceseries1', 'templname1'),
(2, 'Enable_Secret ', '123%^%&^&^ac#', '', ''),
(3, 'RP_Address', '224.123.229.3', 'deviceseries2', 'templname2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
