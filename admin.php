<?php

/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 30.03.2015 @ 20:40
 * Project: Conţinut CMS
 */


define("__ROOTCMS__", __DIR__);
define("DS", DIRECTORY_SEPARATOR);

require __ROOTCMS__ . DS . "Core" . DS . "Bootstrap.php";

\Continut\Core\Bootstrap::getInstance()
    ->setEnvironment("Backend", "Development") // Change this to "Production" before going LIVE
    ->connectToDatabase()
    ->initializeWebsite()
    ->loadExtensionsConfiguration()
    ->startSession()
    ->connectBackendController();