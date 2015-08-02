<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 21:30
 * Project: Conţinut CMS
 */
namespace Extensions\System\Frontend\Classes\Domain\Model\Content {

	use Core\Utility;
	use Extensions\System\Frontend\Classes\Domain\Model\FrontendContent;

	class FrontendPluginContent extends FrontendContent {
		/**
		 * Outputs "plugin" content
		 *
		 * @param mixed $elements
		 *
		 * @return string
		 */
		public function render($elements) {
			$configuration = json_decode($this->getValue(), TRUE);

			return Utility::callPlugin(
				$configuration["plugin"]["extension"],
				$configuration["plugin"]["controller"],
				$configuration["plugin"]["action"],
				$configuration["plugin"]["settings"]
			);
		}
	}

}
