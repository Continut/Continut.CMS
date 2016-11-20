<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.04.2015 @ 22:10
 * Project: Conţinut CMS
 */
namespace Continut\Core {

    use Continut\Core\Tools\ErrorException;
    use Continut\Core\Tools\Exception;
    use Continut\Core\Tools\HttpException;
    use Continut\Core\Tools\DatabaseException;

    /**
     * Class Utility
     *
     * @package Continut\Core
     */
    class Utility
    {
        /**
         * @var array List of class mappings defined in extension configuration
         */
        static $classMappings = [];
        /**
         * @var array Array storing all the extension's configuration
         */
        static $extensionsConfiguration = [];

        /**
         * @var \Continut\Core\Mvc\Request Request variable
         */
        static $request;

        /**
         * @var \PDO Database handler
         */
        static $databaseHandler = NULL;

        /**
         * @var \Continut\Core\System\Cache\FileCache
         */
        static $cacheHandler = NULL;

        /**
         * @var \Continut\Core\System\Domain\Model\UserSession Current user session data
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
         * @var \DebugBar\StandardDebugBar
         */
        static $debug;

        /**
         * @var array Configuration array
         */
        static $configuration;

        /**
         * @var \Continut\Core\System\Domain\Model\Site
         */
        static $site;

        /**
         * @var \Continut\Core\Tools\Autoloader Autoloader class
         */
        static $autoloader;

        /**
         * @var \Intervention\Image\ImageManager ImageManager class
         */
        static $imageManager;

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
        public static function createInstance($classToLoad)
        {
            $class = $classToLoad;

            // @TODO : implement a class mapper so overwriting is easily done in the configuration.json
            if (array_key_exists($classToLoad, static::$classMappings)) {
                $class = static::$classMappings[$classToLoad];
            }

            return new $class();
        }

        /**
         * @return string
         */
        public static function getApplicationScope()
        {
            return static::$applicationScope;
        }

        /**
         * @return string
         */
        public static function getApplicationEnvironment()
        {
            return static::$applicationEnvironment;
        }

        /**
         * @param $applicationScope
         * @param $applicationEnvironment
         */
        public static function setApplicationScope($applicationScope, $applicationEnvironment)
        {
            static::$applicationScope = $applicationScope;
            static::$applicationEnvironment = $applicationEnvironment;

            // load environment configuration
            require_once(__ROOTCMS__ . "/Extensions/configuration.php");

            // convert the multiarray to a 2d array
            // $config is defined inside configuration.php
            // @TODO: add a check if $config is defined or if it is valid
            $recursiveArray = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($config[$applicationEnvironment]));
            $result = array();
            // transform the multiarray as a flat "x/y/z" array
            foreach ($recursiveArray as $leaf) {
                $keys = array();
                foreach (range(0, $recursiveArray->getDepth()) as $depth) {
                    $keys[] = $recursiveArray->getSubIterator($depth)->key();
                }
                $result[join('/', $keys)] = $leaf;
            }
            // store the basic configuration from the file. It will be later on merged with the other configuration
            // options defined in the database
            static::$configuration = $result;
            static::debugData($result, "config");

            unset($config);

            static::$imageManager = new \Intervention\Image\ImageManager();

            // Set multibyte encoding to utf-8 and use the mb_ functions for proper multilanguage handling
            // see: http://php.net/manual/en/ref.mbstring.php
            mb_internal_encoding("UTF-8");
        }

        /**
         * @param string $path Return configuration path
         *
         * @return mixed|null
         */
        public static function getConfiguration($path)
        {
            if (isset(static::$configuration[$path])) {
                return static::$configuration[$path];
            }
            // @TODO: throw an exception
            return null;
        }

        /**
         * @param string $path
         * @param mixed  $value
         */
        public static function setConfiguration($path, $value)
        {
            static::$configuration[$path] = $value;
        }

        /**
         * Create a database handler and connect to the database
         *
         * @throws \Continut\Core\Tools\Exception
         */
        public static function connectToDatabase()
        {
            try {
                $pdo = new \PDO(
                    static::getConfiguration("Database/Connection"),
                    static::getConfiguration("Database/Username"),
                    static::getConfiguration("Database/Password"),
                    array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );
                // if debugging is enabled
                if (static::getConfiguration("System/Debug/Enabled")) {
                    static::$databaseHandler = new \DebugBar\DataCollector\PDO\TraceablePDO($pdo);
                    static::debug()->addCollector(new \DebugBar\DataCollector\PDO\PDOCollector(static::$databaseHandler));
                } else {
                    static::$databaseHandler = $pdo;
                }
                static::$databaseHandler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw new DatabaseException("Cannot connect to the database. Please check username, password and host", 20000001);
            }
        }

