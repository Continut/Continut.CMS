<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 21:30
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Domain\Model\Content;

use Continut\Core\Utility;
use Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendContent;

class FrontendPluginContent extends FrontendContent
{
    /**
     * Render a "Plugin" element
     *
     * @param mixed $elements
     *
     * @return string
     */
    public function render($elements)
    {
        $value = "";

        $configuration = json_decode($this->getValue(), TRUE);
        $extensionSettings = Utility::getExtensionSettings($configuration["plugin"]["extension"]);

        if (isset($extensionSettings["elements"]["plugin"][$configuration["plugin"]["identifier"]])) {
            $modulePreviewSettings = $extensionSettings["elements"]["plugin"][$configuration["plugin"]["identifier"]]["frontend"];
            $value = Utility::callPlugin(
                $configuration["plugin"]["extension"],
                $modulePreviewSettings["controller"],
                $modulePreviewSettings["action"],
                $configuration["plugin"]["data"]
            );
        }

        return $value;
    }
}
