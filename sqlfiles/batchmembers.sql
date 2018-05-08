 

CREATE TABLE IF NOT EXISTS `batchmembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` varchar(100) NOT NULL,
  `deviceid` int(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'f',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

