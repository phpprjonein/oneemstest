-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 05:56 PM
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
-- Table structure for table `switchvars`
--

CREATE TABLE IF NOT EXISTS `switchvars` (
  `swvarid` int(11) NOT NULL AUTO_INCREMENT,
  `swvarname` text,
  `swvarval` text,
  `deviceseries` text,
  `templname` varchar(255) DEFAULT NULL,
  `switch_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`swvarid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `switchvars`
--

INSERT INTO `switchvars` (`swvarid`, `swvarname`, `swvarval`, `deviceseries`, `templname`, `switch_name`) VALUES
(1, 'devicename_prefix', 'AKROOH20T1A', ' ', ' ', 'AKRON MTSO'),
(2, 'AS', '64656', 'deviceseries2', 'templname2', 'AKRON MTSO'),
(3, 'devicename_prefix', 'AKROOH20T2A', '', '', 'AKRON 2'),
(4, 'AS', '64665', '', '', 'AKRON 2'),
(5, 'devicename_prefix', 'ALPRGAGQT1A', '', '', 'Alpharetta'),
(6, 'AS', '', '', '', 'Alpharetta'),
(7, 'devicename_prefix', 'ALPRGAGQT2A', '', '', 'ALPHARETTA MTX 2'),
(8, 'AS', '', '', '', 'ALPHARETTA MTX 2'),
(9, 'devicename_prefix', 'APPLWIEET1A', '', '', 'Appleton'),
(10, 'AS', '', '', '', 'Appleton'),
(11, 'devicename_prefix', 'APPLWIEE51A', '', '', 'Appleton1'),
(12, 'AS', '', '', '', 'Appleton1'),
(13, 'devicename_prefix', 'BLTNMN86T1A', '', '', 'Bloomington 1'),
(14, 'AS', '64766', '', '', 'Bloomington 1'),
(15, 'devicename_prefix', 'BLTNMN86T2A', '', '', 'Bloomington 2'),
(16, 'AS', '64765', '', '', 'Bloomington 2'),
(17, 'devicename_prefix', 'BRHOALTBT1A', '', '', 'LAKESHORE'),
(18, 'AS', '', '', '', 'LAKESHORE'),
(19, 'devicename_prefix', 'BRHOALTBT6A', '', '', 'LAKESHORE MTX 6'),
(20, 'AS', '', '', '', 'LAKESHORE MTX 6'),
(21, 'devicename_prefix', 'CHNDINAAT1A', '', '', 'Chandler (Evansville)'),
(22, 'AS', '64631', '', '', 'Chandler (Evansville)'),
(23, 'devicename_prefix', 'CHRXNCLHT1A', '', '', 'Charlotte (MTX3)'),
(24, 'AS', '64802', '', '', 'Charlotte (MTX3)'),
(25, 'devicename_prefix', 'CLMASCMVT1A', '', '', 'Columbia (MTX5)'),
(26, 'AS', '', '', '', 'Columbia (MTX5)'),
(27, 'devicename_prefix', 'CNCQOH22T1A', '', '', 'Duff Drive'),
(28, 'AS', '64662', '', '', 'Duff Drive'),
(29, 'devicename_prefix', 'CNCQOH22T2A', '', '', 'Duff Drive 2'),
(30, 'AS', '64663', '', '', 'Duff Drive 2'),
(31, 'devicename_prefix', 'CRDLIL13T1A', '', '', 'Carbondale '),
(32, 'AS', '64621', '', '', 'Carbondale '),
(33, 'devicename_prefix', 'CTTPMIBGT1A', '', '', 'Detroit 5'),
(34, 'AS', '64646', '', '', 'Detroit 5'),
(35, 'devicename_prefix', 'DLTHGAGQT1A', '', '', 'Duluth 1 '),
(36, 'AS', '', '', '', 'Duluth 1 '),
(37, 'devicename_prefix', 'DLTHGAGQT2A', '', '', 'Duluth 2'),
(38, 'AS', '', '', '', 'Duluth 2'),
(39, 'devicename_prefix', 'DLTHGAGQT3A', '', '', 'DULUTH MTX 3'),
(40, 'AS', '', '', '', 'DULUTH MTX 3'),
(41, 'devicename_prefix', 'DLTHGAGQT4A', '', '', 'DULUTH MTX 4'),
(42, 'AS', '', '', '', 'DULUTH MTX 4'),
(43, 'devicename_prefix', 'GAHGOHBTT1A', '', '', 'CLEVELAND 1'),
(44, 'AS', '64660', '', '', 'CLEVELAND 1'),
(45, 'devicename_prefix', 'GAHGOHBTT2A', '', '', 'CLEVELAND 2'),
(46, 'AS', '64661', '', '', 'CLEVELAND 2'),
(47, 'devicename_prefix', 'GLVYMNNVT1A', '', '', 'Golden Valley'),
(48, 'AS', '64759', '', '', 'Golden Valley'),
(49, 'devicename_prefix', 'GNBQNC15T1A', '', '', 'Greensboro (MTX2)'),
(50, 'AS', '64804', '', '', 'Greensboro (MTX2)'),
(51, 'devicename_prefix', 'GNVLSCMZT1A', '', '', 'GREENVILLE (MTX1)'),
(52, 'AS', '', '', '', 'GREENVILLE (MTX1)'),
(53, 'devicename_prefix', 'GNVLSCMZT2A', '', '', 'Greenville (MTX7)'),
(54, 'AS', '', '', '', 'Greenville (MTX7)'),
(55, 'devicename_prefix', 'GRNRNCJBT1A', '', '', 'RaleighA'),
(56, 'AS', '64810', '', '', 'RaleighA'),
(57, 'devicename_prefix', 'LWCTOH02T1A', '', '', 'LEWIS CENTER 1'),
(58, 'AS', '64659', '', '', 'LEWIS CENTER 1'),
(59, 'devicename_prefix', 'LWCTOH02T2A', '', '', 'LEWIS CENTER 2'),
(60, 'AS', '64664', '', '', 'LEWIS CENTER 2'),
(61, 'devicename_prefix', 'MACNGAYQT1A', '', '', 'MACON MTX 1'),
(62, 'AS', '64834', '', '', 'MACON MTX 1'),
(63, 'devicename_prefix', 'MACNGAYQT2A', '', '', 'Macon 2'),
(64, 'AS', '', '', '', 'Macon 2'),
(65, 'devicename_prefix', 'MACNGAYQT5A', '', '', 'MACON MTX 5'),
(66, 'AS', '', '', '', 'MACON MTX 5'),
(67, 'devicename_prefix', 'MNRGKSABT1A', '', '', 'Moundridge'),
(68, 'AS', '64767', '', '', 'Moundridge'),
(69, 'devicename_prefix', 'MNTPOHAET1A', '', '', 'MAUMEE MSC'),
(70, 'AS', '64666', '', '', 'MAUMEE MSC'),
(71, 'devicename_prefix', 'MSHWINBWT1A', '', '', 'South Bend'),
(72, 'AS', '64613', '', '', 'South Bend'),
(73, 'devicename_prefix', 'NCHRSCPLT1A', '', '', 'Charleston (MTX4)'),
(74, 'AS', '', '', '', 'Charleston (MTX4)'),
(75, 'devicename_prefix', 'OMALNEXUT1A', '', '', 'West Omaha'),
(76, 'AS', '64764', '', '', 'West Omaha'),
(77, 'devicename_prefix', 'OWTNMNCCT1A', '', '', 'Owatonna'),
(78, 'AS', '64771', '', '', 'Owatonna'),
(79, 'devicename_prefix', 'RLGHNCORT1A', '', '', 'Raleigh (MTX8)'),
(80, 'AS', '64806', '', '', 'Raleigh (MTX8)'),
(81, 'devicename_prefix', 'RYLOMICBT1A', '', '', 'Detroit 9'),
(82, 'AS', '64641', '', '', 'Detroit 9'),
(83, 'devicename_prefix', 'SCVIOHAGT1A', '', '', 'ST. CLAIRSVILLE'),
(84, 'AS', '64668', '', '', 'ST. CLAIRSVILLE'),
(85, 'devicename_prefix', 'SFLDMILRT1A', '', '', 'Detroit 12'),
(86, 'AS', '64644', '', '', 'Detroit 12'),
(87, 'devicename_prefix', 'SFLEMIFXT1A', '', '', 'Detroit 10'),
(88, 'AS', '64643', '', '', 'Detroit 12'),
(89, 'devicename_prefix', 'SFLEMIFXT2A', '', '', 'Detroit 11'),
(90, 'AS', '64645', '', '', 'Detroit 11'),
(91, 'devicename_prefix', 'SHPTLAWRT1A', '', '', 'Shreveport, LA'),
(92, 'AS', '64788', '', '', 'Shreveport, LA'),
(93, 'devicename_prefix', 'SPFDMOKCT1A', '', '', 'Springfield_MO'),
(94, 'AS', '64775', '', '', 'Springfield_MO'),
(95, 'devicename_prefix', 'SXFLSDTUT1A', '', '', 'Sioux Falls'),
(96, 'AS', '64763', '', '', 'Sioux Falls');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
