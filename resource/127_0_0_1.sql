-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2019 �?02 �?22 �?08:44
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mycat_db1`
--
CREATE DATABASE `mycat_db1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mycat_db1`;

-- --------------------------------------------------------

--
-- 表的结构 `mycat_label`
--

CREATE TABLE IF NOT EXISTS `mycat_label` (
  `id` int(10) NOT NULL,
  `names` varchar(256) NOT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycat分库表';

--
-- 转存表中的数据 `mycat_label`
--

INSERT INTO `mycat_label` (`id`, `names`, `code`) VALUES
(7, 'fdgf', 'gfdgfd'),
(8, '3234232', 'rwe323'),
(100000, '3234232', 'rwe323'),
(100001, '3234232', 'rwe323'),
(3432432, '323', 're');

-- --------------------------------------------------------

--
-- 表的结构 `mycat_rank`
--

CREATE TABLE IF NOT EXISTS `mycat_rank` (
  `rank_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codes` varchar(10) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycat全局表';

--
-- 转存表中的数据 `mycat_rank`
--

INSERT INTO `mycat_rank` (`rank_id`, `name`, `codes`) VALUES
(1100, '323', '323'),
(1101, '323', '323'),
(1111, 'ewee', 'rwfdf我党委');
--
-- 数据库: `mycat_db2`
--
CREATE DATABASE `mycat_db2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mycat_db2`;

-- --------------------------------------------------------

--
-- 表的结构 `mycat_label`
--

CREATE TABLE IF NOT EXISTS `mycat_label` (
  `id` int(10) NOT NULL,
  `names` varchar(256) NOT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycat分库表';

--
-- 转存表中的数据 `mycat_label`
--

INSERT INTO `mycat_label` (`id`, `names`, `code`) VALUES
(8000000, '323423', 'rwe323'),
(9000000, '323423', 'rwe323'),
(10000000, '323423', 'rwe323');

-- --------------------------------------------------------

--
-- 表的结构 `mycat_rank`
--

CREATE TABLE IF NOT EXISTS `mycat_rank` (
  `rank_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codes` varchar(10) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycat全局表';

--
-- 转存表中的数据 `mycat_rank`
--

INSERT INTO `mycat_rank` (`rank_id`, `name`, `codes`) VALUES
(1100, '323', '323'),
(1101, '323', '323'),
(2111, '对方水电费', '饿肚肚');
--
-- 数据库: `mycat_db3`
--
CREATE DATABASE `mycat_db3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mycat_db3`;

-- --------------------------------------------------------

--
-- 表的结构 `mycat_label`
--

CREATE TABLE IF NOT EXISTS `mycat_label` (
  `label_id` int(10) NOT NULL,
  `names` varchar(256) NOT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycat分库表';

-- --------------------------------------------------------

--
-- 表的结构 `mycat_rank`
--

CREATE TABLE IF NOT EXISTS `mycat_rank` (
  `rank_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codes` varchar(10) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mycat全局表';

--
-- 转存表中的数据 `mycat_rank`
--

INSERT INTO `mycat_rank` (`rank_id`, `name`, `codes`) VALUES
(1100, '323', '323'),
(1101, '323', 'fsf福2');
--
-- 数据库: `test`
--
CREATE DATABASE `test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- 表的结构 `bingfa`
--

CREATE TABLE IF NOT EXISTS `bingfa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='压力测试' AUTO_INCREMENT=4591 ;

--
-- 转存表中的数据 `bingfa`
--

INSERT INTO `bingfa` (`id`, `name`, `time`) VALUES
(1, 'thinkphp1550546096', 1550546096),
(2, 'thinkphp1550546096', 1550546096),
(3, 'thinkphp1550546096', 1550546096),
(4589, 'thinkphp1550546809', 1550546809),
(4590, 'thinkphp1550546810', 1550546810);

-- --------------------------------------------------------

--
-- 表的结构 `fenqu_hash`
--

CREATE TABLE IF NOT EXISTS `fenqu_hash` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`,`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分区hash'
/*!50100 PARTITION BY HASH (year(time))
(PARTITION p1 ENGINE = InnoDB,
 PARTITION p11 ENGINE = InnoDB,
 PARTITION p111 ENGINE = InnoDB,
 PARTITION p1111 ENGINE = InnoDB) */ AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fenqu_hash`
