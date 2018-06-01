CREATE TABLE IF NOT EXISTS `configtemplatescript_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templname` varchar(255) NOT NULL,
  `elemid` int(11) NOT NULL,
  `elemvalue` text NOT NULL,
  `editable` varchar(1) NOT NULL,
  `alias` text NOT NULL,
  `userid` varchar(15) NOT NULL,
  `refmop` varchar(15) NOT NULL,
  `comments` text NOT NULL,
  `auditable` varchar(1) NOT NULL,
  `category` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11595;