<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 18.02.2017 @ 18:17
 * Project: Conţinut CMS
 */

namespace Continut\Core\Setup;

use Continut\Core\Mvc\View\BaseView;

/**
 * Class Installer - contains the code necessary to install the CMS for the first time
 *
 * @package Continut\Core
 */
class Installer
{
    /**
     * List of required PHP extensions
     * @TODO : check if imagick is required
     * @var array
     */
    protected $requiredExtensionsList = ['PDO', 'Reflection', 'bcmath', 'ctype', 'date', 'exif', 'fileinfo', 'filter', 'gd', 'iconv', 'intl', 'json', 'mbstring', 'pcre', 'posix', 'session', 'spl', 'standard', 'tokenizer', 'curl', 'dom', 'xml'];

    /**
     * Step 1 of the installer
     *
     * @return string
     */
    public function step1()
    {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'step1.template.php');

        return $view->render();
    }

    /**
     * Step 2 - check if all system requirements are met
     *
     * @return string
     */
    public function step2() {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'step2.template.php');

        $missingExtensions = [];
        foreach ($this->requiredExtensionsList as $extension) {
            if (!extension_loaded($extension)) {
                $missingExtensions[] = $extension;
            }
        }

        $availablePdoDrivers = [];
        if (extension_loaded('pdo')) {
            $availablePdoDrivers = \PDO::getAvailableDrivers();
        }
        $phpVersionOk          = version_compare(PHP_VERSION, '5.5.0', '>=');
        $canInstall            = ($phpVersionOk && sizeof($missingExtensions) == 0 && sizeof($availablePdoDrivers) > 0);

        $view->assignMultiple(
            [
                'phpVersion'          => PHP_VERSION,
                'phpVersionOk'        => $phpVersionOk,
                'missingExtensions'   => $missingExtensions,
                'canInstall'          => $canInstall,
                'availablePdoDrivers' => $availablePdoDrivers
            ]
        );

        return $view->render();
    }

    /**
     * Step 3 - connect to an existing database or create a new one
     *
     * @param array $params
     * @return string
     */
    public function step3($params = []) {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'step3.template.php');

        // get all loaded PDO drivers
        $availablePdoDrivers = \PDO::getAvailableDrivers();

        $view->assignMultiple(
            [
                'availablePdoDrivers' => $availablePdoDrivers,
                'params' => $params
            ]
        );

        return $view->render();
    }

    /**
     * Step 4 is an intermediary step that tests the database connection and redirects accordingly
     * @return string
     */
    public function step4() {
        $params = $_POST['params'];
        $params['error'] = '';

        $driver = $params['db_driver'];
        $host   = $params['db_host'];
        $pass   = $params['db_pass'];
        $user   = $params['db_user'];

        try {
            // the DSN for sqlite points to a file, we will take care of it in step 5
            if ($driver != 'sqlite') {
                new \Pdo("$driver:host=$host", $user, $pass);
            }
            return $this->step5($params);
        } catch (\PDOException $e) {
            $params['error'] = $e->getMessage();
            return $this->step3($params);
        }
    }

    /**
     * Create or use an existing database/sqlite file
     *
     * @param array $params
     * @return string
     */
    public function step5($params) {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'step5.template.php');

        $driver = $params['db_driver'];
        $host   = $params['db_host'];
        $pass   = $params['db_pass'];
        $user   = $params['db_user'];

        $queryDatabases = [
            'mysql' => 'SELECT schema_name FROM information_schema.schemata WHERE schema_name NOT IN (\'information_schema\',\'performance_schema\',\'mysql\')',
            'pgsql' => 'SELECT datname FROM pg_database'
        ];

        try {
            $databases = [];
            if ($driver != 'sqlite') {
                $dbh = new \Pdo("$driver:host=$host", $user, $pass);
                $dbs = $dbh->query($queryDatabases[$driver]);
                if ($dbs) {
                    while (($db = $dbs->fetchColumn(0)) !== false )
                    {
                        $databases[] = $db;
                    }
                }
            }
        } catch (\PDOException $e) {
            $params['error'] = $e->getMessage();
            $this->step4($params);
        }

        $view->assignMultiple(
            [
                'databases' => $databases,
                'params' => $params
            ]
        );

        return $view->render();
    }

    public function step6() {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'step6.template.php');

        $params = $_POST['params'];

        $driver = $params['db_driver'];
        $host   = $params['db_host'];
        $pass   = $params['db_pass'];
        $user   = $params['db_user'];

        $existingDatabase = isset($_POST['db_name']) ? $_POST['db_name'] : '';
        $newDatabase = isset($_POST['db_name_new']) ? $_POST['db_name_new'] : '';

        if (strlen(trim($newDatabase)) > 0) {
            try {
                $dbh = new \Pdo("$driver:host=$host", $user, $pass);
                $dbh->exec("CREATE DATABASE IF NOT EXISTS `$newDatabase`; USE `$newDatabase`;");
                $params['db_name'] = $newDatabase;
            } catch (\PDOException $e) {
                $params['error'] = $e->getMessage();
                return $this->step5($params);
            }
        } else {
            try {
                $dbh = new \Pdo("$driver:host=$host;dbname=$existingDatabase", $user, $pass);
                $dbh->exec("USE `$existingDatabase`");
                $params['db_name'] = $existingDatabase;
            } catch (\PDOException $e) {
                $params['error'] = $e->getMessage();
                return $this->step5($params);
            }
        }

        $config = <<<'HER'
