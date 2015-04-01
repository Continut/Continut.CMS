/* Create our database */

CREATE DATABASE `continutcms`; /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* System domains */

CREATE TABLE `sys_domains` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'the domain uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the domain label',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* System domain urls */

CREATE TABLE `sys_domain_urls` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'domain uid',
  `parent_uid` int(11) DEFAULT NULL COMMENT 'uid of main domain, if it is an alias',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the url pointing to this domain',
  `is_alias` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this an alias domain or is it a main domain?',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* System files */

CREATE TABLE `sys_files` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'file unique id',
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'filename',
  `filesize` int(11) unsigned DEFAULT NULL COMMENT 'filesize in bytes',
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file physical location',
  `mime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file mime type',
  `created_at` int(11) DEFAULT NULL COMMENT 'utc creation time',
  `modified_at` int(11) DEFAULT NULL COMMENT 'utc modification time',
  `mount_uid` int(11) DEFAULT NULL COMMENT 'file storage mount id',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* System file mounts */

CREATE TABLE `sys_file_mounts` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mount storage title',
  `folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'starting mount folder, or path',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'file' COMMENT 'mount storage type ("file", "aws", "dropbox", etc). by default it should be "file"',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'username for remote access',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'password for remote access',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'url for remote access',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* System file metadata */

CREATE TABLE `sys_file_metadata` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `file_uid` int(11) DEFAULT NULL COMMENT 'link to sys_files uid record',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file title metadata',
  `caption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file caption metadata',
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file alt metadata',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* System content elements */

CREATE TABLE `sys_content` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `page_uid` int(11) unsigned DEFAULT NULL COMMENT 'id of page where content is stored',
  `set_uid` int(11) unsigned DEFAULT NULL COMMENT 'id of set where template and fields are stored',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is content visible on page?',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT 'is content deleted on the page? (user for history purposes)',
  `created_at` int(11) unsigned DEFAULT NULL COMMENT 'creation utc date',
  `modified_at` int(11) unsigned DEFAULT NULL COMMENT 'modification utc date',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
