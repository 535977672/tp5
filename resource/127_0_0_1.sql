-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- ‰∏ªÊú∫: 127.0.0.1
-- ÁîüÊàêÊó•Êúü: 2019 Âπ?04 Êú?28 Êó?03:21
-- ÊúçÂä°Âô®ÁâàÊú¨: 5.5.53
-- PHP ÁâàÊú¨: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Êï∞ÊçÆÂ∫ì: `mycat_db1`
--
CREATE DATABASE `mycat_db1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mycat_db1`;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `mycat_label`
--

CREATE TABLE IF NOT EXISTS `mycat_label` (
  `id` int(10) NOT NULL,
  `names` varchar(256) NOT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycatÂàÜÂ∫ìË°®';

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `mycat_rank`
--

CREATE TABLE IF NOT EXISTS `mycat_rank` (
  `rank_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codes` varchar(10) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycatÂÖ®Â±ÄË°®';
--
-- Êï∞ÊçÆÂ∫ì: `mycat_db2`
--
CREATE DATABASE `mycat_db2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mycat_db2`;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `mycat_label`
--

CREATE TABLE IF NOT EXISTS `mycat_label` (
  `id` int(10) NOT NULL,
  `names` varchar(256) NOT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycatÂàÜÂ∫ìË°®';

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `mycat_rank`
--

CREATE TABLE IF NOT EXISTS `mycat_rank` (
  `rank_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codes` varchar(10) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycatÂÖ®Â±ÄË°®';
--
-- Êï∞ÊçÆÂ∫ì: `mycat_db3`
--
CREATE DATABASE `mycat_db3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mycat_db3`;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `mycat_label`
--

CREATE TABLE IF NOT EXISTS `mycat_label` (
  `id` int(10) NOT NULL,
  `names` varchar(256) NOT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycatÂàÜÂ∫ìË°®';

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `mycat_rank`
--

CREATE TABLE IF NOT EXISTS `mycat_rank` (
  `rank_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codes` varchar(10) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycatÂÖ®Â±ÄË°®';
--
-- Êï∞ÊçÆÂ∫ì: `test`
--
CREATE DATABASE `test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `bingfa`
--

CREATE TABLE IF NOT EXISTS `bingfa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ÂéãÂäõÊµãËØï' AUTO_INCREMENT=4591 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `fenqu_hash`
--

CREATE TABLE IF NOT EXISTS `fenqu_hash` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`,`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ÂàÜÂå∫hash'
/*!50100 PARTITION BY HASH (year(time))
(PARTITION p1 ENGINE = InnoDB,
 PARTITION p11 ENGINE = InnoDB,
 PARTITION p111 ENGINE = InnoDB,
 PARTITION p1111 ENGINE = InnoDB) */ AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `fenqu_key`
--

CREATE TABLE IF NOT EXISTS `fenqu_key` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ÂàÜÂå∫key'
/*!50100 PARTITION BY KEY (id)
(PARTITION p0 ENGINE = InnoDB,
 PARTITION p1 ENGINE = InnoDB,
 PARTITION p2 ENGINE = InnoDB,
 PARTITION p3 ENGINE = InnoDB) */ AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `fenqu_list`
--

CREATE TABLE IF NOT EXISTS `fenqu_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(3) NOT NULL,
  PRIMARY KEY (`id`,`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ÂàÜÂå∫list'
/*!50100 PARTITION BY LIST (type)
(PARTITION p0 VALUES IN (0,4,8,12) ENGINE = InnoDB,
 PARTITION p1 VALUES IN (1,5,9,13) ENGINE = InnoDB,
 PARTITION p2 VALUES IN (2,6,10,14) ENGINE = InnoDB,
 PARTITION p3 VALUES IN (3,7,11,15) ENGINE = InnoDB) */ AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `fenqu_range`
--

CREATE TABLE IF NOT EXISTS `fenqu_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ÂàÜÂå∫range'
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (5) ENGINE = InnoDB,
 PARTITION p1 VALUES LESS THAN (10) ENGINE = InnoDB,
 PARTITION p3 VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */ AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `mallbuilder_enterprise`
--

CREATE TABLE IF NOT EXISTS `mallbuilder_enterprise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL COMMENT 'πÿ¡™”√ªßID',
  `cname` varchar(32) NOT NULL COMMENT 'π´Àæ√˚≥∆',
  `caddress` varchar(32) NOT NULL COMMENT 'π´Àæµÿ÷∑',
  `scope` varchar(50) NOT NULL COMMENT 'æ≠”™∑∂Œß',
  `service_city` varchar(255) NOT NULL COMMENT '∑˛ŒÒ≥« –',
  `cphone` varchar(11) NOT NULL COMMENT '¡™œµµÁª∞',
  `contact` varchar(20) NOT NULL COMMENT '¡™œµ»À',
  `license` varchar(100) NOT NULL COMMENT '”™“µ÷¥’’',
  `cprofile` varchar(255) NOT NULL COMMENT 'π´ÀæºÚΩÈ',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `oauth_access_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `oauth_authorization_codes`
--

CREATE TABLE IF NOT EXISTS `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  `id_token` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`authorization_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `oauth_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `client_id` varchar(80) NOT NULL,
  `client_secret` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `grant_types` varchar(80) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `oauth_jwt`
--

CREATE TABLE IF NOT EXISTS `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `oauth_refresh_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `oauth_scopes`
--

CREATE TABLE IF NOT EXISTS `oauth_scopes` (
  `scope` varchar(80) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `oauth_users`
--

CREATE TABLE IF NOT EXISTS `oauth_users` (
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `sphinx`
--

CREATE TABLE IF NOT EXISTS `sphinx` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `code` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `tp_admin`
--

CREATE TABLE IF NOT EXISTS `tp_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '”√ªßid',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '”√ªß√˚',
  `password` varchar(100) NOT NULL COMMENT '√‹¬Î',
  `role_id` smallint(5) DEFAULT '0' COMMENT 'Ω«…´id',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT 'email',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT 'ÃÌº” ±º‰',
  `last_login` int(11) NOT NULL DEFAULT '0' COMMENT '◊Ó∫Ûµ«¬º ±º‰',
  `last_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '◊Ó∫Ûµ«¬ºip',
  `lang_type` varchar(50) NOT NULL DEFAULT '' COMMENT 'lang_type',
  `agency_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'agency_id',
  `suppliers_id` smallint(5) unsigned DEFAULT '0' COMMENT 'suppliers_id',
  `todolist` longtext COMMENT 'todolist',
  `province_id` int(8) unsigned DEFAULT '0' COMMENT 'º”√À…Ã °º∂id',
  `city_id` int(8) unsigned DEFAULT '0' COMMENT 'º”√À…Ã –º∂id',
  `district_id` int(8) unsigned DEFAULT '0' COMMENT 'º”√À…Ã«¯º∂id',
  PRIMARY KEY (`admin_id`),
  KEY `user_name` (`user_name`) USING BTREE,
  KEY `agency_id` (`agency_id`) USING BTREE,
  KEY `role` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `tp_admin_role`
--

CREATE TABLE IF NOT EXISTS `tp_admin_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Ω«…´ID',
  `role_name` varchar(30) DEFAULT NULL COMMENT 'Ω«…´√˚≥∆',
  `act_list` varchar(30) DEFAULT '0' COMMENT '»®œﬁ¡–±Ì',
  `role_desc` varchar(255) DEFAULT NULL COMMENT 'Ω«…´√Ë ˆ',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Ë°®ÁöÑÁªìÊûÑ `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT 'ÂßìÂêç',
  `nickname` varchar(32) DEFAULT NULL COMMENT 'ÊòµÁß∞',
  `password` varchar(32) NOT NULL COMMENT 'ÂØÜÁ†Å',
  `mobile` varchar(11) DEFAULT NULL COMMENT 'ÁîµËØùÂè∑Á†Å',
  `hit` int(11) NOT NULL DEFAULT '0',
  `user_auth` tinyint(1) NOT NULL DEFAULT '0' COMMENT '∏ˆ»À µ√˚»œ÷§',
  `intro` varchar(200) DEFAULT NULL COMMENT '∏ˆ»ÀºÚΩÈ',
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
