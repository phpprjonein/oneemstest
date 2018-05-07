-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2018 at 05:37 AM
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
-- Table structure for table `devbatch_new`
--

CREATE TABLE IF NOT EXISTS `devbatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` varchar(100) NOT NULL,
  `deviceid` int(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'f',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `devbatch_new`
--

INSERT INTO `devbatch` (`id`, `batchid`, `deviceid`, `status`) VALUES
(2, '1524626505', 4036, 'f'),
(3, '1525291948', 4033, 's'),
(4, '1525292097', 4054, 's'),
(5, '1525292097', 4056, 's');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
