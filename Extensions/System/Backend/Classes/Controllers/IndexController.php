<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Continut\Extensions\System\Backend\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

/**
 * Backend main controller
 *
 * @package System\Backend\Classes\Controllers
 */
class IndexController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource('Default', 'Backend', 'Backend', 'Layout'));
    }

    /**
     * Main dashboard action
     *
     * @return string
     */
    public function dashboardAction()
    {
        // load the chart.js file for the dashboard
        $this->getPageView()->addJsAsset(['identifier' => 'chart-js', 'extension' => 'Backend', 'file' => 'chart-js/Chart.js', 'after' => 'jquery']);

        $this->getView()->assign('user', $this->getUser());
    }

    /**
     * Render the Backend mainmenu based on configuration done in the configuration.json file of every extension
     * The backend menu items and submenu items are configured inside the "backend" key
     */
    public function mainmenuAction()
    {
        $allExtensionsSettings = Utility::getExtensionSettings();

        $mainMenu = [];
        $secondaryMenu = [];

        foreach ($allExtensionsSettings as $extensionName => $configuration) {
            if (isset($configuration['backend'])) {
                if (isset($configuration['backend']['mainMenu'])) {
                    $mainMenu = array_merge_recursive($mainMenu, $configuration['backend']['mainMenu']);
                }
                if (isset($configuration['backend']['secondaryMenu'])) {
                    $secondaryMenu = array_merge_recursive($secondaryMenu, $configuration['backend']['secondaryMenu']);
                }
            }
        }

        // the 'position' attribute defines the order in which the menus will be drawn
        // from smaller to bigger (left to right, or top to bottom if on a vertical menu)
        foreach ($mainMenu as $menuId => $menu) {
            // if no position is set, set 900 by default, so that it is one of the last to render in the menu
            if (!isset($menu['position'])) {
                $mainMenu[$menuId]['position'] = 900;
            }
        }

        usort($mainMenu, function ($item1, $item2) {
            if ($item1['position'] == $item2['position']) return 0;
            return $item1['position'] < $item2['position'] ? -1 : 1;
        });

        $this->getView()->assign('mainMenu', $mainMenu);
        $this->getView()->assign('secondaryMenu', $secondaryMenu);
    }

    public function notificationsAction() {

    }
}
