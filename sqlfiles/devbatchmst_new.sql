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
-- Table structure for table `devbatchmst_new`
--

CREATE TABLE IF NOT EXISTS `devbatchmst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` varchar(100) NOT NULL,
  `batchstatus` varchar(1) NOT NULL DEFAULT 'f',
  `batchscheddate` datetime NOT NULL,
  `region` varchar(50) NOT NULL,
  `batchtype` varchar(5) NOT NULL,
  `priority` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `batchcreated` datetime NOT NULL,
  `deviceseries` text NOT NULL,
  `nodeVersion` varchar(255) NOT NULL,
  `scriptname` text NOT NULL,
  `refmop` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `devbatchmst_new`
--

INSERT INTO `devbatchmst` (`id`, `batchid`, `batchstatus`, `batchscheddate`, `region`, `batchtype`, `priority`, `username`, `batchcreated`, `deviceseries`, `nodeVersion`, `scriptname`, `refmop`) VALUES
(1, '1525291948', 's', '2018-05-02 22:13:03', '', '', 0, '', '0000-00-00 00:00:00', '', '', '', ''),
(2, '1525292097', 's', '2018-05-02 22:16:04', '', '', 0, '', '0000-00-00 00:00:00', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
