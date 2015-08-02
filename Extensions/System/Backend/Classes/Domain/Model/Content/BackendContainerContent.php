<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 19:48
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Domain\Model\Content {

	use Core\Utility;
	use Extensions\System\Backend\Classes\Domain\Model\BackendContent;

	class BackendContainerContent extends BackendContent {

		/**
		 * Outputs "container" content
		 *
		 * @param $elements Chidren elements to render
		 *
		 * @return mixed|string
		 * @throws \Core\Tools\Exception
		 */
		public function render($elements) {
			$title = $this->getContentTitle();

			$configuration = json_decode($this->getValue(), TRUE);
			$variables = $configuration["container"]["data"];
			$container = Utility::createInstance("\\Core\\System\\View\\BackendContainer");
			//$container->setLayout($this->getPage()->getLayout());
			$container->setUid($this->getuid());
			$container->setElements($elements);
			$container->setTemplate(
				Utility::getResource(
					$configuration["container"]["template"],
					$configuration["container"]["extension"],
					"Backend",
					"Container"
				)
			);
			$container->assignMultiple($variables);
			$value = $container->render();

			return $this->formatBlock("container", $title, $value);
		}
	}

}
