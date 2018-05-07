-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2018 at 05:20 AM
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
-- Table structure for table `swrepository`
--

CREATE TABLE IF NOT EXISTS `swrepository` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceseries` text NOT NULL,
  `nodeVersion` varchar(255) NOT NULL,
  `filename` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `uploadeddate` datetime NOT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `swrepository`
--

INSERT INTO `swrepository` (`id`, `deviceseries`, `nodeVersion`, `filename`, `username`, `uploadeddate`, `status`) VALUES
(1, 'Cisco ASR 1000 Series Aggregation Services Routers', '15.6(1)S1', 'filename_abc.bin', 'user1', '0000-00-00 00:00:00', '0'),
(2, 'ASR5000', '15.8', 'filename2.tar', '', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
