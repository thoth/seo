CREATE TABLE IF NOT EXISTS `seos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `node_id` int(10) DEFAULT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `meta_robots` text COLLATE utf8_unicode_ci,
  `changefreq` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;
