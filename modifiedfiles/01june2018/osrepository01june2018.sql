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
-- Table structure for table `osrepository`
--

CREATE TABLE IF NOT EXISTS `osrepository` (
  `fileid` int(11) NOT NULL,
  `osid` int(11) NOT NULL,
  `filename` text NOT NULL,
  `filesize` text NOT NULL,
  `mdfive` text NOT NULL,
  `vendorname` int(11) NOT NULL,
  `ospatch` char(1) NOT NULL,
  `applydate` date NOT NULL,
  `deviceseries` text NOT NULL,
  `minverreq` text NOT NULL,
  PRIMARY KEY (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `osrepository`
--

INSERT INTO `osrepository` (`fileid`, `osid`, `filename`, `filesize`, `mdfive`, `vendorname`, `ospatch`, `applydate`, `deviceseries`, `minverreq`) VALUES
(1, 1, 'ASR920-universalkg-npe.03.19.01.s.156-1.s1.std.bin', '317133820', 'ba411cafee2f0f702572369da0b765e2', 0, '', '0000-00-00', '', ''),
(2, 2, 'ASR1000rp1-ddripservicesk9.03.17.01.s.156-1.s1.std.bin', '394291836', '25d422cc23b44c3bbd7a66c76d52af46', 0, '', '0000-00-00', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
