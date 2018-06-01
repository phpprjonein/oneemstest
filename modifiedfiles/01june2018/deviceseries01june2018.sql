-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2018 at 09:38 PM
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
-- Table structure for table `deviceseries`
--

CREATE TABLE IF NOT EXISTS `deviceseries` (
  `seriesid` int(11) NOT NULL AUTO_INCREMENT,
  `deviceseries` text NOT NULL,
  `osid` int(11) NOT NULL,
  `vendorname` varchar(50) NOT NULL,
  PRIMARY KEY (`seriesid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deviceseries`
--

INSERT INTO `deviceseries` (`seriesid`, `deviceseries`, `osid`, `vendorname`) VALUES
(1, 'ASR920', 1, ''),
(2, 'ASR1000', 2, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
