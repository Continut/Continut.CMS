--
-- File generated with SQLiteStudio v3.0.5 on S apr. 18 11:31:31 2015
--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: sys_domains
CREATE TABLE sys_domains (uid INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR (255), is_visible BOOLEAN DEFAULT (0), sorting INTEGER);

-- Table: sys_languages
CREATE TABLE sys_languages (uid INTEGER PRIMARY KEY AUTOINCREMENT, domain_uid INTEGER, language_iso3 VARCHAR (3), title VARCHAR (255), sorting INTEGER, flag VARCHAR (2));

-- Table: sys_user_sessions
CREATE TABLE sys_user_sessions (session_id VARCHAR (255), session_data TEXT, session_expires INTEGER (0), user_id INTEGER, user_type VARCHAR (100));

-- Table: sys_pages
CREATE TABLE sys_pages (uid INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_uid INTEGER (11), title VARCHAR (255) NOT NULL, language_iso3 VARCHAR (3) NOT NULL, is_visible BOOLEAN DEFAULT (0), is_deleted BOOLEAN DEFAULT (0), domain_uid INTEGER (11) DEFAULT (0), frontend_layout VARCHAR (255), backend_layout VARCHAR (255), cached_path VARCHAR (255));

-- Table: sys_content
CREATE TABLE sys_content (uid INTEGER PRIMARY KEY AUTOINCREMENT, page_uid INTEGER, type VARCHAR (100), "column" INTEGER, parent_uid INTEGER, value TEXT, is_visible BOOLEAN DEFAULT (0), is_deleted BOOLEAN DEFAULT (0), created_at INTEGER, modified_at INTEGER, title VARCHAR (255));

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
