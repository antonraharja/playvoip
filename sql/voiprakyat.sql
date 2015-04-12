-- MySQL dump 10.9
--
-- Host: localhost    Database: voiprakyat_asterisk
-- ------------------------------------------------------
-- Server version	4.1.11-Debian_4sarge2-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblUser`
--

DROP TABLE IF EXISTS `tblUser`;
CREATE TABLE `tblUser` (
  `id` int(11) NOT NULL auto_increment,
  `creation_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `realname` varchar(50) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `location` varchar(50) NOT NULL default '',
  `protocol` varchar(20) NOT NULL default '',
  `phone` varchar(20) NOT NULL default '',
  `username` varchar(20) NOT NULL default '',
  `secret` varchar(20) NOT NULL default '',
  `host` varchar(20) NOT NULL default '',
  `callerid` varchar(20) NOT NULL default '',
  `context` varchar(20) NOT NULL default '',
  `dtmfmode` varchar(20) NOT NULL default '',
  `mailbox` varchar(20) NOT NULL default '',
  `nat` varchar(20) NOT NULL default '',
  `canreinvite` varchar(20) NOT NULL default '',
  `flag_configured` tinyint(4) NOT NULL default '0',
  `flag_inactive` tinyint(4) NOT NULL default '0',
  `flag_update` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblUser`
--


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

