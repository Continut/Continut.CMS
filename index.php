<?php

/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 30.03.2015 @ 20:40
 * Project: Conţinut CMS
 */


//memprof_enable();
function convert($size)
{
	$unit=array('b','kb','mb','gb','tb','pb');
	return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

$memory_initial = memory_get_usage(false);
$time_initial = microtime(true);

define("__ROOTCMS__", __DIR__);
define("DS", DIRECTORY_SEPARATOR);

require __ROOTCMS__ . DS . "Core" . DS . "Bootstrap.php";

\Core\Bootstrap::getInstance()
	->setEnvironment("Frontend", "Development") // Change this to "Production" before going LIVE
	->loadConfiguration()
	->connectToDatabase()
	->startSession()
	->connectController();

// Show estimative memory usage
echo "mem: " . convert(memory_get_usage(false) - $memory_initial) . "<br/>";
echo "exec: " . round((microtime(true) - $time_initial) , 4) . " sec";
//memprof_dump_callgrind(fopen("/vagrant/project/callgrind.out", "w"));