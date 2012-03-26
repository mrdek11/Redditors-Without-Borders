SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `rwb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Causes`
--

CREATE TABLE IF NOT EXISTS `Causes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Detail` text NOT NULL,
  `Goal` decimal(10,2) NOT NULL,
  `Created` int(11) NOT NULL DEFAULT '0' COMMENT 'timestamp',
  `GoalMet` int(11) NOT NULL DEFAULT '0' COMMENT 'timestamp',
  `Image` text NOT NULL,
  `Location` varchar(255) NOT NULL DEFAULT 'Unknown',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `News`
--

CREATE TABLE IF NOT EXISTS `News` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Body` text NOT NULL,
  `Timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Rank` varchar(10) NOT NULL DEFAULT 'Donor',
  `Registered` int(11) NOT NULL COMMENT 'timestamp',
  `LastLogin` int(11) NOT NULL COMMENT 'timestamp',
  `Assets` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