<?php

$config = [
    "Development" => [
        "Database" => [
            "Connection" => "db_driver:host=db_host;dbname=db_name",
            "Username"   => "db_user",
            "Password"   => "db_pass"
        ],
        "System" => [
            "Locale" => "ro_RO",
            "Debug" => [
                "Enabled" => false,
                "IpMask"  => ""
            ]
        ]
    ],
    "Test" => [
        "Database" => [
            "Connection" => "db_driver:host=db_host;dbname=db_name",
            "Username"   => "db_user",
            "Password"   => "db_pass"
        ],
        "System" => [
            "Locale" => "ro_RO"
        ]
    ],
    "Production" => [
        "Database" => [
            "Connection" => "db_driver:host=db_host;dbname=db_name",
            "Username"   => "db_user",
            "Password"   => "db_pass"
        ],
        "System" => [
            "Locale" => "ro_RO"
        ]
    ]
];
HER;
        // Create the Extensions/configuration.php file
        if (!file_exists(__ROOTCMS__ . DS .'Extensions' . DS . 'configuration.php')) {
            $config = str_replace(['db_driver', 'db_host', 'db_name', 'db_user', 'db_pass'], $params, $config);
            $f = fopen(__ROOTCMS__ . DS .'Extensions' . DS . 'configuration.php', 'w');
            if (!$f) {
                $params['error'] = 'Cannot create Extensions/configuration.php file. Check permissions on root folder';
                return $this->step5($params);
            }
            fwrite($f, $config);
            fclose($f);
        } else {
            $params['error'] = 'Extensions/configuration.php file already exists. If Continut CMS was not already installed on this machine then remove the created configuration.php file and try again!';
            return $this->step5($params);
        }

        $sql = <<<'HER'
DROP TABLE IF EXISTS `sys_backend_usergroups`;
CREATE TABLE `sys_backend_usergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Backend usergroup name',
  `access` text COLLATE utf8_unicode_ci COMMENT 'json group permissions',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the usergroup deleted?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_backend_usergroups` (`id`, `title`, `access`, `is_deleted`) VALUES
(1,	'Administrators',	NULL,	0);

DROP TABLE IF EXISTS `sys_backend_users`;
CREATE TABLE `sys_backend_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'backend username',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'backend encrypted password',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT 'is the user deleted or not',
  `is_active` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the user active?',
  `usergroup_id` int(10) unsigned DEFAULT NULL COMMENT 'Backend usergroup id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user fullname',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_backend_users` (`id`, `username`, `password`, `is_deleted`, `is_active`, `usergroup_id`, `name`) VALUES
(1,	'admin',	'$2y$10$j09QNSDTp7YCJuFozNdOIu3lzp.9BaH1igFxhxoCmR/HQZ2WDaBFa',	0,	1,	1,	'Radu Mogoș');

