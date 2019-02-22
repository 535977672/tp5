
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

