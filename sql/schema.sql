/* Create our database */

CREATE DATABASE `continutcms` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */

/* System pages */

CREATE TABLE `sys_pages` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'page unique id',
  `parent_uid` int(11) unsigned DEFAULT NULL COMMENT 'the parent page uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page title',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code for the language',
  `is_visible` tinyint(1) DEFAULT '0' COMMENT 'is the page visible?',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the page deleted?',
  `domain_uid` int(11) DEFAULT NULL COMMENT 'the domain this page belongs to',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

/* System domains */

CREATE TABLE `sys_domains` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'the domain uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the domain label',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

/* System domain urls */

CREATE TABLE `sys_domain_urls` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'domain uid',
  `parent_uid` int(11) DEFAULT NULL COMMENT 'uid of main domain, if it is an alias',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the url pointing to this domain',
  `is_alias` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this an alias domain or is it a main domain?',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci