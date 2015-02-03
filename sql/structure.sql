SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for forum_posts
-- ----------------------------
DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE `forum_posts` (
  `id_post` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) unsigned NOT NULL,
  `id_user` int(11) unsigned DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post` text NOT NULL,
  `id_editor` int(11) DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_topic` (`id_topic`),
  KEY `id_user` (`id_user`),
  KEY `forum_posts_ibfk_2` (`user`),
  CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `forum_posts_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `forum_posts_ibfk_3` FOREIGN KEY (`user`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `forum_posts_ibfk_4` FOREIGN KEY (`id_topic`) REFERENCES `forum_topics` (`id_topic`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forum_posts
-- ----------------------------
INSERT INTO `forum_posts` VALUES ('1', '1', '1', null, '2015-02-03 07:19:40', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ornare, lectus at tempus blandit, dui est tempus risus, et semper sem neque vel mi. Etiam dictum ipsum metus, ac dictum nunc eleifend eu. In hac habitasse platea dictumst. Duis urna justo, pharetra ac quam in, facilisis euismod dolor. Vivamus scelerisque aliquam augue, quis tempus lorem tempus a. Donec eu suscipit felis. In auctor cursus metus, non elementum justo pharetra et. Suspendisse eleifend, nisl at iaculis euismod, risus turpis vehicula sapien, sit amet tincidunt erat magna non purus. Nunc ullamcorper augue neque, id rhoncus nulla condimentum quis. Donec non aliquet elit, vitae rhoncus eros. Praesent leo erat, egestas fringilla quam sit amet, vestibulum rhoncus metus. Vestibulum lobortis mi in sem egestas, sed venenatis enim sagittis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel elit in dui viverra fringilla.', null, null, '2015-02-03 07:19:43', null);

-- ----------------------------
-- Table structure for forum_topics
-- ----------------------------
DROP TABLE IF EXISTS `forum_topics`;
CREATE TABLE `forum_topics` (
  `id_topic` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_forum` int(11) unsigned DEFAULT NULL,
  `id_owner` int(11) unsigned DEFAULT NULL,
  `priority` int(5) unsigned NOT NULL DEFAULT '0',
  `reads` int(11) unsigned NOT NULL,
  `closed` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  UNIQUE KEY `id_topic_3` (`id_topic`),
  KEY `id_topic` (`id_topic`),
  KEY `id_topic_2` (`id_topic`),
  KEY `id_forum` (`id_forum`),
  KEY `id_owner` (`id_owner`),
  CONSTRAINT `forum_topics_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `forums` (`id_forum`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `forum_topics_ibfk_2` FOREIGN KEY (`id_owner`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forum_topics
-- ----------------------------
INSERT INTO `forum_topics` VALUES ('1', '1', '1', '0', '0', null, null);
INSERT INTO `forum_topics` VALUES ('2', '1', '1', '0', '0', null, null);

-- ----------------------------
-- Table structure for forum_topics_lang
-- ----------------------------
DROP TABLE IF EXISTS `forum_topics_lang`;
CREATE TABLE `forum_topics_lang` (
  `id_lang` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) unsigned NOT NULL,
  `lang` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_lang`),
  UNIQUE KEY `url` (`url`),
  KEY `id_topic` (`id_topic`),
  CONSTRAINT `forum_topics_lang_ibfk_1` FOREIGN KEY (`id_topic`) REFERENCES `forum_topics` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forum_topics_lang
-- ----------------------------
INSERT INTO `forum_topics_lang` VALUES ('1', '1', 'hu', 'first-topic', 'First topic', 'Lopem ipsun dolor sit amet.');
INSERT INTO `forum_topics_lang` VALUES ('2', '2', 'hu', 'second-topic', 'Second topic', 'Lopem ipsun dolor sit amet.');

