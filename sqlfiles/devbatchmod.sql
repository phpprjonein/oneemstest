-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 10:42 PM
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
-- Table structure for table `devbatch`
--

CREATE TABLE IF NOT EXISTS `devbatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` varchar(100) NOT NULL,
  `deviceid` int(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'f',
  `scriptname` text NOT NULL,
  `deviceseries` text NOT NULL,
  `deviceos` varchar(10) NOT NULL,
  `batchcreated` datetime NOT NULL,
  `batchcompleted` datetime NOT NULL,
  `priority` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `devbatch`
--

INSERT INTO `devbatch` (`id`, `batchid`, `deviceid`, `status`, `scriptname`, `deviceseries`, `deviceos`, `batchcreated`, `batchcompleted`, `priority`) VALUES
(2, '1524626505', 4036, 'f', 'Golen_ASR-903_1532S1_ALL_Hub_NorthCentral_GreatPlains_Bloomington2_cutteda', '', '', '2018-04-25 05:21:59', '2018-04-25 05:21:59', 2),
(3, '1525291948', 4033, 's', 'Golden_ASR920_1533S3_ALL_Standalone_darbomu', '', '', '2018-05-02 22:13:03', '2018-05-02 22:13:03', 1),
(4, '1525292097', 4054, 's', 'Golden_ASR1000_1532S1_ALL_IT-store_debarle', '', '', '2018-05-02 22:16:04', '2018-05-02 22:16:04', 2),
(5, '1525292097', 4056, 's', 'Golden_ASR1000_1532S1_ALL_IT-store_debarle', '', '', '2018-05-02 22:16:04', '2018-05-02 22:16:04', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