        /**
         * Disconnect from database
         */
        public static function disconnectFromDatabase()
        {
            static::$databaseHandler = NULL;
        }

        /**
         * @return \PDO
         */
        public static function getDatabase()
        {
            return static::$databaseHandler;
        }

        /**
         * @throws Exception
         */
        public static function setCurrentWebsite()
        {
            $domainUrls = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection')
                ->findByUrl($_SERVER["SERVER_NAME"]);

            if ($domainUrls->isEmpty()) {
                throw new HttpException(404, "The domain you are currently trying to access is not configured inside the CMS application!");
            } else {
                $domainUrl = $domainUrls->getFirst();
                static::$site = Utility::createInstance('Continut\Core\System\Domain\Model\Site')
                    ->setDomainUrl($domainUrl);
            }
        }

        /**
         * @return \Continut\Core\System\Domain\Model\Site
         */
        public static function getSite()
        {
            return static::$site;
        }

        /**
         * @return Mvc\Request instace
         * @throws Tools\Exception
         */
        public static function getRequest()
        {
            if (static::$request == null) {
                static::$request = static::createInstance('Continut\Core\Mvc\Request');
            }
            return static::$request;
        }

        /**
         * Return currentu user session
         *
         * @return System\Domain\Model\UserSession
         */
        public static function getSession()
        {
            return static::$session;
        }

        /**
         * Return subdirectories of a directory as an array
         *
         * @param string $path Parent directory to scan
         *
         * @return array
         */
        public static function getSubdirectories($path)
        {
            $directories = array_diff(scandir($path), [".", ".."]);
            $list = [];

            foreach ($directories as $value) {
                if (is_dir($path . DS . $value)) {
                    $list[$path . DS . $value] = $value;
                }
            }

            return $list;
        }

        /**
         * Loads all configuration files found in extensions residing in a certain folder
         *
         * @var string $path Absolute path in which to look for extensions configuration
         * @var string $type Type of extensions to load configuration for (System or Local)
         *
         * @throws Tools\Exception
         */
        public static function loadExtensionsConfigurationFromFolder($path, $type = "Local")
        {
            $extensionFolders = static::getSubdirectories($path . DS . $type);
            foreach ($extensionFolders as $folderPath => $folderName) {
                if (!file_exists($folderPath . DS . "configuration.json")) {
                    throw new ErrorException("configuration.json file not found for extension " . $folderName);
                }
                // also load localizations for the extension, if available
                static::helper("Localization")->loadLabelsFromFile($folderPath . DS . "labels_" . strtolower(static::$applicationScope) . ".json");
                $jsonData = json_decode(file_get_contents($folderPath . DS . "configuration.json"), true);
                if ($jsonData === null) {
                    throw new ErrorException("configuration.json file is empty or contains invalid json data. Please check syntax or remove the file if it is empty. Extension: " . $folderName);
                } else {
                    static::$extensionsConfiguration = array_merge(static::$extensionsConfiguration, $jsonData);
                }
            }

            // Register autoloaders
            // @TODO Move these lines into their own initialisation method
            foreach (static::$extensionsConfiguration as $extName => $extValues) {
                if (isset($extValues["autoloader"])) {
                    foreach ($extValues["autoloader"] as $autoloader) {
                        $path = __ROOTCMS__ . DS . $autoloader["path"];
                        $namespace = $autoloader["namespace"];
                        Utility::$autoloader->addNamespace($namespace, $path);
                    }
                }
            }
        }

