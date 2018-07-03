-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2018 at 08:42 PM
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
-- Table structure for table `usrvars`
--

CREATE TABLE IF NOT EXISTS `usrvars` (
  `usrvarid` int(11) NOT NULL AUTO_INCREMENT,
  `usrvarname` text,
  `usrvarval` text,
  `deviceseries` text,
  `templname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usrvarid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `usrvars`
--

INSERT INTO `usrvars` (`usrvarid`, `usrvarname`, `usrvarval`, `deviceseries`, `templname`) VALUES
(1, 'MTU', NULL, NULL, NULL),
(2, '	Loop Back 0 IPv4', NULL, NULL, NULL),
(3, 'Loop Back 300 IPv4', NULL, NULL, NULL),
(4, 'Loopback 300 IPv6', NULL, NULL, NULL),
(5, 'NTP IPv4 Address', NULL, NULL, NULL),
(6, 'NTP IPv6 Address', NULL, NULL, NULL),
(7, 'service BW', NULL, NULL, NULL),
(8, 'Odd Telco Vlan', NULL, NULL, NULL),
(9, 'Even Telcon Vlan', NULL, NULL, NULL),
(10, 'Odd Vlan IP address', NULL, NULL, NULL),
(11, 'Even Vlan IP Address', NULL, NULL, NULL),
(12, 'Interface MTU', NULL, NULL, NULL),
(13, 'BGP Password', NULL, NULL, NULL),
(14, 'BDI 300 I Address', NULL, NULL, NULL),
(15, 'BDI 400 IP Address', NULL, NULL, NULL),
(16, 'SNMP Servers', NULL, NULL, NULL),
(17, 'eNode B Interface', NULL, NULL, NULL),
(18, 'eNode B Circuit ID', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
