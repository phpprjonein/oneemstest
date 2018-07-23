-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 05:00 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `usrvars`
--

INSERT INTO `usrvars` (`usrvarid`, `usrvarname`, `usrvarval`, `deviceseries`, `templname`) VALUES
(1, 'Odd_Vlan', '1501', NULL, NULL),
(2, 'Even_Vlan', '1502', NULL, NULL),
(3, 'Bandwidth', '100', NULL, NULL),
(4, 'Y', '6 or 8', NULL, NULL),
(5, 'Loopback0 IP Address', '10.202.96.191', NULL, NULL),
(6, 'Loopback300 IP Address', '10.202.96.197', NULL, NULL),
(7, 'Loopback300 IPv6 Address', 'xx.xx.xx.xx.xx', NULL, NULL),
(8, 'Loopback400 IPv6 Address', 'yy.yy.yy.yy.yy', NULL, NULL),
(9, 'MTU', '1970/4350', NULL, NULL),
(10, 'ASR9k-01_Hostname', '', NULL, NULL),
(11, 'ASR9k-02_Hostname', '', NULL, NULL),
(12, 'eNodeB_Interface', '', NULL, NULL),
(13, 'eNodeB_ID', '', NULL, NULL),
(14, 'UBS_Interface', '', NULL, NULL),
(15, 'BTS_ID', '', NULL, NULL),
(16, 'UBS_Vlan', '', NULL, NULL),
(17, 'RAN_IP', '', NULL, NULL),
(18, 'ASR9k-01_Loopback0 IP ', '', NULL, NULL),
(19, 'ASR9k-02_Loopback0 IP', '', NULL, NULL),
(20, 'OAM_Vlan_IP', '', NULL, NULL),
(21, 'OAM_Vlan_IPv6', '', NULL, NULL),
(22, 'Bearer_Vlan_IPv6', '', NULL, NULL),
(23, 'Odd_Vlan_IP', '', NULL, NULL),
(24, 'Even_Vlan_IP', '', NULL, NULL),
(25, 'BGP_Password', '', NULL, NULL),
(26, 'EDN11E IPv6 Loopback10', '', NULL, NULL),
(27, 'EDN12E IPv4 Loopback10', '', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
