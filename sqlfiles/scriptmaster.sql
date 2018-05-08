CREATE TABLE IF NOT EXISTS `scriptmaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batchid` int(11) NOT NULL,
  `scriptlist` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
