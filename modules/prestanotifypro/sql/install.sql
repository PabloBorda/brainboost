CREATE TABLE IF NOT EXISTS `PREFIXmodule_prestanotifypro` (
  `id_notification` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_shop` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `date_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(50) NOT NULL DEFAULT 'image',
  `delay` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_notification`),
  KEY `id_shop` (`id_shop`),
  KEY `active` (`active`),
  KEY `type` (`type`)
) ENGINE=ENGINE_DEFAULT DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `PREFIXmodule_prestanotifypro_attribute` (
  `id_attribute` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_notification` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id_attribute`),
  KEY `id_notification` (`id_notification`),
  KEY `id_lang` (`id_lang`)
) ENGINE=ENGINE_DEFAULT DEFAULT CHARSET=utf8;
