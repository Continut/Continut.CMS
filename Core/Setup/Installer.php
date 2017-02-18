<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 18.02.2017 @ 18:17
 * Project: Conţinut CMS
 */

namespace Continut\Core\Setup;

use Continut\Core\Mvc\View\BaseView;

/**
 * Class Installer - contains the code necessary to install the CMS for the first time
 *
 * @package Continut\Core
 */
class Installer
{
    protected $requiredExtensionsList = ['PDO', 'Reflection', 'bcmath', 'ctype', 'date', 'exif', 'fileinfo', 'filter', 'gd', 'iconv', 'intl', 'json', 'mbstring', 'pcre', 'posix', 'session', 'spl', 'standard', 'tokenizer', 'curl', 'dom', 'imagick', 'xml'];

    public function run()
    {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'run.template.php');

        return $view->render();
    }

    public function step2() {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'step2.template.php');

        $missingExtensions = [];
        foreach ($this->requiredExtensionsList as $extension) {
            if (!extension_loaded($extension)) {
                $missingExtensions[] = $extension;
            }
        }

        $view->assignMultiple(
            [
                'phpVersion'        => PHP_VERSION,
                'phpVersionOk'      => version_compare(PHP_VERSION, '5.5.0', '>='),
                'missingExtensions' => $missingExtensions
            ]
        );

        return $view->render();
    }

    public function step3() {
        $view = new BaseView();
        $view->setTemplate(__ROOTCMS__ . DS . 'Install' . DS . 'step3.template.php');

        return $view->render();
    }
}