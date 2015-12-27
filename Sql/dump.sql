/*
SQLyog Community v11.31 (64 bit)
MySQL - 5.6.12-log : Database - continutcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `sys_backend_usergroups` */

DROP TABLE IF EXISTS `sys_backend_usergroups`;

CREATE TABLE `sys_backend_usergroups` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Backend usergroup name',
  `access` text COLLATE utf8_unicode_ci COMMENT 'json group permissions',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the usergroup deleted?',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_backend_usergroups` */

/*Table structure for table `sys_backend_users` */

DROP TABLE IF EXISTS `sys_backend_users`;

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

/*Data for the table `sys_backend_users` */

insert  into `sys_backend_users`(`uid`,`username`,`password`,`is_deleted`,`is_active`,`usergroup_id`,`name`) values (1,'admin','admin',0,1,NULL,'Amazing Sniperman');

/*Table structure for table `sys_cache` */

DROP TABLE IF EXISTS `sys_cache`;

CREATE TABLE `sys_cache` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page',
  `value` text COLLATE utf8_unicode_ci,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires_at` int(11) unsigned DEFAULT NULL,
  `record_uid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_cache` */

/*Table structure for table `sys_content` */

DROP TABLE IF EXISTS `sys_content`;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_content` */

insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (1,1,'content','Fully Responsive',6,7,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-desktop fa-3x\",\"link\":\"4\",\"content\":\"<p>Blablabla, hope it works.<br>Now, on to the second paragraph :)<br>\\u015ei acum s\\u0103 \\u00eencerc\\u0103m ni\\u015fte caractere scrise \\u00een limba rom\\u00e2n\\u0103 cu diacritice.<br>Se pare ca merge<br><\\/p>\"}}}',NULL,1,0,NULL,NULL,1);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (2,4,'plugin',NULL,4,13,'{\r\n  \"plugin\": {\r\n    \"extension\": \"News\",\r\n    \"identifier\": \"news\",\r\n    \"controller\": \"Index\",\r\n    \"action\": \"index\",\r\n    \"settings\": {\r\n      \"limit\": 2,\r\n      \"categories\": \"3,11,201,22,500\"\r\n    },\r\n    \"data\":{ \"limit\":4}\r\n  }\r\n}',NULL,1,0,NULL,NULL,12);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (3,1,'container','Awesome title',2,0,'{\r\n  \"container\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"4columns\",\r\n    \"data\": \"\"\r\n  }\r\n}',NULL,0,1,NULL,NULL,12);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (4,1,'content','公募プログラムガイドライン',7,7,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"Box\",\r\n    \"data\": {\r\n      \"content\": \"<p>について事業を行っています。これらの分野には、それぞれ公募プログラムがあり、国際交流事業を企画を実施する個人や団体に対して、助成金、研究奨学金（フェローシップ 「はじめて申請される方へ」をお読みください。</p>\",\r\n      \"icon\": \"fa fa-pagelines fa-3x\",\r\n      \"link\": \"4\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,1);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (5,1,'container','50% stanga, 50% dreapta',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"formatColumns\":\"6\"}}}',NULL,1,0,NULL,NULL,27);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (6,1,'content','Lovely day',5,7,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',NULL,1,0,NULL,NULL,4);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (7,1,'container','4 elements',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"4columns\",\"data\":{\"formatColumns\":\"1\"}}}',NULL,1,0,NULL,NULL,25);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (8,2,'plugin','Afişare ultimele articole',6,13,'{\"plugin\":{\"extension\":\"News\",\"template\":\"show\",\"controller\":\"Index\",\"identifier\":\"news\",\"action\":\"show\",\"settings\":{\"limit\":4,\"categories\":\"3,11,201,22,500\"},\"data\":{\"limit\":\"4\"}}}',NULL,1,0,NULL,NULL,5);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (9,1,'container','Container cu 1 coloană',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"1column\",\"data\":[]}}',NULL,1,0,NULL,NULL,29);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (10,1,'content','2 elements follow now :)',4,9,'{\r\n  \"content\": {\r\n    \"extension\": \"Frontend\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<div class=\\\"repository-meta js-details-container \\\">\\n    <div class=\\\"repository-description\\\">\\n      Tiny bootstrap-compatible WISWYG rich text editor\\n    </div>\\n\\n\\n\\n</div>\\n\\n<div class=\\\"overall-summary overall-summary-bottomless\\\">\\n\\n  <div class=\\\"stats-switcher-viewport js-stats-switcher-viewport\\\">\\n    <div class=\\\"stats-switcher-wrapper\\\">\\n    <ul class=\\\"numbers-summary\\\">\\n      <li class=\\\"commits\\\">\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/commits/master\\\">\\n            <span class=\\\"octicon octicon-history\\\"></span>\\n            <span class=\\\"num text-emphasized\\\">\\n              67\\n            </span>\\n            commits\\n        </a>\\n      </li>\\n      <li>\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/branches\\\">\\n          <span class=\\\"octicon octicon-git-branch\\\"></span>\\n          <span class=\\\"num text-emphasized\\\">\\n            2\\n          </span>\\n          branches\\n        </a>\\n      </li>\\n\\n      <li>\\n        <a data-pjax href=\\\"/mindmup/bootstrap-wysiwyg/releases\\\">\\n          <span class=\\\"octicon octicon-tag\\\"></span>\\n          <span class=\\\"num text-emphasized\\\">\\n            0\\n          </span>\\n          releases\\n        </a>\\n      </li>\\n\\n      <li>\\n        \\n  <a href=\\\"/mindmup/bootstrap-wysiwyg/graphs/contributors\\\">\\n    <span class=\\\"octicon octicon-organization\\\"></span>\\n    <span class=\\\"num text-emphasized\\\">\\n      8\\n    </span>\\n    contributors\\n  </a>\\n      </li>\\n    </ul>\\n\\n      <div class=\\\"repository-lang-stats\\\">\\n        <ol class=\\\"repository-lang-stats-numbers\\\">\\n          <li>\\n              <a href=\\\"/mindmup/bootstrap-wysiwyg/search?l=javascript\\\">\\n                <span class=\\\"color-block language-color\\\" style=\\\"background-color:#f1e05a;\\\"></span>\\n                <span class=\\\"lang\\\">JavaScript</span>\\n                <span class=\\\"percent\\\">99.3%</span>\\n              </a>\\n          </li>\\n        </ol>\\n      </div>\\n    </div>\\n  </div>\\n\\n</div>\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,2);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (11,1,'content','Lorem ipsum',4,7,'{\r\n  \"content\": {\r\n    \"extension\": \"ThemeBootstrapModerna\",\r\n    \"template\": \"Box\",\r\n    \"data\": {\r\n      \"content\": \"<p>Lorem ipsum <strong>dolor sit amec</strong> and all the rest of the latin phrases used for text formating should just follow along.<br/>Voluptatem accusantium doloremque laudantium sprea totam rem aperiam.</p>\",\r\n      \"icon\": \"fa fa-edit fa-3x\",\r\n      \"link\": \"3\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,1);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (12,1,'content','Moderna',2,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"CallAction\",\"data\":{\"subheader\":\"A starting theme for Continut CMS\"}}}',NULL,1,0,NULL,NULL,14);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (13,2,'container','Container 3 coloane, care si merge :)',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"3columns\",\"data\":{\"limit\":4}}}',NULL,1,0,NULL,NULL,6);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (14,2,'content','',4,13,'{\"content\":{\"extension\":\"Frontend\",\"template\":\"TextWithImage\",\"data\":{\"content\":\"<h4>H1-H6 Heading<u><\\/u> style<u><\\/u><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6><br>\"}}}',NULL,1,0,NULL,NULL,8);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (15,2,'content',NULL,5,13,'{\r\n  \"content\": {\r\n    \"extension\": \"Frontend\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<table><tr><td>Cell1</td><td> Cell 2</td></tr></table><h4>Example of paragraph</h4><p><strong>Lorem ipsum dolor sit amet</strong>, consetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p><p class=\\\"lead\\\">At vero eos et accusam et justo duo dolores et eabum.</p><p><em>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </em>\\n\\t\\t\\t\\t</p>\\n\\t\\t\\t\\t<p>\\n\\t\\t\\t\\t\\t<small>\\n\\t\\t\\t\\t\\tConsetetur sadipscing elitr, sed diam non mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </small></p>\\t\\t\\t\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,11);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (16,2,'content','Separator de linie',1,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"SolidLine\",\"data\":{\"lineType\":\"solid\"}}}',NULL,1,0,NULL,NULL,13);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (17,2,'container','',1,0,'{\"container\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"2columns\",\"data\":{\"formatColumns\":\"6\"}}}',NULL,1,0,NULL,NULL,30);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (18,2,'reference',NULL,5,17,NULL,6,1,0,NULL,NULL,20);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (19,2,'reference',NULL,1,0,NULL,5,1,0,NULL,NULL,0);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (20,1,'content','',4,5,'{\"content\":{\"extension\":\"Frontend\",\"template\":\"TextWithImage\",\"data\":{\"content\":\"<h4>H1-H6 Heading style (modified in parent)<br><\\/h4><h1>Heading H1<\\/h1><h2>HeadingH2<\\/h2><h3>Heading H3<\\/h3><h4>Heading H4<\\/h4><h5>Heading H5<\\/h5><h6>Heading H6<\\/h6>\"}}}',NULL,1,0,NULL,NULL,7);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (21,1,'content',NULL,5,5,'{\r\n  \"content\": {\r\n    \"extension\": \"Frontend\",\r\n    \"template\": \"TextWithImage\",\r\n    \"data\": {\r\n      \"content\": \"<h4>H1-H6 Heading style</h4><h1>Heading H1</h1><h2>HeadingH2</h2><h3>Heading H3</h3><h4>Heading H4</h4><h5>Heading H5</h5><h6>Heading H6</h6>\"\r\n    }\r\n  }\r\n}',NULL,1,0,NULL,NULL,8);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (22,17,'content','Showing off from another domain :) Sweeeet',1,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',NULL,1,0,NULL,NULL,0);
insert  into `sys_content`(`uid`,`page_uid`,`type`,`title`,`column_id`,`parent_uid`,`value`,`reference_uid`,`is_visible`,`is_deleted`,`created_at`,`modified_at`,`sorting`) values (23,19,'content',NULL,1,0,'{\"content\":{\"extension\":\"ThemeBootstrapModerna\",\"template\":\"Box\",\"data\":{\"icon\":\"fa fa-code fa-3x\",\"link\":\"4\",\"content\":\"<p>I should be showing in the right side of a subcontainer or maybe in the middle.<br>Some dummy text is used as always to fill in the gaps and create the feeling that this is an important section.<\\/p>\"}}}',NULL,1,0,NULL,NULL,0);

/*Table structure for table `sys_domain_urls` */

DROP TABLE IF EXISTS `sys_domain_urls`;

CREATE TABLE `sys_domain_urls` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'domain uid',
  `parent_uid` int(11) DEFAULT NULL COMMENT 'parent domain url, if an alias',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the url pointing to this domain',
  `is_alias` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this an alias domain or is it a main domain?',
  `domain_uid` int(10) unsigned NOT NULL COMMENT 'uid of main domain',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'iso2 code for the flag',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title to be displayed in the frontend/backend',
  `sorting` int(10) unsigned NOT NULL COMMENT 'backend sorting order',
  `locale` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'language locale',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_domain_urls` */

insert  into `sys_domain_urls`(`uid`,`parent_uid`,`url`,`is_alias`,`domain_uid`,`flag`,`title`,`sorting`,`locale`) values (1,NULL,'cms.dev',0,1,'ro','Română',0,'ro_RO');
insert  into `sys_domain_urls`(`uid`,`parent_uid`,`url`,`is_alias`,`domain_uid`,`flag`,`title`,`sorting`,`locale`) values (2,NULL,'fim-live.fr',0,1,'fr','Français',1,'fr_FR');
insert  into `sys_domain_urls`(`uid`,`parent_uid`,`url`,`is_alias`,`domain_uid`,`flag`,`title`,`sorting`,`locale`) values (3,NULL,'d2.test',0,2,'ro','Limba română',0,'ro_RO');

/*Table structure for table `sys_domains` */

DROP TABLE IF EXISTS `sys_domains`;

CREATE TABLE `sys_domains` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'the domain uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the domain label',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'url used by default by the domain',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the domain active?',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting order of the domains',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_domains` */

insert  into `sys_domains`(`uid`,`title`,`url`,`is_visible`,`sorting`) values (1,'Test Website','fim-live.com',1,0);
insert  into `sys_domains`(`uid`,`title`,`url`,`is_visible`,`sorting`) values (2,'Federation de la Haute Horlogerie','d2.test',1,1);
insert  into `sys_domains`(`uid`,`title`,`url`,`is_visible`,`sorting`) values (3,'TAG Aviation','tag.test',1,2);

/*Table structure for table `sys_file_metadata` */

DROP TABLE IF EXISTS `sys_file_metadata`;

CREATE TABLE `sys_file_metadata` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `file_uid` int(11) DEFAULT NULL COMMENT 'link to sys_files uid record',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file title metadata',
  `caption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file caption metadata',
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file alt metadata',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_file_metadata` */

/*Table structure for table `sys_file_mounts` */

DROP TABLE IF EXISTS `sys_file_mounts`;

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

/*Data for the table `sys_file_mounts` */

/*Table structure for table `sys_files` */

DROP TABLE IF EXISTS `sys_files`;

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

/*Data for the table `sys_files` */

/*Table structure for table `sys_frontend_usergroups` */

DROP TABLE IF EXISTS `sys_frontend_usergroups`;

CREATE TABLE `sys_frontend_usergroups` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_frontend_usergroups` */

insert  into `sys_frontend_usergroups`(`uid`,`title`,`access`,`is_deleted`) values (1,'Test FE usergroup',NULL,0);

/*Table structure for table `sys_frontend_users` */

DROP TABLE IF EXISTS `sys_frontend_users`;

CREATE TABLE `sys_frontend_users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  `is_active` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_frontend_users` */

insert  into `sys_frontend_users`(`uid`,`username`,`password`,`usergroup_id`,`is_deleted`,`is_active`) values (1,'ramo','pass311',1,0,1);

/*Table structure for table `sys_languages` */

DROP TABLE IF EXISTS `sys_languages`;

CREATE TABLE `sys_languages` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `domain_uid` int(11) unsigned NOT NULL COMMENT 'the domain this language belongs to',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code of the language',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title shown in the dropdowns',
  `sorting` int(11) unsigned DEFAULT NULL COMMENT 'display order of languages',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'country flag to use in the backend',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_languages` */

insert  into `sys_languages`(`uid`,`domain_uid`,`language_iso3`,`title`,`sorting`,`flag`) values (1,1,'rou','Română',0,'ro');
insert  into `sys_languages`(`uid`,`domain_uid`,`language_iso3`,`title`,`sorting`,`flag`) values (2,1,'fra','Français',1,'fr');
insert  into `sys_languages`(`uid`,`domain_uid`,`language_iso3`,`title`,`sorting`,`flag`) values (3,2,'rou','Română',0,'ro');
insert  into `sys_languages`(`uid`,`domain_uid`,`language_iso3`,`title`,`sorting`,`flag`) values (4,2,'eng','English',1,'gb');
insert  into `sys_languages`(`uid`,`domain_uid`,`language_iso3`,`title`,`sorting`,`flag`) values (5,3,'eng','English',0,'gb');

/*Table structure for table `sys_pages` */

DROP TABLE IF EXISTS `sys_pages`;

CREATE TABLE `sys_pages` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'page unique id',
  `parent_uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'the parent page uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page title',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code for the language',
  `original_uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'uid of the original page, if this is a translated page',
  `is_in_menu` tinyint(1) DEFAULT '1' COMMENT 'is the page shown in the frontend menu?',
  `is_visible` tinyint(1) DEFAULT '0' COMMENT 'is the page visible?',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the page deleted?',
  `domain_url_uid` int(11) DEFAULT NULL COMMENT 'the domain url this page belongs to',
  `layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the layout to use',
  `layout_recursive` tinyint(1) DEFAULT '0' COMMENT 'will this layout be inherited by any subpage created inside it',
  `frontend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout template to be used by this page - cached',
  `backend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout used in the backend - cached',
  `cached_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cached breadcrumb path',
  `sorting` int(11) unsigned DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page slug',
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Meta keywords',
  `meta_description` text COLLATE utf8_unicode_ci COMMENT 'Meta description',
  `start_date` datetime DEFAULT NULL COMMENT 'starting date when page will be visible',
  `end_date` datetime DEFAULT NULL COMMENT 'page will be visible until this date',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_pages` */

insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (1,0,'Comics HAC!BD remodif','rou',0,1,1,0,1,'ThemeBootstrapModerna.default',1,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',1,'comics-hac-bd','comics,hac,benzi desenate,revista hac','Meta descrierea paginii vine aici.\r\nBlablabla','2015-12-30 18:00:00',NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (2,1,'Revista HAC!','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','1',15,'revista-hac','meta keywords for this page','test meta description',NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (3,1,'Albume HAC!BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','1',18,'albumele-hac',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (4,0,'Abonamente HAC!BD','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php','1',2,'abonamente-hacbd','','vrei sa scrii ceva\r\nnu poti. sau poate ca poti\r\n\r\nincredibil...',NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (5,0,'Alt BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','12,4,1',4,'alt-bd',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (6,5,'The Walking Dead RO','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',38,'the-walking-dead-ro',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (7,5,'Albume BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',39,'albume-bd',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (8,5,'Indie Comics','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','5',40,'indie-comics',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (9,0,'Haine','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',11,'haine',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (10,9,'Tricouri Fete','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','9',58,'tricouri-fete',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (11,9,'Tricouri Băieţi','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','9',59,'tricouri-baieti',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (12,1,'De-ale capului','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','4,1',19,'de-ale-capului',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (13,0,'Postere','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',3,'postere',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (14,13,'Postere HAC!BD','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','13',52,'postere-hacbd',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (15,0,'Cărţi','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',12,'carti',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (16,5,'Altele','rou',0,1,1,0,1,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','',41,'altele',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (17,0,'Test homepage','rou',0,1,1,0,3,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php','',55,'test-homepage',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (18,17,'Test subpage','rou',0,1,1,0,3,NULL,0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Default.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Default.layout.php','17',56,'test-subpage',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (19,0,'Les comics HAC!BD','',1,1,1,0,2,NULL,0,NULL,NULL,'',0,'comics-hac-fr','comics,francais stuff','description de la page française',NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (20,1,'test1','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',NULL,16,'title1','','',NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (21,4,'test2','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',NULL,0,'title2','','',NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (22,4,'test12','rou',0,1,1,0,1,NULL,0,NULL,NULL,NULL,0,'title3',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (23,4,'test23','rou',0,1,1,0,1,NULL,0,NULL,NULL,NULL,0,'title4',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (24,20,'subpage1','rou',0,1,1,0,0,NULL,0,NULL,NULL,NULL,NULL,'subpage1',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (25,20,'subpage2','rou',0,1,1,0,0,NULL,0,NULL,NULL,NULL,NULL,'subpage2',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (26,0,'root1','rou',0,1,1,0,1,'ThemeBootstrapModerna.homepage',0,'/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Frontend/Layouts/Homepage.layout.php','/Extensions/Local/ThemeBootstrapModerna/Resources/Private/Backend/Layouts/Homepage.layout.php',NULL,NULL,'root1','','','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (27,0,'root2','rou',0,1,1,0,1,NULL,0,NULL,NULL,NULL,NULL,'root2',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (28,0,'root3','rou',0,1,1,0,1,NULL,0,NULL,NULL,NULL,NULL,'root3',NULL,NULL,NULL,NULL);
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (29,26,'subroot1 has changed it\'s title','rou',0,1,1,0,1,'',1,NULL,NULL,NULL,NULL,'subroot1','','','0000-00-00 00:00:00','0000-00-00 00:00:00');
insert  into `sys_pages`(`uid`,`parent_uid`,`title`,`language_iso3`,`original_uid`,`is_in_menu`,`is_visible`,`is_deleted`,`domain_url_uid`,`layout`,`layout_recursive`,`frontend_layout`,`backend_layout`,`cached_path`,`sorting`,`slug`,`meta_keywords`,`meta_description`,`start_date`,`end_date`) values (30,26,'gringo','rou',0,1,1,0,1,'',0,NULL,NULL,NULL,NULL,'gringo','','','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `sys_registry` */

DROP TABLE IF EXISTS `sys_registry`;

CREATE TABLE `sys_registry` (
  `uid` int(11) unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_registry` */

insert  into `sys_registry`(`uid`,`key`,`value`) values (0,'System/Locale','ro_RO');

/*Table structure for table `sys_user_sessions` */

DROP TABLE IF EXISTS `sys_user_sessions`;

CREATE TABLE `sys_user_sessions` (
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique php session id',
  `session_data` text COLLATE utf8_unicode_ci COMMENT 'session data',
  `session_expires` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'type of user, BackendUser or FrontendUser',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sys_user_sessions` */

insert  into `sys_user_sessions`(`session_id`,`session_data`,`session_expires`,`user_id`,`user_type`) values ('d1i39ie7p7i7k0spo5kitrbjr4','PHPDEBUGBAR_STACK_DATA|a:0:{}user_id|s:1:\"1\";fullname|s:17:\"Amazing Sniperman\";',1451240459,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
