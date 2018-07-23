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
-- Table structure for table `globalvars`
--

CREATE TABLE IF NOT EXISTS `globalvars` (
  `gvarid` int(11) NOT NULL AUTO_INCREMENT,
  `gvarname` text,
  `gvarval` text,
  `deviceseries` text,
  `templname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gvarid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `globalvars`
--

INSERT INTO `globalvars` (`gvarid`, `gvarname`, `gvarval`, `deviceseries`, `templname`) VALUES
(1, 'IOS', 'asr920-universalk9_npe.03.17.01.S.156-1.S1-std.bin', 'deviceseries1', 'templname1'),
(2, 'Enable_Secret', '^71234@34)(!@#', 'deviceseries2', 'templname2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
