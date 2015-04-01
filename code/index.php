<?php

/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 30.03.2015 @ 20:40
 * Project: Conţinut CMS
 */

// @TODO Move to own class
function load_classes($class) {
	include $class.'.php';
}

require __DIR__ .'/Core/Bootstrap.php';

\Core\Bootstrap::getInstance()
	->loadConfiguration()
	->connectToDatabase()
	->startOutput();

$request = new \Core\Mvc\Request();

$class = 'Extensions\\Local\\'.$request->getArgument('extension').'\\Classes\\Controllers\\'.$request->getArgument('controller');
$action = $request->getArgument('action');
$controller = new $class();
$controller->$action();

\Core\Bootstrap::getInstance()->endOutput()->disconnectDatabase();
$controller->render();
