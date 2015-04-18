<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 11.04.2015 @ 17:50
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Domain\Model {

	use Core\System\Domain\Model\Content;
	use Core\Utility;

	class BackendContent extends Content {

		/**
		 * Outputs "regular" content, of type "content" in the database
		 *
		 * @return string
		 */
		public function getContentValue() {
			$title = $this->getTitle();
			if (!empty($title)) {
				$title = "<div class='panel-heading'><strong>$title</strong></div>";
			}
			$value = $this->truncate(strip_tags($this->getValue()), 200);
			return "<div class='panel panel-backend-content'>" . $title . "<div class='panel-body'>$value</div></div>";
		}

		/**
		 * Outputs "plugin" content
		 *
		 * @return string The output of the plugin call
		 * @throws \Core\Tools\Exception
		 */
		public function getPluginValue() {
			$title = $this->getTitle();
			if (!empty($title)) {
				$title = "<div class='panel-heading'><strong>$title</strong></div>";
			}
			$configuration = json_decode($this->getValue(), TRUE);

			$extensionSettings = Utility::getExtensionSettings($configuration["plugin"]["extension"]);

			if (isset($extensionSettings["plugins"][$configuration["plugin"]["identifier"]])) {
				$modulePreviewSettings = $extensionSettings["plugins"][$configuration["plugin"]["identifier"]]["preview"];
				$value = Utility::callPlugin(
					$configuration["plugin"]["extension"],
					$modulePreviewSettings["controller"],
					$modulePreviewSettings["action"],
					$configuration["plugin"]["settings"]
				);
			} else {
				$value =
					"Extension: " . $configuration["plugin"]["extension"] .
					" | Action: " . $configuration["plugin"]["controller"] .
					"->" . $configuration["plugin"]["action"];
			}
			return "<div class='panel panel-backend-content'>" . $title . "<div class='panel-body'>$value</div></div>";
		}

		/**
		 * Outputs "container" content
		 *
		 * @param $elements Chidren elements to render
		 *
		 * @return mixed
		 * @throws \Core\Tools\Exception
		 */
		public function getContainerValue($elements) {
			$title = $this->getTitle();
			if (!empty($title)) {
				$title = "<div class='panel-heading'><strong>$title</strong></div>";
			}

			$configuration = json_decode($this->getValue(), TRUE);

			$container = Utility::createInstance("\\Core\\Mvc\\View\\BackendContainer");
			//$container->setLayout($this->getPage()->getLayout());
			$container->setElements($elements);
			$container->setTemplate(
				Utility::getResource(
					$configuration["container"]["template"],
					$configuration["container"]["extension"],
					"Backend",
					"Container"
					)
			);
			$value = $container->render();

			return $title . "<div class='panel-body'>$value</div>";;
		}

		private function truncate($text, $chars = 25) {
			$initialText = $text;
			$text = $text . " ";
			$text = substr($text, 0, $chars);
			$text = substr($text, 0, strrpos($text, " "));
			if (strlen($text) < strlen($initialText)) {
				$text = $text . "...";
			}
			return $text;
		}
	}

}
