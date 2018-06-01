-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2018 at 09:39 PM
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
-- Table structure for table `osversion`
--

CREATE TABLE IF NOT EXISTS `osversion` (
  `osid` int(11) NOT NULL,
  `osversion` text NOT NULL,
  `vendorname` varchar(50) NOT NULL,
  `ospatch` char(1) NOT NULL,
  `minverreq` text NOT NULL,
  `applydate` date NOT NULL,
  `retired` char(1) NOT NULL,
  PRIMARY KEY (`osid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `osversion`
--

INSERT INTO `osversion` (`osid`, `osversion`, `vendorname`, `ospatch`, `minverreq`, `applydate`, `retired`) VALUES
(1, '15.6(1)s1', 'cisco', 'y', '12', '2018-05-01', 'n'),
(2, '15.6(1)s1', 'cisco', 'n', '10', '2018-05-01', 'n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
