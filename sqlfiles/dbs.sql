DROP TABLE IF EXISTS `batchmaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchmaster` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `batchmembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchmembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` varchar(100) NOT NULL,
  `deviceid` int(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'f',
  `deviceIpAddr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `tmpbatchconfigtemplate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmpbatchconfigtemplate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` int(11) NOT NULL,
  `templname` varchar(255) NOT NULL,
  `elemid` int(11) NOT NULL,
  `elemvalue` text NOT NULL,
  `editable` int(1) NOT NULL DEFAULT '0',
  `alias` text NOT NULL,
  `userid` varchar(15) NOT NULL,
  `refmop` varchar(15) NOT NULL,
  `comments` text NOT NULL,
  `auditable` varchar(1) NOT NULL,
  `category` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182409 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `scriptmaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scriptmaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` int(11) NOT NULL,
  `scriptlist` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;



Sql for next release  after 30-MAY-2018
========================================

CREATE TABLE IF NOT EXISTS `deviceseries` (
  `seriesid` int(11) NOT NULL AUTO_INCREMENT,
  `deviceseries` text NOT NULL,
  `osid` int(11) NOT NULL,
  PRIMARY KEY (`seriesid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deviceseries`
--

INSERT INTO `deviceseries` (`seriesid`, `deviceseries`, `osid`) VALUES
(1, 'ASR920', 1),
(2, 'ASR1000', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



--
-- Table structure for table `osrepository`
--

CREATE TABLE IF NOT EXISTS `osrepository` (
  `fileid` int(11) NOT NULL,
  `osid` int(11) NOT NULL,
  `filename` text NOT NULL,
  `filesize` text NOT NULL,
  `mdfive` text NOT NULL,
  PRIMARY KEY (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `osrepository`
--

INSERT INTO `osrepository` (`fileid`, `osid`, `filename`, `filesize`, `mdfive`) VALUES
(1, 1, 'ASR920-universalkg-npe.03.19.01.s.156-1.s1.std.bin', '317133820', 'ba411cafee2f0f702572369da0b765e2'),
(2, 2, 'ASR1000rp1-ddripservicesk9.03.17.01.s.156-1.s1.std.bin', '394291836', '25d422cc23b44c3bbd7a66c76d52af46');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE IF NOT EXISTS `osversion` (
  `osid` int(11) NOT NULL,
  `osversion` text NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `ospatch` char(1) NOT NULL,
  `minverreq` text NOT NULL,
  `applydate` date NOT NULL,
  `retired` char(1) NOT NULL,
  PRIMARY KEY (`osid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `osversion`
--

INSERT INTO `osversion` (`osid`, `osversion`, `vendor`, `ospatch`, `minverreq`, `applydate`, `retired`) VALUES
(1, '15.6(1)s1', 'cisco', 'y', '12', '2018-05-01', 'n'),
(2, '15.6(1)s1', 'cisco', 'n', '10', '2018-05-01', 'n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;