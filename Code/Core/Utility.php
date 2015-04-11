<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.04.2015 @ 22:10
 * Project: Conţinut CMS
 */
namespace Core {

	/**
	 * Class Utility
	 * @package Core
	 */
	class Utility {
		/**
		 * @var array List of class mappings defined in extension configuration
		 */
		static $classMappings = [];


		/**
		 * @var array Array storing all the extension's configuration
		 */
		static $extensionsConfiguration = [];

		/**
		 * @var \Core\Mvc\Request Request variable
		 */
		static $request;

		/**
		 * @var \PDO Database handler
		 */
		static $databaseHandler = NULL;

		/**
		 * @var \Core\System\Cache\FileCache
		 */
		static $cacheHandler = NULL;

		/**
		 * Generate an instance based on the sent class or map to an overwritten class stored in
		 * the classMappings variable
		 *
		 * @param string $classToLoad Full namespace and class name to load
		 *
		 * @throws Tools\Exception
		 *
		 * @return mixed
		 */
		public static function createInstance($classToLoad) {
			$class = $classToLoad;

			if (array_key_exists($classToLoad, static::$classMappings)) {
				$class = static::$classMappings[$classToLoad];
			}
			if (!file_exists(__ROOTCMS__ . DS . $class . ".php")) {
				throw new Tools\Exception("The PHP class you are trying to load does not exist: " . $classToLoad, 30000001);
			}
			return new $class();
		}