--

INSERT INTO `fenqu_hash` (`id`, `time`) VALUES
(1, '2019-02-21 08:24:26');

-- --------------------------------------------------------

--
-- 表的结构 `fenqu_key`
--

CREATE TABLE IF NOT EXISTS `fenqu_key` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分区key'
/*!50100 PARTITION BY KEY (id)
(PARTITION p0 ENGINE = InnoDB,
 PARTITION p1 ENGINE = InnoDB,
 PARTITION p2 ENGINE = InnoDB,
 PARTITION p3 ENGINE = InnoDB) */ AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fenqu_key`
--

INSERT INTO `fenqu_key` (`id`, `name`, `code`) VALUES
(1, '342', '34243');

-- --------------------------------------------------------

--
-- 表的结构 `fenqu_list`
--

CREATE TABLE IF NOT EXISTS `fenqu_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(3) NOT NULL,
  PRIMARY KEY (`id`,`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分区list'
/*!50100 PARTITION BY LIST (type)
(PARTITION p0 VALUES IN (0,4,8,12) ENGINE = InnoDB,
 PARTITION p1 VALUES IN (1,5,9,13) ENGINE = InnoDB,
 PARTITION p2 VALUES IN (2,6,10,14) ENGINE = InnoDB,
 PARTITION p3 VALUES IN (3,7,11,15) ENGINE = InnoDB) */ AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fenqu_list`
--

INSERT INTO `fenqu_list` (`id`, `type`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `fenqu_range`
--

CREATE TABLE IF NOT EXISTS `fenqu_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分区range'
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (5) ENGINE = InnoDB,
 PARTITION p1 VALUES LESS THAN (10) ENGINE = InnoDB,
 PARTITION p3 VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */ AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `fenqu_range`
--

INSERT INTO `fenqu_range` (`id`, `name`, `code`) VALUES
(1, '哈勒1', '12'),
(2, '哈勒2', '二维'),
(3, '哈勒3', '233'),
(4, '哈勒4', '21'),
(5, '哈勒5', '发的'),
(6, '哈勒6', '34'),
(7, '哈勒7', '是否'),
(8, '哈勒8', '213'),
(9, '哈勒9', '213'),
(10, '哈勒10', '324'),
(11, '哈勒12', '646');

-- --------------------------------------------------------

--
-- 表的结构 `mallbuilder_enterprise`
--

CREATE TABLE IF NOT EXISTS `mallbuilder_enterprise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL COMMENT '�����û�ID',
  `cname` varchar(32) NOT NULL COMMENT '��˾����',
  `caddress` varchar(32) NOT NULL COMMENT '��˾��ַ',
  `scope` varchar(50) NOT NULL COMMENT '��Ӫ��Χ',
  `service_city` varchar(255) NOT NULL COMMENT '�������',
  `cphone` varchar(11) NOT NULL COMMENT '��ϵ�绰',
  `contact` varchar(20) NOT NULL COMMENT '��ϵ��',
  `license` varchar(100) NOT NULL COMMENT 'Ӫҵִ��',
  `cprofile` varchar(255) NOT NULL COMMENT '��˾���',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `mallbuilder_enterprise`
--

INSERT INTO `mallbuilder_enterprise` (`id`, `uid`, `cname`, `caddress`, `scope`, `service_city`, `cphone`, `contact`, `license`, `cprofile`) VALUES
(1, 1, '尽快发过来', '发的工时费', '挂号费', '大商股份', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `oauth_access_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('19254d0db7481be3dda24043dd04afee25253386', '12', NULL, '2019-01-28 09:40:45', 'dgfhjgfhg'),
('237cd43e1158eac8689373e83c6708fa8284024c', '12', NULL, '2019-01-28 07:24:41', 'dgfhjgfhg'),
('31216cafa9ad1ea087de3ff5d5c7b180fafeee85', '12', NULL, '2019-01-28 07:31:06', 'dgfhjgfhg'),
('3fecff3cc9a5a5a061e4cb3b58aef272b15b8a39', '12', NULL, '2019-01-28 07:26:24', 'dgfhjgfhg'),
('748399d21bb46acf8748d30dd6c538cf427f268e', '12', NULL, '2019-02-18 07:05:53', 'dgfhjgfhg'),
('c2033d831390dfc026d023cf5cd992bf2a1cfa3b', '12', 'ddsf', '2019-02-18 07:44:23', 'dgfhjgfhg'),
('e29bb5fac9d20a513aa3b1a53e2b9d352177ef1b', '12', 'ddsf', '2019-02-18 07:44:46', 'dgfhjgfhg'),
('f1bcf88cdc32b4e3d6b10f15146a726a1724885e', '12', NULL, '2019-01-28 09:39:57', 'dgfhjgfhg'),
('ffcbde34c6e6da91fd45297ecc18ab59853924e8', '12', NULL, '2019-01-28 09:26:50', 'dgfhjgfhg');

-- --------------------------------------------------------

--
-- 表的结构 `oauth_authorization_codes`
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

--
-- 转存表中的数据 `oauth_authorization_codes`
--

INSERT INTO `oauth_authorization_codes` (`authorization_code`, `client_id`, `user_id`, `redirect_uri`, `expires`, `scope`, `id_token`) VALUES
('2e7f53f3398a2510e7be91a38d863e3c79bb5608', '12', NULL, NULL, '2019-01-28 05:25:52', 'dgfhjgfhg', NULL),
('367bf55ef697eaa055c55a3c4fa66aba16f19bf7', '12', NULL, NULL, '2019-01-28 08:38:08', 'dgfhjgfhg', NULL),
('3fd8a5ab92a084097b274a7b8634c15f2d058bfd', '12', '1', NULL, '2019-01-28 08:33:39', 'dgfhjgfhg', NULL),
('67deb247a5d5b2665476f7819f8e6899e43f1a14', '12', NULL, NULL, '2019-01-28 06:22:21', 'dgfhjgfhg', NULL),
('a3ab9d954005cdc8f2e6b0a8522190aa6d0c8c91', '12', '1', NULL, '2019-01-28 08:33:59', 'dgfhjgfhg', NULL),
('b6b2c308106bc58088374963c89723ed4ea80b3b', '12', '1', NULL, '2019-01-28 08:32:48', 'dgfhjgfhg', NULL),
('c583c878489e30e959673babb9695c38b91072ee', '12', NULL, NULL, '2019-01-25 09:28:48', 'dgfhjgfhg', NULL),
('e6b95b5d6fcd16c540a1d09a2de940e4a3b7a479', '12', NULL, NULL, '2019-01-28 08:36:00', 'dgfhjgfhg', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `oauth_clients`
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

--
-- 转存表中的数据 `oauth_clients`
--

INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES
('12', '1223243234', 'http://test.pcnfc.com/index/oauth2test2/redirecturi.html', 'refresh_token', 'dgfhjgfhg', '');

-- --------------------------------------------------------

--
-- 表的结构 `oauth_jwt`
--

CREATE TABLE IF NOT EXISTS `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_refresh_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`refresh_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('2b0ce756aa7a6a2f6fc6dfef308530ef63c0599e', '12', 'ddsf', '2019-02-11 07:44:46', 'dgfhjgfhg'),
('4048ac0d3d23acf69268087f35043548ece4c407', '12', 'ddsf', '2019-02-11 07:44:23', 'dgfhjgfhg'),
('8763415cf9ead5a8d84ad1e32881330ccefaea59', '12', '1', '2019-02-08 07:42:05', 'dgfhjgfhg'),
('90fe37e17033b7b4af9aeb1dc052121e1d4236dd', '12', NULL, '2019-02-11 06:24:41', 'dgfhjgfhg'),
('c87c539e9c17579d80698fad5191202e80fb8394', '12', NULL, '2019-02-11 06:26:24', 'dgfhjgfhg');

-- --------------------------------------------------------

--
-- 表的结构 `oauth_scopes`
--

CREATE TABLE IF NOT EXISTS `oauth_scopes` (
  `scope` varchar(80) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oauth_scopes`
--

INSERT INTO `oauth_scopes` (`scope`, `is_default`) VALUES
('dgfhjgfhg', 1);

-- --------------------------------------------------------

--
-- 表的结构 `oauth_users`
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

--
-- 转存表中的数据 `oauth_users`
--

INSERT INTO `oauth_users` (`username`, `password`, `first_name`, `last_name`, `email`, `email_verified`, `scope`) VALUES
('ddsf', '1232551351', 'erdgds', 'gtfdh', '23424@EWRR.com', 1, 'dgfhjgfhg');

-- --------------------------------------------------------

--
-- 表的结构 `sphinx`
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

--
-- 转存表中的数据 `sphinx`
--

INSERT INTO `sphinx` (`id`, `name`, `text`, `code`) VALUES
(1, 'dddd顶顶顶顶丰富的ds', '地方VB规范购房时跋山涉水vbhm,hk4546个', 123425),
(2, '功能和蘑菇蘑菇4魔镜魔镜', 'vfbvcgf由近及远晶莹hf45剔透', 6544),
(3, '儿童434和', '如果而退货', 56);

-- --------------------------------------------------------

--
-- 表的结构 `test`
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

--
-- 转存表中的数据 `test`
--

INSERT INTO `test` (`id`, `code`, `name`) VALUES
(1, '1213', '海淘2'),
(2, '123', '天猫发的 鬼地方个梵蒂冈'),
(3, '32324', '淘宝额方式方法的方式'),
(4, '435435', '酒店发生大幅度似睡非睡'),
(5, '1213', '海淘fdflglfg;lh'),
(6, '1213', '海淘345gfdfgdfd'),
(7, '1213', '海淘'),
(8, '1213', '5rewr gdfgg dgff tr kiki hgf'),
(9, '1213', '海淘'),
(10, '1213', '海淘2'),
(11, '1213', '海淘2'),
(12, '1213', '海淘2'),
(13, '1213', '海淘2'),
(14, '1213', '海淘2'),
(15, '1213', '海淘2'),
(16, '1213', '海淘2');

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

CREATE TABLE IF NOT EXISTS `tp_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '�û�id',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '�û���',
  `password` varchar(100) NOT NULL COMMENT '����',
  `role_id` smallint(5) DEFAULT '0' COMMENT '��ɫid',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT 'email',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `last_login` int(11) NOT NULL DEFAULT '0' COMMENT '����¼ʱ��',
  `last_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '����¼ip',
  `lang_type` varchar(50) NOT NULL DEFAULT '' COMMENT 'lang_type',
  `agency_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'agency_id',
  `suppliers_id` smallint(5) unsigned DEFAULT '0' COMMENT 'suppliers_id',
  `todolist` longtext COMMENT 'todolist',
  `province_id` int(8) unsigned DEFAULT '0' COMMENT '������ʡ��id',
  `city_id` int(8) unsigned DEFAULT '0' COMMENT '�������м�id',
  `district_id` int(8) unsigned DEFAULT '0' COMMENT '����������id',
  PRIMARY KEY (`admin_id`),
  KEY `user_name` (`user_name`) USING BTREE,
  KEY `agency_id` (`agency_id`) USING BTREE,
  KEY `role` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tp_admin`
--

INSERT INTO `tp_admin` (`admin_id`, `user_name`, `password`, `role_id`, `email`, `add_time`, `last_login`, `last_ip`, `lang_type`, `agency_id`, `suppliers_id`, `todolist`, `province_id`, `city_id`, `district_id`) VALUES
(1, 'admin', '$2y$10$AlMGmuNK23fJSv/DMo9fSeBXGRKGPBWidl5zk1tC5xR1sWORXwlku', 1, 'admin@admin.coom', 1428974654, 1522377007, '106.15.218.25', '', 0, 1, '', 0, 0, 0),
(2, 'bjgonghuo1', '519475228fe35ad067744465c42a19b2', 2, 'bj@163.com', 1245044099, 0, '', '', 0, 0, '', 0, 0, 0),
(3, 'shhaigonghuo1', '4146fecce77907d264f6bd873f4ea27b', 2, 'shanghai@163.com', 1245044202, 0, '', '', 0, 2, '', 0, 0, 0),
(4, 'wyp001', '519475228fe35ad067744465c42a19b2', 2, 'wyp001@126.com', 1456542538, 1486203678, '127.0.0.1', '', 0, 0, '', 0, 0, 0),
(5, 'dengyunrui', '667ae4b6e626a668fd5e083cead7ef66', 2, 'dengyunrui@qq.com', 1472610878, 1473055070, '183.14.137.252', '', 0, 0, '', 0, 0, 0),
(6, 'tpshop', '2464e868553d5401bce3b481a9f9c1f9', 1, 'administrator@websiteaccounts.com', 1472610878, 1486619732, '127.0.0.1', '', 0, 2, '', 0, 0, 0),
(7, '234567', '6536f192ad8c471edd14ba68d7c33f3a', 2, '234567', 1486606034, 0, '', '', 0, 0, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin_role`
--

CREATE TABLE IF NOT EXISTS `tp_admin_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '��ɫID',
  `role_name` varchar(30) DEFAULT NULL COMMENT '��ɫ����',
  `act_list` varchar(30) DEFAULT '0' COMMENT 'Ȩ���б�',
  `role_desc` varchar(255) DEFAULT NULL COMMENT '��ɫ����',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tp_admin_role`
--

INSERT INTO `tp_admin_role` (`role_id`, `role_name`, `act_list`, `role_desc`) VALUES
(2, '', '3,4,22,23,48,52,31,45,49,61,14', 'Υ'),
(1, '', 'all', ''),
(4, '', '0', ''),
(5, '', '0', ''),
(6, '', '11,12,13,14', '');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '姓名',
  `nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `mobile` varchar(11) DEFAULT NULL COMMENT '电话号码',
  `hit` int(11) NOT NULL DEFAULT '0',
  `user_auth` tinyint(1) NOT NULL DEFAULT '0' COMMENT '����ʵ����֤',
  `intro` varchar(200) DEFAULT NULL COMMENT '���˼��',
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `nickname`, `password`, `mobile`, `hit`, `user_auth`, `intro`, `logo`) VALUES
(1, 'kang', 'keng', '123456', '15095868104', 6, 0, NULL, NULL),
(2, 'rose', 'mick', 'sdkajfasd', '15095868105', 0, 0, NULL, NULL),
(3, 'jony', 'asdjfksd', 'jasdkfsd', '15095868105', 0, 0, NULL, NULL),
(6, 'jony', 'asdjfksd', 'jasdkfsd', '32jfs', 0, 0, NULL, NULL),
(5, 'jack', 'asdjfksd', 'jasdkfsd', '32jfs', 0, 0, NULL, NULL),
(7, 'jack', 'asdjfksd', 'jasdkfsd', '32jfs', 0, 0, NULL, NULL),
(8, 'jony', 'asdjfksd', 'jasdkfsd', '32jfs', 0, 0, NULL, NULL),
(9, 'jack', 'asdjfksd', 'jasdkfsd', 'xilihualasd', 0, 0, NULL, NULL),
(66, 'leijie', 'nick', 'b2d0d458cf6f34e8cc2a83e271a338e3', '15095868105', 0, 0, NULL, NULL),
(67, '15095868104', 'yyl', 'ed556c0ad707332b470a7badda65031d', NULL, 0, 0, NULL, NULL),
(69, 'qwer', 'leijie', 'ed556c0ad707332b470a7badda65031d', '15095868104', 0, 0, NULL, NULL),
(70, 'yyl', 'yyl', 'ed556c0ad707332b470a7badda65031d', '15095868104', 0, 0, 'test.tp5.com/public/upload/image\\20180803\\0c5fba145971a421c16a55705aba227b.jpg', 'http://test.tp5.com/public/upload/logo\\20180803\\5edebe0238bf2691f2f60baf1da88ae31fac49c7.jpeg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
