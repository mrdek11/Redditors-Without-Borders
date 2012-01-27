--
-- Database: `rwb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Causes`
--

CREATE TABLE IF NOT EXISTS `Causes` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `Title` varchar(255) NOT NULL,
  `Detail` text NOT NULL,
  `Goal` decimal(10,2) NOT NULL,
  `Created` int(11) NOT NULL COMMENT 'timestamp',
  `GoalMet` int(11) NOT NULL COMMENT 'timestamp',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Subscriptions`
--

CREATE TABLE IF NOT EXISTS `Subscriptions` (
  `CauseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Registered` int(11) NOT NULL COMMENT 'timestamp',
  `LastLogin` int(11) NOT NULL COMMENT 'timestamp',
  `Assets` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