-- ----------------------------
-- Table structure for forums
-- ----------------------------
DROP TABLE IF EXISTS `forums`;
CREATE TABLE `forums` (
  `id_forum` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) unsigned NOT NULL,
  `index` int(11) unsigned NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'folder',
  `level_read` int(11) unsigned NOT NULL DEFAULT '10',
  `level_write` int(11) unsigned NOT NULL DEFAULT '100',
  `level_moderator` int(11) unsigned NOT NULL DEFAULT '1000',
  `level_open` int(11) unsigned NOT NULL DEFAULT '100',
  `locked` datetime DEFAULT NULL,
  PRIMARY KEY (`id_forum`,`code`),
  KEY `id_forum` (`id_forum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forums
-- ----------------------------
INSERT INTO `forums` VALUES ('1', '0', '0', '', '', '10', '100', '1000', '100', null);
INSERT INTO `forums` VALUES ('2', '1', '0', '', '', '10', '100', '1000', '100', null);

-- ----------------------------
-- Table structure for forums_lang
-- ----------------------------
DROP TABLE IF EXISTS `forums_lang`;
CREATE TABLE `forums_lang` (
  `id_lang` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_forum` int(11) unsigned NOT NULL,
  `lang` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `preview` text NOT NULL,
  PRIMARY KEY (`id_lang`),
  KEY `id_forum` (`id_forum`),
  CONSTRAINT `forums_lang_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `forums` (`id_forum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forums_lang
-- ----------------------------
INSERT INTO `forums_lang` VALUES ('1', '1', 'hu', 'first-forum', 'First forum', '', '');
INSERT INTO `forums_lang` VALUES ('2', '2', 'hu', 'second-forum', 'Second forum', '', '');

-- ----------------------------
-- Table structure for module_forum
-- ----------------------------
DROP TABLE IF EXISTS `module_forum`;
CREATE TABLE `module_forum` (
  `id_settings` int(11) NOT NULL AUTO_INCREMENT,
  `id_forum` int(11) unsigned DEFAULT NULL,
  `id_topic` int(11) unsigned DEFAULT NULL,
  `id_user` int(11) unsigned DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id_settings`),
  KEY `id_forum` (`id_forum`),
  KEY `id_topic` (`id_topic`),
  CONSTRAINT `module_forum_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `forums` (`id_forum`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `module_forum_ibfk_2` FOREIGN KEY (`id_topic`) REFERENCES `forum_topics` (`id_topic`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of module_forum
-- ----------------------------

-- ----------------------------
-- View structure for forum
-- ----------------------------
DROP VIEW IF EXISTS `forum`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `forum` AS select `f`.`id_forum` AS `id_forum`,`fl`.`id_lang` AS `id_lang`,`fl`.`lang` AS `lang`,`f`.`index` AS `index`,`fl`.`title` AS `title`,`f`.`code` AS `code`,`fl`.`description` AS `description`,`fl`.`preview` AS `preview`,`f`.`icon` AS `icon`,`fl`.`url` AS `url`,`f`.`level_read` AS `level_read`,`f`.`level_write` AS `level_write`,`f`.`level_moderator` AS `level_moderator`,`f`.`level_open` AS `level_open`,count(`ft`.`id_topic`) AS `topics`,count(`fp`.`id_post`) AS `posts`,`f`.`locked` AS `locked` from (((`forums_lang` `fl` left join `forums` `f` on((`fl`.`id_forum` = `f`.`id_forum`))) left join `forum_topics` `ft` on((`fl`.`id_forum` = `ft`.`id_forum`))) left join `forum_posts` `fp` on((`ft`.`id_topic` = `fp`.`id_topic`))) group by `fl`.`id_lang` ;

-- ----------------------------
-- View structure for forum_post
-- ----------------------------
DROP VIEW IF EXISTS `forum_post`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `forum_post` AS select `fp`.`id_post` AS `id_post`,`fp`.`id_topic` AS `id_topic`,`fp`.`id_user` AS `id_user`,`fp`.`user` AS `user`,`u`.`join_date` AS `user_joindate`,`u`.`last_visit` AS `user_lastvisit`,`u`.`username` AS `user_username`,`u`.`screen_name` AS `user_screen_name`,`u`.`firstname` AS `user_firstname`,`u`.`lastname` AS `user_lastname`,`u`.`birthdate` AS `usert_birthdate`,`u`.`gender` AS `user_gender`,`u`.`email` AS `user_email`,`ur`.`role_level` AS `user_role_level`,`ur`.`role_code` AS `user_role_code`,`ur`.`role_name` AS `user_role_name`,`ur`.`role_description` AS `user_role_description`,(select count(`forum_posts`.`id_post`) from `forum_posts` where (`forum_posts`.`id_user` = `u`.`id_user`)) AS `user_post_count`,`fp`.`posted` AS `posted`,`fp`.`post` AS `post`,`fp`.`last_update` AS `last_update`,`fp`.`id_editor` AS `id_editor`,`fp`.`editor` AS `editor`,`e`.`username` AS `editor_username`,`e`.`screen_name` AS `editor_screen_name`,`e`.`firstname` AS `editor_firstname`,`e`.`lastname` AS `editor_lastname`,`e`.`birthdate` AS `editor_birthdate`,`e`.`gender` AS `editor_gender`,`e`.`email` AS `editor_email`,`role`.`role_level` AS `editor_role_level`,`role`.`role_code` AS `editor_role_code`,`role`.`role_name` AS `editor_role_name`,`role`.`role_description` AS `editor_role_description`,(select count(`forum_posts`.`id_post`) from `forum_posts` where (`forum_posts`.`id_user` = `e`.`id_user`)) AS `editor_post_count`,`fp`.`deleted` AS `deleted` from ((((`forum_posts` `fp` join `user` `u` on((`fp`.`id_user` = `u`.`id_user`))) left join `user` `e` on((`fp`.`id_editor` = `e`.`id_user`))) left join `role` `ur` on((`u`.`id_role` = `ur`.`id_role`))) left join `role` on((`role`.`id_role` = `e`.`id_role`))) ;

-- ----------------------------
-- View structure for forum_topic
-- ----------------------------
DROP VIEW IF EXISTS `forum_topic`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `forum_topic` AS select `tl`.`id_topic` AS `id_topic`,`t`.`id_forum` AS `id_forum`,`tl`.`title` AS `forum_title`,`tl`.`url` AS `forum_url`,`t`.`id_owner` AS `id_owner`,`tl`.`id_lang` AS `id_lang`,`tl`.`lang` AS `lang`,`t`.`priority` AS `priority`,`tl`.`url` AS `url`,`tl`.`title` AS `title`,`tl`.`description` AS `description`,`t`.`reads` AS `reads`,count(`p`.`id_post`) AS `posts`,max(`p`.`id_post`) AS `last_post`,max(`p`.`posted`) AS `last_posted`,(select `forum_posts`.`user` from `forum_posts` where (`forum_posts`.`id_post` = max(`p`.`id_post`))) AS `last_poster`,`f`.`level_read` AS `level_read`,`f`.`level_write` AS `level_write`,`f`.`level_moderator` AS `level_moderator`,`f`.`level_open` AS `level_open`,`t`.`closed` AS `closed`,`t`.`deleted` AS `deleted`,`f`.`locked` AS `locked` from ((((`forum_topics_lang` `tl` left join `forum_topics` `t` on((`tl`.`id_topic` = `t`.`id_topic`))) left join `forum_posts` `p` on((`t`.`id_topic` = `p`.`id_topic`))) left join `forums_lang` `fl` on(((`fl`.`id_forum` = `t`.`id_forum`) and (`fl`.`lang` = `tl`.`lang`)))) left join `forums` `f` on((`f`.`id_forum` = `fl`.`id_forum`))) group by `tl`.`id_topic` ;
