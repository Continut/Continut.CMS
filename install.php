<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 30.03.2015 @ 20:40
 * Project: Conţinut CMS
 */

define('__ROOTCMS__', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

require_once __ROOTCMS__ . DS . 'Core' . DS . 'Tools' . DS . 'Autoloader.php';

// fire the AutoLoader
$autoloader = new \Continut\Core\Tools\Autoloader();
$autoloader->register();
$autoloader->addNamespace('Continut', __ROOTCMS__);

/* @var $installer \Continut\Core\Setup\Installer */
$installer = new \Continut\Core\Setup\Installer();
$step = (isset($_GET['step'])) ? trim(htmlspecialchars($_GET['step'])) : 'run';
echo $installer->$step();
