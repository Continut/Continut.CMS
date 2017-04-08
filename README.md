# README #

Getting started with Conţinut CMS

### What is Conţinut CMS? ###

Conţinut CMS aims to be an easy to use and easy to extend low to midlevel CMS system with builtin multidomain, multilanguage and responsive support. Different Backend and Frontend layouts as well as different containers can be created and inserted recursively on any page allowing you to create that ultimate design you always wanted to.
Elements in the backend can be moved using drag and drop and the entire backend is responsive, so you can start modifying your website wherever you are and whatever device you are using.
Every part of the system has been created in such a way as to ease development and to make it easy to extend almost any part of the system. Plugin support is added for any content element and all the parts of the CMS use MVC to show content and bind things together. Lookup our extended documentation pages and you will not regret your choice.

I hope you will have as much fun using Conţinut CMS as I had developing it.

### How do I get set up? ###

*Please note*: A simplified click installer is almost completed and will greatly simplify the installation procedure. For the moment it has do be done manually. 

1. Git clone the project: `https://github.com/Continut/Continut.CMS.git`
2. Import the database schema using your favourite MySql client. The sql file is located inside `Sql/dump.sql`
3. Create a file called **configuration.php** inside the **Extensions** folder, so the file path would be *Extensions/configuration.php*. 
Inside this file place the following lines

		$config = [
    		"Development" => [
    			"Database" => [
    				"Connection" => "mysql:host=YOUR_HOST;dbname=YOUR_DATABASE_NAME",
    				"Username"   => "YOUR_DB_USERNAME",
    				"Password"   => "YOUR_DB_PASSWORD"
    			],
    			"System" => [
    				"Locale" => "fr_FR",
    				"Debug" => [
    					"Enabled" => TRUE,
    					"IpMask"  => ""
    				]
    			]
    		],
    		"Test" => [
    			"Database" => [
    				"Connection" => "mysql:host=YOUR_HOST;dbname=YOUR_DATABASE_NAME",
    				"Username"   => "YOUR_DB_USERNAME",
    				"Password"   => "YOUR_DB_PASSWORD"
    			],
    			"System" => [
    				"Locale" => "ro_RO"
    			]
    		],
    		"Production" => [
    			"Database" => [
    				"Connection" => "mysql:host=YOUR_HOST;dbname=YOUR_DATABASE_NAME",
    				"Username"   => "YOUR_DB_USERNAME",
    				"Password"   => "YOUR_DB_PASSWORD"
    			],
    			"System" => [
    				"Locale" => "ro_RO"
    			]
    		]
    	];
    
3. Configure the database connection using the MySql username, password and host that you have setup. By default the index.php
and admin.php files use the **Development** environment, so you can place your database **Connection** string, **Username** and **Password** in that section.
4. Access the frontend by calling your_domain/ (domains are setup in the application's admin interface or during the first install)
5. Access the backend by calling your_domain/admin/

This should be it. **You're good to go** :)

### How and with who do I get in touch? ###

* Radu Mogoş (cms@continut.org)

QA website, documentation and support website coming soon.