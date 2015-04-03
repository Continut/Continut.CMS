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

			if (array_key_exists($classToLoad, self::$classMappings)) {
				$class = self::$classMappings[$classToLoad];
			}
			if (!file_exists($class.".php")) {
				throw new Tools\Exception("The PHP class you are trying to load does not exist: " . $classToLoad, 30000001);
			}
			return new $class();
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
		 */
		public static function loadExtensionsConfigurationFromFolder($path) {
			$extensionFolders = static::getSubdirectories($path);
			foreach ($extensionFolders as $folderPath => $folderName) {
				static::$extensionsConfiguration = array_merge(static::$extensionsConfiguration, json_decode(file_get_contents($folderPath . DS . "configuration.json"), true));
			}
		}

		/**
		 * Return the complete configuration of an extension
		 *
		 * @param string $extensionName
		 *
		 * @return mixed/null
		 */
		public static function getExtensionSettings($extensionName) {
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
			$contextController .= "Controller";
			$contextAction     .= "Action";

			$extensionType = static::getExtensionSettings($contextExtension)["type"];
			$classToLoad = "Extensions\\$extensionType\\$contextExtension\\Classes\\Controllers\\$contextController";

			// Instantiate the controller
			$controller = Utility::createInstance($classToLoad);

			// and call it's action method, if it exists
			if (!method_exists($controller, $contextAction)) {
				throw new Tools\Exception("The action you are trying to call does not exist for this controller", 30000002);
			}

			// then execute it's action
			$controller->$contextAction();

			$viewContent = $controller->getView()->render();

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

			$extension = "." . strtolower($resourceType) . ".php";
			$resourceType = $resourceType . "s";
			$resourcePath = __ROOTCMS__ . "/Extensions/$extensionType/$contextExtension/Resources/Private/$resourcePlacement/$resourceType/$resourceName$extension";

			if (!file_exists($resourcePath)) {
				throw new \Core\Tools\Exception("Resource cannot be found: " . $resourcePath);
			}

			return $resourcePath;
		}
	}

}
