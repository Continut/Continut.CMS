<?php

function load_classes($class) {
	include $class.'.php';
}

require __DIR__ .'/Core/Bootstrap.php';

\Core\Bootstrap::getInstance()
	->loadConfiguration()
	->startOutput();

use \Local\Extensions\News\Classes\Controllers\IndexController;

$controller = new IndexController();
$controller->indexAction();

\Core\Bootstrap::getInstance()->endOutput();

$controller->render();