DROP TABLE IF EXISTS `sys_cache`;
CREATE TABLE `sys_cache` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page',
  `value` text COLLATE utf8_unicode_ci,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires_at` int(11) unsigned DEFAULT NULL,
  `record_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_categories`;
CREATE TABLE `sys_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `sorting` int(11) DEFAULT '0',
  `values` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `sys_categories_relations`;
CREATE TABLE `sys_categories_relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `sys_configuration`;
CREATE TABLE `sys_configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) NOT NULL DEFAULT '0' COMMENT 'the domain to which this setting belongs to',
  `language_id` int(11) NOT NULL DEFAULT '0' COMMENT 'the language to which it belongs',
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_content`;
CREATE TABLE `sys_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `page_id` int(11) unsigned DEFAULT NULL COMMENT 'id of page where content is stored',
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'element type: plugin or content',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Title of the content element',
  `column_id` int(11) unsigned DEFAULT NULL COMMENT 'id of column where template and fields are stored',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT 'currently only used for containers, for recursivity, stores the uid of the parent container it belongs to',
  `value` text COLLATE utf8_unicode_ci COMMENT 'value of the content element',
  `reference_id` int(11) unsigned DEFAULT NULL COMMENT 'reference to another content element',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is content visible on page?',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT 'is content deleted on the page? (user for history purposes)',
  `created_at` int(11) unsigned DEFAULT NULL COMMENT 'creation utc date',
  `modified_at` int(11) unsigned DEFAULT NULL COMMENT 'modification utc date',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting of elements',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_domains`;
CREATE TABLE `sys_domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'the domain uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'the domain label',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'url used by default by the domain',
  `is_visible` tinyint(1) unsigned DEFAULT '1' COMMENT 'is the domain active?',
  `sorting` int(11) unsigned DEFAULT '0' COMMENT 'sorting order of the domains',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_domain_urls`;
CREATE TABLE `sys_domain_urls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'domain uid',
  `parent_id` int(11) DEFAULT NULL COMMENT 'parent domain url, if an alias',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the url pointing to this domain',
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Language/Url code, used in the frontend',
  `is_alias` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is this an alias domain or is it a main domain?',
  `domain_id` int(10) unsigned NOT NULL COMMENT 'uid of main domain',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'iso2 code for the flag',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title to be displayed in the frontend/backend',
  `sorting` int(10) unsigned NOT NULL COMMENT 'backend sorting order',
  `locale` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'language locale',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_files`;
CREATE TABLE `sys_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'file unique id',
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'filename',
  `filesize` int(11) unsigned DEFAULT NULL COMMENT 'filesize in bytes',
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file physical location',
  `mime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'file mime type',
  `created_at` int(11) DEFAULT NULL COMMENT 'utc creation time',
  `modified_at` int(11) DEFAULT NULL COMMENT 'utc modification time',
  `mount_id` int(11) DEFAULT NULL COMMENT 'file storage mount id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_file_mounts`;
CREATE TABLE `sys_file_mounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mount storage title',
  `folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'starting mount folder, or path',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'file' COMMENT 'mount storage type (\"file\", \"aws\", \"dropbox\", etc). by default it should be \"file\"',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'username for remote access',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'password for remote access',
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'url for remote access',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_file_mounts` (`id`, `title`, `folder`, `type`, `username`, `password`, `url`) VALUES
(1,	'Main local mount',	'/',	'file',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `sys_file_references`;
CREATE TABLE `sys_file_references` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'uid for this reference',
  `file_id` int(11) unsigned DEFAULT NULL COMMENT 'the id of the record in sys_file table',
  `foreign_id` int(11) unsigned DEFAULT NULL COMMENT 'the id of the record holding this image',
  `is_visible` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `tablename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name of the table that references this file',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Image title',
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Alt text',
  `description` text COLLATE utf8_unicode_ci COMMENT 'Image description/caption',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_frontend_usergroups`;
CREATE TABLE `sys_frontend_usergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_frontend_users`;
CREATE TABLE `sys_frontend_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  `is_active` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_languages`;
CREATE TABLE `sys_languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id',
  `domain_id` int(11) unsigned NOT NULL COMMENT 'the domain this language belongs to',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code of the language',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'title shown in the dropdowns',
  `sorting` int(11) unsigned DEFAULT NULL COMMENT 'display order of languages',
  `flag` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'country flag to use in the backend',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_notifications`;
CREATE TABLE `sys_notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Notification id',
  `message` text NOT NULL COMMENT 'Message text',
  `data` text NOT NULL COMMENT 'Serialized data for the message',
  `link` varchar(255) NOT NULL COMMENT 'Link to a detalied page',
  `user` int(11) unsigned NOT NULL COMMENT 'For which user is this notification? 0 means all',
  `created_at` int(11) unsigned NOT NULL COMMENT 'When was the notification created?',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Has the message been read?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `sys_pages`;
