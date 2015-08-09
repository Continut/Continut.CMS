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

	use Core\Tools\DatabaseException;
	use Core\Tools\ErrorException;
	use Core\Tools\Exception;
	use Core\Tools\HttpException;

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
		 * @var \Core\System\Session\UserSession Current user session data
		 */
		static $session = NULL;

		/**
		 * @var array List of helpers loaded
		 */
		static $helpers = [];

		/**
		 * @var string Application scope, Frontend or Backend
		 */
		static $applicationScope;

		/**
		 * @var \Extensions\System\Debug\DebugBar\StandardDebugBar
		 */
		static $debug;

		/**
		 * @var array Configuration array
		 */
		static $configuration;

		/**
		 * @var Core\System\Domain\Model\Site
		 */
		static $site;

		/**
		 * @var string Application environment, Development, Test or Production
		 */
		static $applicationEnvironment;

		const SCOPE_BACKEND = "Backend";

		const SCOPE_FRONTEND = "Frontend";

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
				throw new ErrorException("The PHP class you are trying to load does not exist: " . $classToLoad, 30000001);
			}
			return new $classToLoad();
		}

		/**
		 * @return string
		 */
		public static function getApplicationScope() {
			return static::$applicationScope;
		}

		/**
		 * @return string
		 */
		public static function getApplicationEnvironment() {
			return static::$applicationEnvironment;
		}

		/**
		 * @param $applicationScope
		 * @param $applicationEnvironment
		 */
		public static function setApplicationScope($applicationScope, $applicationEnvironment) {
			static::$applicationScope = $applicationScope;
			static::$applicationEnvironment = $applicationEnvironment;

			// load environment configuration
			require_once (__ROOTCMS__ . "/Extensions/configuration.php");

			// convert the multiarray to a 2d array
			$recursiveArray = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($config[$applicationEnvironment]));
			$result = array();
			foreach ($recursiveArray as $leaf) {
				$keys = array();
				foreach (range(0, $recursiveArray->getDepth()) as $depth) {
					$keys[] = $recursiveArray->getSubIterator($depth)->key();
				}
				$result[ join('/', $keys) ] = $leaf;
			}
			static::$configuration = $result;
			Utility::debugData($result, "config");

			unset($config);

			// Set multibyte encoding to utf-8 and use the mb_ functions for proper multilanguage handling
			// see: http://php.net/manual/en/ref.mbstring.php
			mb_internal_encoding("UTF-8");
		}

		/**
		 * @param string $path Return configuration path
		 *
		 * @return mixed|null
		 */
		public static function getConfiguration($path) {
			if (isset(static::$configuration[$path])) {
				return static::$configuration[$path];
			}
			// TODO: throw an exception
			return null;
		}

		/**
		 * @param string $path
		 * @param mixed $value
		 */
		public static function setConfiguration($path, $value) {
			static::$configuration[$path] = $value;
		}

		/**
		 * Create a database handler and connect to the database
		 *
		 * @throws \Core\Tools\Exception
		 */
		public static function connectToDatabase() {
			try {
				$pdo = new \PDO(
					static::getConfiguration("Database/Connection"),
					static::getConfiguration("Database/Username"),
					static::getConfiguration("Database/Password")
				);
				// if debugging is enabled
				if (static::getConfiguration("System/Debug/Enabled")) {
					static::$databaseHandler = new \Extensions\System\Debug\DebugBar\DataCollector\PDO\TraceablePDO($pdo);
					static::debug()->addCollector(new \Extensions\System\Debug\DebugBar\DataCollector\PDO\PDOCollector(static::$databaseHandler));
				} else {
					static::$databaseHandler = $pdo;
				}
				static::$databaseHandler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
			catch (\PDOException $e) {
				throw new DatabaseException("Cannot connect to the database. Please check username, password and host", 20000001);
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
		public static function getDatabase() {
			return static::$databaseHandler;
		}

		/**
		 * @throws Exception
		 */
		public static function setCurrentWebsite() {
			$domainUrls = Utility::createInstance("Core\\System\\Domain\\Collection\\DomainUrlCollection")
				->findByUrl($_SERVER["HTTP_HOST"]);

			if ($domainUrls->isEmpty()) {
				throw new HttpException(404, "The domain you are currently trying to access is not configured inside the CMS application!");
			} else {
				$domainUrl = $domainUrls->getFirst();
				static::$site = Utility::createInstance("Core\\System\\Domain\\Model\\Site")
					->setDomainUrl($domainUrl);
			}
		}

		/**
		 * @return Core\System\Domain\Model\Site
		 */
		public static function getSite() {
			return static::$site;
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
		 * Return currentu user session
		 * 
		 * @return System\Session\UserSession
		 */
		public static function getSession() {
			return static::$session;
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
					throw new ErrorException("configuration.json file not found for extension " . $folderName);
				}
				// also load localizations for the extension, if available
				static::helper("Localization")->loadLabelsFromFile($folderPath . DS . "labels_" . strtolower(static::$applicationScope) .  ".json");
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
		 * Execute a plugin method and return it's output as a string
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
			$controller = static::getController($contextExtension, $contextController, $contextAction, $contextSettings);

			$content = $controller->getRenderOutput();

			return $content;
		}

		/**
		 * Call a controller and return it's reference
		 *
		 * @param string $contextExtension  Name of the extension to look for
		 * @param string $contextController Controller name to execute
		 * @param string $contextAction     The action to execute
		 * @param mixed  $contextSettings   Additional settings to be passed to the plugin
		 *
		 * @return mixed
		 * @throws Tools\Exception
		 */
		public static function getController($contextExtension, $contextController, $contextAction, $contextSettings = []) {
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
				throw new ErrorException("The action you are trying to call does not exist for this controller", 30000002);
			}

			// then execute it's action
			$controller->setAction($contextAction);

			$contextScope = $controller->getScope();
			$controller
				->getView()
				->setTemplate(
					static::getResource("$templateController/$templateAction", $contextExtension, $contextScope, "Template")
				);

			return $controller;
		}

		public static function getTemplateFileFromPath($extensionName, $type = "Templates", $pathToFile = "", $scope = "Frontend") {
			$extensionType = static::getExtensionSettings($extensionName)["type"];
			return __ROOTCMS__ . "/Extensions/$extensionType/$extensionName/Resources/Private/$scope/$type/$pathToFile";
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

			/*if (!file_exists($resourcePath)) {
				throw new \Core\Tools\Exception("Resource cannot be found: " . $resourcePath);
			}*/

			return $resourcePath;
		}

		/**
		 * Return a Public asset, be it a CSS file, JS file or anything inside Resources/Public
		 * @param string $resourceName
		 * @param string $contextExtension
		 *
		 * @return string
		 * @throws Tools\Exception
		 */
		public static function getAssetPath($resourceName, $contextExtension) {
			$extensionType = static::getExtensionSettings($contextExtension)["type"];

			$resourcePath = "Extensions/$extensionType/$contextExtension/Resources/Public/$resourceName";

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

		/**
		 * Return a helper by name
		 *
		 * @param $helperName
		 */
		public static function helper($helperName) {
			if (!isset(static::$helpers[$helperName])) {
				static::$helpers[$helperName] = static::createInstance("\\Core\\System\\Helper\\$helperName");
			}
			return static::$helpers[$helperName];
		}

		/**
		 * Sets a debug message/value, if debugging is enabled
		 *
		 * @param mixed  $value
		 * @param string $type  Type of debug info to set
		 * @param string $label
		 */
		public static function debugData($value, $type, $label = "") {
			if (static::getConfiguration("System/Debug/Enabled")) {
				switch ($type) {
					case "config":
						Utility::debug()->addCollector(new \Extensions\System\Debug\DebugBar\DataCollector\ConfigCollector($value));
						break;
					case "exception":
						Utility::debug()['exceptions']->addException($value);
						break;
					case "start":
						Utility::debug()['time']->startMeasure($value, $label);
						break;
					case "stop":
						Utility::debug()['time']->stopMeasure($value);
						break;
					case "error":
						Utility::debug()['messages']->error($value);
						break;
					default: // message
						Utility::debug()['messages']->info($value);
				}
			}
		}

		/**
		 * Returns the debug object
		 *
		 * @return \Extensions\System\Debug\DebugBar\StandardDebugBar
		 */
		public static function debug() {
			if (!static::$debug) {
				static::$debug = new \Extensions\System\Debug\DebugBar\StandardDebugBar();
			}
			return static::$debug;
		}

		/**
		 * Debug data for Ajax calls
		 */
		public static function debugAjax() {
			if (static::$debug) {
				static::$debug->sendDataInHeaders();
			}
		}
	}
}
