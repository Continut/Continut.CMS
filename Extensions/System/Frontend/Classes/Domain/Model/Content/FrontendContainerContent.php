<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 21:17
 * Project: Conţinut CMS
 */
namespace Extensions\System\Frontend\Classes\Domain\Model\Content {

	use Core\Utility;
	use Extensions\System\Frontend\Classes\Domain\Model\FrontendContent;

	class FrontendContainerContent extends FrontendContent {
		/**
		 * Outputs "regular" content, of type "content" in the database
		 *
		 * @param mixed $elements
		 *
		 * @return string
		 */
		public function render($elements) {
			$configuration = json_decode($this->getValue(), TRUE);
			$variables = $configuration["container"]["data"];

			$container = Utility::createInstance("\\Core\\Mvc\\View\\Container");
			$container->setUid($this->getUid());
			$container->setElements($elements);
			$container->setTemplate(
				Utility::getResource(
					$configuration["container"]["template"],
					$configuration["container"]["extension"],
					"Frontend",
					"Container"
				)
			);
			$container->assignMultiple($variables);
			return $container->render();
		}
	}

}
