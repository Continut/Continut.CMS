<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 30.03.2015 @ 20:40
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc;

use Continut\Core\Tools\Exception;
use Continut\Core\Utility;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * Request Class Handler
 *
 * @package Continut\Core\Mvc
 */
class Request
{
    /**
     * @var array Request arguments ($_GET, $_SET, $_SESSION, etc)
     */
    protected $arguments = [];

    /**
     * @var string Controller name
     */
    protected $controller = "IndexController";

    /**
     * @var string Controller action name
     */
    protected $action = "indexAction";

    /**
     * @var string Controller extension
     */
    protected $extension = "Frontend";

    /**
     * Request format: html, json, etc
     *
     * @var string
     */
    protected $format = "html";

    /**
     * @var \Symfony\Component\Routing\RouteCollection Routes collection
     */
    protected $routes;

    /**
     * @var \Symfony\Component\Routing\RequestContext Request context
     */
    protected $routeContext;

    /**
     * @var \Symfony\Component\Routing\Generator\UrlGenerator Url generator
     */
    protected $urlGenerator;

    /**
     * Request contructor
     */
    public function __construct()
    {
        $this->setArguments(array_merge($_GET, $_POST));
    }

    /**
     * Gets the controller name
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Sets the controller name
     *
     * @param string $controller
     *
     * @throws \Continut\Core\Tools\Exception
     * @return void
     */
    public function setController($controller)
    {
        if (empty($controller)) {
            throw new Exception("No controller has been found. Are you sure a controller was passed as an argument?", 40000001);
        }
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * Gets the controller action to be called
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Sets the controller action to be called
     *
     * @param string $action
     *
     * @throws \Continut\Core\Tools\Exception
     * @return void
     */
    public function setAction($action)
    {
        if (empty($action)) {
            throw new Exception("No action has been found. Are you sure a controller action was passed as an argument?", 40000002);
        }
        $this->action = $action;
    }

    /**
     * Returns the request arguments
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Sets the request arguments
     *
     * @param array $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * Get argument value by name
     *
     * @param string $argumentName
     * @param mixed $defaultValue default value returned if argument is not set
     *
     * @return mixed
     * @throws \Continut\Core\Tools\Exception
     */
    public function getArgument($argumentName, $defaultValue = NULL)
    {
        if (!isset($this->arguments[$argumentName])) {
            if (!is_null($defaultValue)) {
                return $defaultValue;
            }
            return FALSE;
            //throw new \Continut\Core\Tools\Exception("The supplied argument name does not exist", 40000003);
        }
        return $this->arguments[$argumentName];
    }

    /**
     * Set an argument's value and check for special arguments like the controller or action
     *
     * @param $argument
     * @param $value
     *
     * @throws \Continut\Core\Tools\Exception
     */
    public function setArgument($argument, $value)
    {
        $this->arguments[$argument] = $value;
        switch ($argument) {
            case '_controller':
                $this->setController($value);
                break;
            case '_extension':
                $this->setExtension($value);
                break;
            case '_action':
                $this->setAction($value);
                break;
            case '_format':
                $this->setFormat($value);
                break;
        }
    }

    /**
     * Check if an argument is set
     *
     * @param $argumentName
     *
     * @return bool
     */
    public function hasArgument($argumentName)
    {
        return isset($this->arguments[$argumentName]);
    }

    /**
     * Return request format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set request format
     *
     * @param string $format
     *
     * @return void
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Check if it's an AJAX Request. Should work at least with jQuery
     *
     * @return bool
     */
    public function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    /**
     * Maps routing rules and dispatches the calls
     */
    public function mapRouting()
    {
        // Initialize the Symfony RouteCollection
        $this->routes = new RouteCollection();

        // Grab all our routes defined in the database
        $routeCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\RouteCollection')
            ->findAll();
        foreach ($routeCollection->getAll() as $route) {
            $routeData    = unserialize($route->getData());
            $defaults     = (isset($routeData['defaults'])) ? $routeData['defaults'] : [];
            $requirements = (isset($routeData['requirements'])) ? $routeData['requirements'] : [];
            $symfonyRoute = new Route($route->getPath(), $defaults, $requirements);

            // Add our route to the list
            $this->routes->add($route->getName(), $symfonyRoute);
        }

        $this->routeContext = new RequestContext('');

        $matcher = new UrlMatcher($this->routes, $this->routeContext);
        // @TODO - fix query string data
        $requestUri = $_SERVER['REQUEST_URI'];
        // remove the last slash from the URI if one is defined, this will make routes like /admin/ or /admin work the same way
        $requestUri = preg_replace('|/$|', '', $requestUri, 1);
        $url = strtok($requestUri, '?');
        $parameters = $matcher->match($url);

        foreach ($parameters as $parameterName => $parameterValue) {
            $this->setArgument($parameterName, $parameterValue);
        }

        $this->urlGenerator = new UrlGenerator($this->routes, $this->routeContext);
    }

    /**
     * @return \Symfony\Component\Routing\Generator\UrlGenerator
     */
    public function getUrlGenerator() {
        return $this->urlGenerator;
    }

}