CREATE TABLE `sys_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'page unique id',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'the parent page uid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page title',
  `language_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iso3 code for the language',
  `original_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'uid of the original page, if this is a translated page',
  `is_in_menu` tinyint(1) DEFAULT '1' COMMENT 'is the page shown in the frontend menu?',
  `is_visible` tinyint(1) DEFAULT '0' COMMENT 'is the page visible?',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT 'is the page deleted?',
  `domain_url_id` int(11) DEFAULT NULL COMMENT 'the domain url this page belongs to',
  `layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the layout to use',
  `is_layout_recursive` tinyint(1) DEFAULT '0' COMMENT 'will this layout be inherited by any subpage created inside it',
  `frontend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout template to be used by this page - cached',
  `backend_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'layout used in the backend - cached',
  `cached_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cached breadcrumb path',
  `sorting` int(11) unsigned DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'page slug',
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Meta keywords',
  `meta_description` text COLLATE utf8_unicode_ci COMMENT 'Meta description',
  `start_date` datetime DEFAULT NULL COMMENT 'starting date when page will be visible',
  `end_date` datetime DEFAULT NULL COMMENT 'page will be visible until this date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sys_routes`;
CREATE TABLE `sys_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'path name, used when creating urls',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'actual path mapping',
  `data` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'defaults and requirements, serialized',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_routes` (`id`, `name`, `path`, `data`) VALUES
(1,	'page_id',	'/{language}/{id}',	'a:2:{s:8:\"defaults\";a:5:{s:10:\"_extension\";s:8:\"Frontend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:5:\"index\";s:8:\"language\";s:2:\"ro\";s:2:\"id\";i:0;}s:12:\"requirements\";a:2:{s:2:\"id\";s:3:\"\\d+\";s:8:\"language\";s:8:\"ro|en|fr\";}}'),
(2,	'page_slug',	'/{language}/{slug}',	'a:2:{s:8:\"defaults\";a:5:{s:10:\"_extension\";s:8:\"Frontend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:5:\"index\";s:8:\"language\";s:2:\"ro\";s:2:\"id\";i:0;}s:12:\"requirements\";a:1:{s:8:\"language\";s:8:\"ro|en|fr\";}}'),
(3,	'admin',	'/unused',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:7:\"Backend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:9:\"dashboard\";}}'),
(4,	'news_backend',	'/admin/news/{_action}',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:4:\"News\";s:11:\"_controller\";s:11:\"NewsBackend\";s:7:\"_action\";s:5:\"index\";}}'),
(5,	'editor',	'/editor/{_controller}/{_action}',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:6:\"Editor\";s:11:\"_controller\";s:6:\"Editor\";s:7:\"_action\";s:5:\"index\";}}'),
(6,	'admin_backend',	'/admin/{_controller}/{_action}',	'a:1:{s:8:\"defaults\";a:3:{s:10:\"_extension\";s:7:\"Backend\";s:11:\"_controller\";s:5:\"Index\";s:7:\"_action\";s:9:\"dashboard\";}}');

DROP TABLE IF EXISTS `sys_user_sessions`;
CREATE TABLE `sys_user_sessions` (
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique php session id',
  `session_data` text COLLATE utf8_unicode_ci COMMENT 'session data',
  `session_expires` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `user_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'type of user, BackendUser or FrontendUser',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
HER;

        $dbh->exec($sql);

        return $view->render();
    }
}