        /**
         * Return the complete configuration of an extension or the entire configuration of all extensions
         *
         * @param string $extensionName
         *
         * @return mixed/null
         */
        public static function getExtensionSettings($extensionName = "")
        {
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
         * @param string $contextExtension Name of the extension to look for
         * @param string $contextController Controller name to execute
         * @param string $contextAction The action to execute
         * @param mixed  $contextSettings Additional settings to be passed to the plugin
         *
         * @return mixed
         * @throws Tools\Exception
         */
        public static function callPlugin($contextExtension, $contextController, $contextAction, $contextSettings = [])
        {
            $controller = static::getController($contextExtension, $contextController, $contextAction, $contextSettings);

            $content = $controller->getRenderOutput();

            return $content;
        }

        /**
         * Call a controller and return it's reference
         *
         * @param string $contextExtension Name of the extension to look for
         * @param string $contextController Controller name to execute
         * @param string $contextAction The action to execute
         * @param mixed  $contextSettings Additional settings to be passed to the plugin
         *
         * @return mixed
         * @throws Tools\Exception
         */
        public static function getController($contextExtension, $contextController, $contextAction, $contextSettings = [])
        {
            $templateAction = $contextAction;
            $templateController = $contextController;
            $contextController .= "Controller";
            $contextAction .= "Action";

            $extensionType = static::getExtensionSettings($contextExtension)["type"];
            $classToLoad = "Continut\\Extensions\\$extensionType\\$contextExtension\\Classes\\Controllers\\$contextController";

            // Instantiate the controller
            $controller = Utility::createInstance($classToLoad);
            $controller
                ->setName($templateController)
                ->setAction($templateAction)
                ->setExtension($contextExtension);
            $controller->data = $contextSettings;

            // and call it's action method, if it exists
            if (!method_exists($controller, $contextAction)) {
                throw new ErrorException("The action you are trying to call does not exist for this controller", 30000002);
            }

            $contextScope = $controller->getScope();

            $controller
                ->getView()
                ->setTemplate(
                    static::getResource("$templateController/$templateAction", $contextExtension, $contextScope, "Template")
                );

            return $controller;
        }

        public static function getTemplateFileFromPath($extensionName, $type = "Templates", $pathToFile = "", $scope = "Frontend")
        {
            $extensionType = static::getExtensionSettings($extensionName)["type"];
            return __ROOTCMS__ . "/Extensions/$extensionType/$extensionName/Resources/Private/$scope/$type/$pathToFile";
        }

        /**
         * @param string $resourceName Name of the resource to load (template filename, container filename, etc)
         * @param string $contextExtension Name of the extension that holds the resource
         * @param string $resourcePlacement Placement of the resource, either in Backend or Frontend
         * @param string $resourceType Type of resource (Template, Container, Partial, Layout) - in singular form
         *
         * @throws \Continut\Core\Tools\Exception
         *
         * @return string Absolute path to the resource to load
         */
        public static function getResource($resourceName, $contextExtension, $resourcePlacement = "Frontend", $resourceType = "Template")
        {
            $extensionType = static::getExtensionSettings($contextExtension)["type"];

            $resourceExtension = "." . strtolower($resourceType) . ".php";
            $resourceType = $resourceType . "s";
            $resourcePath = __ROOTCMS__ . "/Extensions/$extensionType/$contextExtension/Resources/Private/$resourcePlacement/$resourceType/$resourceName$resourceExtension";

            /*if (!file_exists($resourcePath)) {
                throw new \Continut\Core\Tools\Exception("Resource cannot be found: " . $resourcePath);
            }*/

            return $resourcePath;
        }

        /**
         * Return a Public asset, be it a CSS file, JS file or anything inside Resources/Public
         *
         * @param string $resourceName
         * @param string $contextExtension
         *
         * @return string
         * @throws Tools\Exception
         */
        public static function getAssetPath($resourceName, $contextExtension)
        {
            $extensionType = static::getExtensionSettings($contextExtension)["type"];

            $resourcePath = "Extensions/$extensionType/$contextExtension/Resources/Public/$resourceName";

            return $resourcePath;
        }

        /**
         * Moves a key before another key
         *
         * @param array $array
         * @param string $beforeKey
         * @param string $newKey
         * @param array $newValue
         *
         * @return array
         */
        public static function arrayMoveBefore($array, $beforeKey, $newKey, $newValue)
        {
            if (array_key_exists($beforeKey, $array)) {
                unset($array[$newKey]);
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
         * Moves a key after another key
         *
         * @param array $array
         * @param string $afterKey
         * @param string $newKey
         * @param mixed $newValue
         *
         * @return array
         */
        public static function arrayMoveAfter($array, $afterKey, $newKey, $newValue)
        {
            if (array_key_exists($afterKey, $array)) {
                unset($array[$newKey]);
                $temp = [];
                foreach ($array as $key => $value) {
                    $temp[$key] = $value;
                    if ($key === $afterKey) {
                        $temp[$newKey] = $newValue;
                    }
                }
                return $temp;
            }
            return $array;
        }

        /**
         * Returns the current cache handler
         *
         * @return \Continut\Core\System\Cache\CacheInterface
         * @throws Tools\Exception
         */
        public static function getCache()
        {
            if (static::$cacheHandler === NULL) {
                static::$cacheHandler = static::createInstance('Continut\Core\System\Cache\FileCache');
            }
            return static::$cacheHandler;
        }

        /**
         * Return a helper by name
         *
         * @param $helperName
         *
         * @return mixed Helper class instance
         */
        public static function helper($helperName)
        {
            if (!isset(static::$helpers[$helperName])) {
                static::$helpers[$helperName] = static::createInstance("Continut\\Core\\System\\Helper\\$helperName");
            }
            return static::$helpers[$helperName];
        }

        /**
         * Sets a debug message/value, if debugging is enabled
         *
         * @param mixed  $name
         * @param string $type Type of debug info to set
         */
        public static function debugData($name, $type)
        {
            if (static::getConfiguration("System/Debug/Enabled")) {
                try {
                    switch ($type) {
                        case "config":
                            static::debug()->addCollector(new \DebugBar\DataCollector\ConfigCollector($name));
                            break;
                        case "exception":
                            static::debug()['exceptions']->addException($name);
                            break;
                        case "start":
                            static::debug()['time']->startMeasure($name);
                            break;
                        case "stop":
                            static::debug()['time']->stopMeasure($name);
                            break;
                        case "error":
                            static::debug()['messages']->error($name);
                            break;
                        default: // message
                            static::debug()['messages']->info($name);
                    }
                } catch (\DebugBar\DebugBarException $e) {
                    //throw new Exception("Debugbar");
                }
            }
        }

        /**
         * Returns the debug object
         *
         * @return \DebugBar\StandardDebugBar
         */
        public static function debug()
        {
            if (!static::$debug) {
                static::$debug = new \DebugBar\StandardDebugBar();
            }
            return static::$debug;
        }

        /**
         * Debug data for Ajax calls
         */
        public static function debugAjax()
        {
            if (static::$debug) {
                static::$debug->sendDataInHeaders();
            }
        }

        /**
         * Returns the list of configured layouts for the FE and BE
         *
         * @return array
         */
        public static function getLayouts()
        {
            $layouts = array();

            $settings = static::getExtensionSettings("");
            foreach ($settings as $extensionName => $params) {
                if (isset($params["ui"]["layout"])) {
                    foreach ($params["ui"]["layout"] as $layoutId => $layoutData) {
                        $layouts[$extensionName][$extensionName . "." . $layoutId] = static::helper("Localization")->translate($layoutData["label"]);
                    }
                }
            }

            return $layouts;
        }

        /**
         * @param      $string
         * @param bool $capitalizeFirstCharacter
         *
         * @see http://stackoverflow.com/questions/2791998/convert-dashes-to-camelcase-in-php
         *
         * @return mixed
         */
        public static function toCamelCase($string, $capitalizeFirstCharacter = FALSE)
        {

            $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

            if (!$capitalizeFirstCharacter) {
                $str = lcfirst($str);
            }

            return $str;
        }

        /**
         * Recursive merge arrays while removing duplicate keys
         *
         * @param array $array1
         * @param array $array2
         * @return array Merged array
         */
        public static function arrayMergeRecursiveUnique($array1, $array2) {
            if (empty($array1)) return $array2; //optimize the base case

            foreach ($array2 as $key => $value) {
                if (is_array($value) && is_array(@$array1[$key])) {
                    $value = self::arrayMergeRecursiveUnique($array1[$key], $value);
                }
                $array1[$key] = $value;
            }
            return $array1;
        }

        /**
         * Generate a slug from a string
         *
         * @param string $string Original string
         * @return string Slug generated from original string
         */
        public static function generateSlug($string) {
            // needs the "intl" extension
            $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
            return str_replace(' ', '-', $string);
        }

        /**
         * Current software version
         *
         * @return string
         */
        public static function getVersion() {
            return '1.0.0';
        }
    }
}
