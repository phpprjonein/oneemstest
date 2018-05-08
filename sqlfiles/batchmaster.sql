---
-- Table structure for table `devbatchmst_new`
--

CREATE TABLE IF NOT EXISTS `batchmaster` (
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
