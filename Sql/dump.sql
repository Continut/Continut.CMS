-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: continutcms
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sys_backend_usergroups`
--

DROP TABLE IF EXISTS `sys_backend_usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_backend_usergroups` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Backend usergroup name',
  `access` text COLLATE utf8_unicode_ci COMMENT 'json group permissions',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the usergroup deleted?',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_backend_usergroups`
--

LOCK TABLES `sys_backend_usergroups` WRITE;
/*!40000 ALTER TABLE `sys_backend_usergroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_backend_usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_backend_users`
--

DROP TABLE IF EXISTS `sys_backend_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_backend_users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'backend username',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'backend encrypted password',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT 'is the user deleted or not',
  `is_active` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the user active?',
  `usergroup_id` int(10) unsigned DEFAULT NULL COMMENT 'Backend usergroup id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user fullname',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_backend_users`
--

LOCK TABLES `sys_backend_users` WRITE;
/*!40000 ALTER TABLE `sys_backend_users` DISABLE KEYS */;
INSERT INTO `sys_backend_users` VALUES (1,'admin','admin',0,1,NULL,'Amazing Sniperman');
/*!40000 ALTER TABLE `sys_backend_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_cache`
--

DROP TABLE IF EXISTS `sys_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_cache` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page',
  `value` text COLLATE utf8_unicode_ci,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires_at` int(11) unsigned DEFAULT NULL,
  `record_uid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_cache`
--

LOCK TABLES `sys_cache` WRITE;
/*!40000 ALTER TABLE `sys_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_content`
--

DROP TABLE IF EXISTS `sys_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_content` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `page_uid` int(11) unsigned DEFAULT NULL COMMENT 'id of page where content is stored',
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'element type: plugin or content',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Title of the content element',
  `column_id` int(11) unsigned DEFAULT NULL COMMENT 'id of column where template and fields are stored',
  `parent_uid` int(11) unsigned DEFAULT '0' COMMENT 'currently only used for containers, for recursivity, stores the uid of the parent container it belongs to',
  `value` text COLLATE utf8_unicode_ci COMMENT 'value of the content element',
  `reference_uid` int(11) unsigned DEFAULT NULL COMMENT 'reference to another content element',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is content visible on page?',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT 'is content deleted on the page? (user for history purposes)',
  `created_at` int(11) unsigned DEFAULT NULL COMMENT 'creation utc date',
  `modified_at` int(11) unsigned DEFAULT NULL COMMENT 'modification utc date',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting of elements',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_content`
--

LOCK TABLES `sys_content` WRITE;
/*!40000 ALTER TABLE `sys_content` DISABLE KEYS */;
INSERT INTO `sys_content` VALUES (1,1,'content','Fully Responsive',5,7,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-desktop fa-3x\",\"link\":\"4\",\"content\":\"<p>Blablabla, hope it works.<br>Now, on to the second paragraph :)<br>\\u015ei acum s\\u0103 \\u00eencerc\\u0103m ni\\u015fte caractere scrise \\u00een limba rom\\u00e2n\\u0103 cu diacritice.<br>Se pare ca merge<br><\\/p>\"}}}',NULL,1,0,NULL,NULL,1),(2,4,'plugin',NULL,4,13,'{\r\n  \"plugin\": {\r\n    \"extension\": \"News\",\r\n    \"identifier\": \"news\",\r\n    \"controller\": \"Index\",\r\n    \"action\": \"index\",\r\n    \"settings\": {\r\n      \"limit\": 2,\r\n      \"categories\": \"3,11,201,22,500\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,8),(3,1,'container','Awesome title',2,0,'{\r\n  \"container\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"4columns\",\r\n    \"data\": \"\"\r\n  }\r\n}',NULL,0,1,NULL,NULL,8),(4,1,'content','公募プログラムガイドライン',7,7,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"Box\",\r\n    \"data\": {\r\n      \"content\": \"<p>について事業を行っています。これらの分野には、それぞれ公募プログラムがあり、国際交流事業を企画を実施する個人や団体に対して、助成金、研究奨学金（フェローシップ 「はじめて申請される方へ」をお読みください。</p>\",\r\n      \"icon\": \"fa fa-pagelines fa-3x\",\r\n      \"link\": \"4\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,9),(5,1,'container','50% stanga, 50% dreapta',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"formatColumns\":\"6\"}}}',NULL,1,0,NULL,NULL,23),(6,1,'content','Lovely day',4,7,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',NULL,1,0,NULL,NULL,1),(7,1,'container','4 elements',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"4columns\",\"data\":{\"formatColumns\":\"1\"}}}',NULL,1,0,NULL,NULL,21),(8,2,'plugin','Afişare ultimele articole',6,13,'{\"plugin\":{\"extension\":\"News\",\"template\":\"show\",\"controller\":\"Index\",\"identifier\":\"news\",\"action\":\"show\",\"settings\":{\"limit\":4,\"categories\":\"3,11,201,22,500\"},\"data\":[]}}',NULL,1,0,NULL,NULL,2),(9,1,'container','Container cu 1 coloană',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"1column\",\"data\":[]}}',NULL,1,0,NULL,NULL,25),(10,1,'content','2 elements follow now :)',4,9,'{\r\n  \"content\": {\r\n    \"extension\": \"Frontend\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<div class=\\\"repository-meta js-details-container \\\">\\n    <div class=\\\"repository-description\\\">\\n      Tiny bootstrap-compatible WISWYG rich text editor\\n    </div>\\n\\n\\n\\n</div>\\n\\n<div class=\\\"overall-summary overall-summary-bottomless\\\">\\n\\n  <div class=\\\"stats-switcher-viewport js-stats-switcher-viewport\\\">\\n    <div class=\\\"stats-switcher-wrapper\\\">\\n    <ul class=\\\"numbers-summary\\\">\\n      <li class=\\\"commits\\\">\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/commits/master\\\">\\n            <span class=\\\"octicon octicon-history\\\"></span>\\n            <span class=\\\"num text-emphasized\\\">\\n              67\\n            </span>\\n            commits\\n        </a>\\n      </li>\\n      <li>\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/branches\\\">\\n          <span class=\\\"octicon octicon-git-branch\\\"></span>\\n          <span class=\\\"num text-emphasized\\\">\\n            2\\n          </span>\\n          branches\\n        </a>\\n      </li>\\n\\n      <li>\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/releases\\\">\\n          <span class=\\\"octicon octicon-tag\\\"></span>\\n          <span class=\\\"num text-emphasized\\\">\\n            0\\n          </span>\\n          releases\\n        </a>\\n      </li>\\n\\n      <li>\\n        \\n  <a href=\\\"/mindmup/bootstrap-wysiwyg/graphs/contributors\\\">\\n    <span class=\\\"octicon octicon-organization\\\"></span>\\n    <span class=\\\"num text-emphasized\\\">\\n      8\\n    </span>\\n    contributors\\n  </a>\\n      </li>\\n    </ul>\\n\\n      <div class=\\\"repository-lang-stats\\\">\\n        <ol class=\\\"repository-lang-stats-numbers\\\">\\n          <li>\\n              <a href=\\\"/mindmup/bootstrap-wysiwyg/search?l=javascript\\\">\\n                <span class=\\\"color-block language-color\\\" style=\\\"background-color:#f1e05a;\\\"></span>\\n                <span class=\\\"lang\\\">JavaScript</span>\\n                <span class=\\\"percent\\\">99.3%</span>\\n              </a>\\n          </li>\\n        </ol>\\n      </div>\\n    </div>\\n  </div>\\n\\n</div>\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,1),(11,1,'content','Lorem ipsum',6,7,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"Box\",\r\n    \"data\": {\r\n      \"content\": \"<p>Lorem ipsum <strong>dolor sit amec</strong> and all the rest of the latin phrases used for text formating should just follow along.<br/>Voluptatem accusantium doloremque laudantium sprea totam rem aperiam.</p>\",\r\n      \"icon\": \"fa fa-edit fa-3x\",\r\n      \"link\": \"3\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,2),(12,1,'content','Moderna',2,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"CallAction\",\"data\":{\"subheader\":\"A starting theme for Continut CMS\"}}}',NULL,1,0,NULL,NULL,10),(13,2,'container','Container 3 coloane',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"3columns\",\"data\":[]}}',NULL,1,0,NULL,NULL,3),(14,2,'content','',4,13,'{\"content\":{\"extension\":\"Frontend\",\"template\":\"TextWithImage\",\"data\":{\"content\":\"<h4>H1-H6 Heading<u><\\/u> style<u><\\/u><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6><br>\"}}}',NULL,1,0,NULL,NULL,4),(15,2,'content',NULL,5,13,'{\r\n  \"content\": {\r\n    \"extension\": \"Frontend\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<table><tr><td>Cell1</td><td> Cell 2</td></tr></table><h4>Example of paragraph</h4><p><strong>Lorem ipsum dolor sit amet</strong>, consetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p><p class=\\\"lead\\\">At vero eos et accusam et justo duo dolores et eabum.</p><p><em>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </em>\\n\\t\\t\\t\\t</p>\\n\\t\\t\\t\\t<p>\\n\\t\\t\\t\\t\\t<small>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </small></p>\\t\\t\\t\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,5),(16,2,'content','Separator de linie',1,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"SolidLine\",\"data\":{\"lineType\":\"solid\"}}}',NULL,1,0,NULL,NULL,9),(17,2,'container','',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"formatColumns\":\"6\"}}}',NULL,1,0,NULL,NULL,26),(18,2,'reference',NULL,5,17,NULL,6,1,0,NULL,NULL,14),(19,2,'reference',NULL,1,0,NULL,5,1,0,NULL,NULL,0),(20,1,'content','',4,5,'{\"content\":{\"extension\":\"Frontend\",\"template\":\"TextWithImage\",\"data\":{\"content\":\"<h4>H1-H6 Heading style (modified in parent)<br><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6>\"}}}',NULL,1,0,NULL,NULL,3),(21,1,'content',NULL,5,5,'{\r\n  \"content\": {\r\n    \"extension\": \"Frontend\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<h4>H1-H6 Heading style</h4><h1>Heading H1</h1><h2>HeadingH2</h2><h3>Heading H3</h3><h4>Heading H4</h4><h5>Heading H5</h5><h6>Heading H6</h6>\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,3);
/*!40000 ALTER TABLE `sys_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_domain_urls`
--

DROP TABLE IF EXISTS `sys_domain_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_domain_urls` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'domain uid',
  `parent_uid` int(11) DEFAULT NULL COMMENT 'uid of main domain, if it is an alias',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the url pointing to this domain',
  `is_alias` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this an alias domain or is it a main domain?',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_domain_urls`
--

LOCK TABLES `sys_domain_urls` WRITE;
/*!40000 ALTER TABLE `sys_domain_urls` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_domain_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_domains`
--

DROP TABLE IF EXISTS `sys_domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_domains` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'the domain uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the domain label',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the domain active?',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting order of the domains',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_domains`
--

LOCK TABLES `sys_domains` WRITE;
/*!40000 ALTER TABLE `sys_domains` DISABLE KEYS */;
INSERT INTO `sys_domains` VALUES (1,'www.fim-live.com',1,0),(2,'www.hautehorlogerie.org',1,1),(3,'www.tagaviation.com',1,2);
/*!40000 ALTER TABLE `sys_domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_file_metadata`
--

DROP TABLE IF EXISTS `sys_file_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_file_metadata` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `file_uid` int(11) DEFAULT NULL COMMENT 'link to sys_files uid record',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file title metadata',
  `caption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file caption metadata',
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file alt metadata',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_file_metadata`
--

LOCK TABLES `sys_file_metadata` WRITE;
/*!40000 ALTER TABLE `sys_file_metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_file_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_file_mounts`
--

DROP TABLE IF EXISTS `sys_file_mounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_file_mounts`
--

LOCK TABLES `sys_file_mounts` WRITE;
/*!40000 ALTER TABLE `sys_file_mounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_file_mounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_files`
--

DROP TABLE IF EXISTS `sys_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_files`
--

LOCK TABLES `sys_files` WRITE;
/*!40000 ALTER TABLE `sys_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_frontend_usergroups`
--

DROP TABLE IF EXISTS `sys_frontend_usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_frontend_usergroups` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_frontend_usergroups`
--

LOCK TABLES `sys_frontend_usergroups` WRITE;
/*!40000 ALTER TABLE `sys_frontend_usergroups` DISABLE KEYS */;
INSERT INTO `sys_frontend_usergroups` VALUES (1,'Test FE usergroup',NULL,0);
/*!40000 ALTER TABLE `sys_frontend_usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_frontend_users`
--

DROP TABLE IF EXISTS `sys_frontend_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_frontend_users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  `is_active` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_frontend_users`
--

LOCK TABLES `sys_frontend_users` WRITE;
/*!40000 ALTER TABLE `sys_frontend_users` DISABLE KEYS */;
INSERT INTO `sys_frontend_users` VALUES (1,'ramo','pass311',1,0,1);
/*!40000 ALTER TABLE `sys_frontend_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_languages`
--

DROP TABLE IF EXISTS `sys_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_languages` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `domain_uid` int(11) unsigned NOT NULL COMMENT 'the domain this language belongs to',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code of the language',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title shown in the dropdowns',
  `sorting` int(11) unsigned DEFAULT NULL COMMENT 'display order of languages',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'country flag to use in the backend',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_languages`
--

LOCK TABLES `sys_languages` WRITE;
/*!40000 ALTER TABLE `sys_languages` DISABLE KEYS */;
INSERT INTO `sys_languages` VALUES (1,1,'rou','Română',0,'ro'),(2,1,'fra','Français',1,'fr'),(3,2,'rou','Română',0,'ro'),(4,2,'eng','English',1,'gb'),(5,3,'eng','English',0,'gb');
/*!40000 ALTER TABLE `sys_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_pages`
--

DROP TABLE IF EXISTS `sys_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_pages` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'page unique id',
  `parent_uid` int(11) unsigned DEFAULT NULL COMMENT 'the parent page uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page title',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code for the language',
  `is_in_menu` tinyint(1) DEFAULT '1' COMMENT 'is the page shown in the frontend menu?',
  `is_visible` tinyint(1) DEFAULT '0' COMMENT 'is the page visible?',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the page deleted?',
  `domain_uid` int(11) DEFAULT NULL COMMENT 'the domain this page belongs to',
  `frontend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout template to be used by this page',
  `backend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout used in the backend',
  `cached_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'cached breadcrumb path',
  `sorting` int(11) unsigned DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page slug',
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Meta keywords',
  `meta_description` text COLLATE utf8_unicode_ci COMMENT 'Meta description',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_pages`
--

LOCK TABLES `sys_pages` WRITE;
/*!40000 ALTER TABLE `sys_pages` DISABLE KEYS */;
INSERT INTO `sys_pages` VALUES (1,0,'Comics HAC!BD','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php','',1,'comics-hac-bd','comics,hac,benzi desenate,revista hac','Meta descrierea paginii vine aici.\r\nBlablabla'),(2,1,'Revista HAC!','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','1',13,'revista-hac',NULL,NULL),(3,1,'Albume HAC!BD','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','1',15,'albumele-hac',NULL,NULL),(4,0,'Abonamente HAC!BD','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','1',2,'abonamente-hacbd',NULL,NULL),(5,0,'Alt BD','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','12,4,1',3,'alt-bd',NULL,NULL),(6,5,'The Walking Dead RO','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',34,'the-walking-dead-ro',NULL,NULL),(7,5,'Albume BD','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',35,'albume-bd',NULL,NULL),(8,5,'Indie Comics','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',36,'indie-comics',NULL,NULL),(9,0,'Haine','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',10,'haine',NULL,NULL),(10,9,'Tricouri Fete','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','9',52,'tricouri-fete',NULL,NULL),(11,9,'Tricouri Băieţi','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','9',53,'tricouri-baieti',NULL,NULL),(12,1,'De-ale capului','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','4,1',16,'de-ale-capului',NULL,NULL),(13,0,'Postere','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',6,'postere',NULL,NULL),(14,13,'Postere HAC!BD','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','13',47,'postere-hacbd',NULL,NULL),(15,0,'Cărţi','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',11,'carti',NULL,NULL),(16,5,'Altele','rou',1,1,0,1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',37,'altele',NULL,NULL),(17,0,'Test homepage','rou',1,0,0,2,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',50,'test-homepage',NULL,NULL),(18,17,'Test subpage','rou',0,0,0,2,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','17',51,'test-subpage',NULL,NULL);
/*!40000 ALTER TABLE `sys_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_sessions`
--

DROP TABLE IF EXISTS `sys_user_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_sessions` (
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique php session id',
  `session_data` text COLLATE utf8_unicode_ci COMMENT 'session data',
  `session_expires` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'type of user, BackendUser or FrontendUser',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_sessions`
--

LOCK TABLES `sys_user_sessions` WRITE;
/*!40000 ALTER TABLE `sys_user_sessions` DISABLE KEYS */;
INSERT INTO `sys_user_sessions` VALUES ('0emq01jukovquvlbgb7oorbl52','user_id|s:1:\"1\";fullname|s:17:\"Amazing Sniperman\";',1434306665,NULL,NULL);
/*!40000 ALTER TABLE `sys_user_sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-01 11:27:06
