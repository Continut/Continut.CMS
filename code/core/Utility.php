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
		 * @param $classToLoad Full namespace and class name to load
		 *
		 * @throws \Core\Tools\Exception
		 *
		 * @return mixed
		 */
		public static function createInstance($classToLoad) {
			$class = $classToLoad;
			self::$classMappings["\\Core\\Mvc\\Model\\Content"] = "\\Extensions\\Local\\News\\Classes\\Domain\\Model\\NewsContent";
			if (array_key_exists($classToLoad, self::$classMappings)) {
				$class = self::$classMappings[$classToLoad];
			}
			if (!file_exists($class.".php")) {
				throw new \Core\Tools\Exception("The PHP class you are trying to load does not exist", 30000001);
			}
			return new $class();
		}

		/**
		 * @return Core\Mvc\Request instace
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
		 * @param $path string Parent directory to scan
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
		 * @param $extensionName
		 *
		 * @return mixed/null
		 */
		public static function getExtensionSettings($extensionName) {
			if (isset(static::$extensionsConfiguration[$extensionName])) {
				return static::$extensionsConfiguration[$extensionName];
			}
			return NULL;
		}
	}

}
