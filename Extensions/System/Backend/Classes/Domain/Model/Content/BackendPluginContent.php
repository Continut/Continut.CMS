<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 19:34
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Domain\Model\Content {

	use Continut\Core\Utility;
	use Continut\Extensions\System\Backend\Classes\Domain\Model\BackendContent;

	class BackendPluginContent extends BackendContent {

		/**
		 * @param $elements Chidren elements to render
		 *
		 * @return mixed|string
		 */
		public function render($elements) {
			$title = $this->getContentTitle();

			$configuration = json_decode($this->getValue(), TRUE);

			$extensionSettings = Utility::getExtensionSettings($configuration["plugin"]["extension"]);

			if (isset($extensionSettings["elements"]["plugins"][$configuration["plugin"]["identifier"]])) {
				$modulePreviewSettings = $extensionSettings["elements"]["plugins"][$configuration["plugin"]["identifier"]]["backend"];
				$value = Utility::callPlugin(
					$configuration["plugin"]["extension"],
					$modulePreviewSettings["controller"],
					$modulePreviewSettings["action"],
					$configuration["plugin"]["data"]
				);
			} else {
				$value =
					"Extension: " . $configuration["plugin"]["extension"] .
					" | Action: " . $configuration["plugin"]["controller"] .
					"->" . $configuration["plugin"]["action"];
			}
			return $this->formatBlock("plugin", $title, $value);
		}
	}

}
