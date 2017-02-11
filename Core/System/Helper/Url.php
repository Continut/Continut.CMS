<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 13.04.2015 @ 22:07
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Helper;

use Continut\Core\Utility;

class Url
{

    /**
     * Returns a link to a certain action
     *
     * @param        $extension
     * @param string $controller
     * @param string $action
     * @param array $additionalArguments
     *
     * @return string Final url
     */
    public function linkToAction($extension, $controller = "Index", $action = "index", $additionalArguments = [])
    {
        $params = [
            "_extension" => $extension,
            "_controller" => $controller,
            "_action" => $action
        ];
        $params = array_merge($params, $additionalArguments);

        return $this->linkTo($params);
    }

    /**
     * Returns a manual link to an action or to any page
     *
     * @param $params
     *
     * @return string Final url
     */
    public function linkTo($params)
    {
        $index = "/index.php";
        if (Utility::getApplicationScope() == Utility::SCOPE_BACKEND) {
            $index = "/admin.php";
        }
        return $index . "?" . http_build_query($params);
    }

    /**
     * Frontend link to a page by using it's id
     *
     * @param int $pageId id of the page to link to
     *
     * @return string
     */
    public function linkToPage($pageId)
    {
        $params = [
            "_extension" => "Frontend",
            "_controller" => "Index",
            "_action" => "index",
            "pid" => $pageId
        ];
        return $this->linkTo($params);
    }

    /**
     * @return string
     */
    public function linkToHome()
    {
        //return $this->linkToAction("Frontend", "Index", "index");
        // TODO modify method to incorporate the domain url settings
        return "";
    }

    /**
     * Frontend link to a certaing slug
     * //TODO Add additional parameters, language, etc
     *
     * @param $slug
     *
     * @return mixed
     */
    public function linkToSlug($slug)
    {
        return Utility::getRequest()->getUrlGenerator()->generate('page_slug', ['slug' => $slug]);
    }

    /**
     * Generates a link to a path
     *
     * @param string $path Path name
     * @param array $params path params
     * @return string
     */
    public function linkToPath($path, $params = [])
    {
        return Utility::getRequest()->getUrlGenerator()->generate($path, $params);
    }

    /**
     * Backend link to menu method
     *
     * @param array $settings Menu settings from configuration.json
     * @return string
     */
    public function linkToMenu($settings)
    {
        if (isset($settings['path'])) {
            $params = isset($settings['params']) ? $settings['params'] : [];
            return $this->linkToPath($settings['path'], $params);
        } else {
            return $this->linkToAction($settings["extension"], $settings["controller"], $settings["action"]);
        }
    }
}