		/**
		 * Create a database handler and connect to the database
		 *
		 * @param string $type Database connection type: "mysql", "sqlite", etc...
		 * @throws \Core\Tools\Exception
		 */
		public static function connectToDatabase($type = "mysql") {
			try {
				static::$databaseHandler = new \PDO("mysql:host=localhost;dbname=continutcms", "root", "");
				static::$databaseHandler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
			catch (\PDOException $e) {
				throw new \Core\Tools\Exception("Cannot connect to the database. Please check username, password and host", 20000001);
			}
		}

		/**
		 * Disconnect from database
		 */
		public static function disconnectFromDatabase() {
			static::$databaseHandler = NULL;
		}

		/**
		 * @return \PDO
		 */
		public static function database() {
			return static::$databaseHandler;
		}

		/**
		 * @return Mvc\Request instace
		 * @throws Tools\Exception
		 */
		public static function getRequest() {
			if (static::$request == null) {
				static::$request = static::createInstance("\\Core\\Mvc\\Request");
			}
			return static::$request;
		}

		/**
		 * Return subdirectories of a directory as an array
		 *
		 * @param string $path Parent directory to scan
		 *
		 * @return array
		 */
		public static function getSubdirectories($path) {
			$directories = array_diff(scandir($path), [".", ".."]);
			$list = [];

			foreach($directories as $value)
			{
				if (is_dir($path . DS . $value))
				{
					$list[$path . DS . $value]= $value;
				}
			}

			return $list;
		}

		/**
		 * Loads all configuration files found in extensions residing in a certain folder
		 *
		 * @var string $path Absolute path in which to look for extensions configuration
		 *
		 * @throws Tools\Exception
		 */
		public static function loadExtensionsConfigurationFromFolder($path) {
			$extensionFolders = static::getSubdirectories($path);
			foreach ($extensionFolders as $folderPath => $folderName) {
				if (!file_exists($folderPath . DS . "configuration.json")) {
					throw new Tools\Exception("configuration.json file not found for extension " . $folderName);
				}
				static::$extensionsConfiguration = array_merge(static::$extensionsConfiguration, json_decode(file_get_contents($folderPath . DS . "configuration.json"), true));
			}
		}

		/**
		 * Return the complete configuration of an extension or the entire configuration of all extensions
		 *
		 * @param string $extensionName
		 *
		 * @return mixed/null
		 */
		public static function getExtensionSettings($extensionName = "") {
			if ($extensionName == "") {
				return static::$extensionsConfiguration;
			}
			if (isset(static::$extensionsConfiguration[$extensionName])) {
				return static::$extensionsConfiguration[$extensionName];
			}
			return NULL;
		}

		/**
		 * Execute a plugin method
		 *
		 * @param string $contextExtension  Name of the extension to look for
		 * @param string $contextController Controller name to execute
		 * @param string $contextAction     The action to execute
		 * @param mixed  $contextSettings   Additional settings to be passed to the plugin
		 *
		 * @return mixed
		 * @throws Tools\Exception
		 */
		public static function callPlugin($contextExtension, $contextController, $contextAction, $contextSettings = []) {
			$templateAction     = $contextAction;
			$templateController = $contextController;
			$contextController .= "Controller";
			$contextAction     .= "Action";

			$extensionType = static::getExtensionSettings($contextExtension)["type"];
			$classToLoad = "Extensions\\$extensionType\\$contextExtension\\Classes\\Controllers\\$contextController";

			// Instantiate the controller
			$controller = Utility::createInstance($classToLoad);
			$controller->settings = $contextSettings;

			// and call it's action method, if it exists
			if (!method_exists($controller, $contextAction)) {
				throw new Tools\Exception("The action you are trying to call does not exist for this controller", 30000002);
			}

			// then execute it's action
			$viewContent = $controller->$contextAction();

			$contextScope = $controller->getScope();
			$templateToLoad = "/Extensions/$extensionType/$contextExtension/Resources/Private/$contextScope/Templates/$templateController/$templateAction.template.php";
			$controller->getView()->setTemplate($templateToLoad);

			// allow the action to return content, if not show it's template 
			if (empty($viewContent)) {
				$viewContent = $controller->getView()->render();
			}

			return $viewContent;
		}

		/**
		 * @param string $resourceName      Name of the resource to load (template filename, container filename, etc)
		 * @param string $contextExtension  Name of the extension that holds the resource
		 * @param string $resourcePlacement Placement of the resource, either in Backend or Frontend
		 * @param string $resourceType      Type of resource (Template, Container, Partial, Layout) - in singular form
		 *
		 * @throws \Core\Tools\Exception
		 *
		 * @return string Absolute path to the resource to load
		 */
		public static function getResource($resourceName, $contextExtension, $resourcePlacement = "Frontend", $resourceType = "Template") {
			$extensionType = static::getExtensionSettings($contextExtension)["type"];

			$resourceExtension = "." . strtolower($resourceType) . ".php";
			$resourceType = $resourceType . "s";
			$resourcePath = __ROOTCMS__ . "/Extensions/$extensionType/$contextExtension/Resources/Private/$resourcePlacement/$resourceType/$resourceName$resourceExtension";

			if (!file_exists($resourcePath)) {
				throw new \Core\Tools\Exception("Resource cannot be found: " . $resourcePath);
			}

			return $resourcePath;
		}

		/**
		 * Return a Public asset, be it a CSS file, JS file or anything inside Resources/Public
		 * @param string $resourceName
		 * @param string $contextExtension
		 * @param string $additionalPath
		 *
		 * @return string
		 * @throws Tools\Exception
		 */
		public static function getAssetPath($resourceName, $contextExtension, $additionalPath = "") {
			$extensionType = static::getExtensionSettings($contextExtension)["type"];

			$resourcePath = "Extensions/$extensionType/$contextExtension/Resources/Public/$additionalPath/$resourceName";

			return $resourcePath;
		}

		/**
		 * Inserts a key + value before a certain key in an associative array
		 *
		 * @param $array
		 * @param $beforeKey
		 * @param $newKey
		 * @param $newValue
		 *
		 * @return array
		 */
		public static function arrayInsertBefore($array, $beforeKey, $newKey, $newValue) {
			if (array_key_exists($beforeKey, $array)) {
				$temp = [];
				foreach ($array as $key => $value) {
					if ($key === $beforeKey) {
						$temp[$newKey] = $newValue;
					}
					$temp[$key] = $value;
				}
				return $temp;
			}
			return $array;
		}

		/**
		 * Returns the current cache handler
		 *
		 * @return \Core\System\Cache\CacheInterface
		 * @throws Tools\Exception
		 */
		public static function getCache() {
			if (static::$cacheHandler === NULL) {
				static::$cacheHandler = static::createInstance("\\Core\\System\\Cache\\FileCache");
			}
			return static::$cacheHandler;
		}
	}
}
