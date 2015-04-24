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
			$title = $this->getContentTitle();
			$value = Utility::helper('String')->truncate(Utility::helper('String')->stripTags($this->getValue()), 200);
			return $this->formatBlock("content", $title, $value);
		}

		/**
		 * Outputs "plugin" content
		 *
		 * @return string The output of the plugin call
		 * @throws \Core\Tools\Exception
		 */
		public function getPluginValue() {
			$title = $this->getContentTitle();

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
			return $this->formatBlock("plugin", $title, $value);
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
			$title = $this->getContentTitle();

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

			return $this->formatBlock("container", $title, $value);
		}

		/**
		 * Returns the title of a content element or a dummy text, if no title is defined
		 *
		 * @return string
		 */
		protected function getContentTitle() {
			$title = $this->getTitle();

			if ($title == "") {
				$title = Utility::helper("Localization")->translate("backend.content.noTitle");
			}

			return $title;
		}

		/**
		 * Renders the backend editable part of a content element
		 *
		 * @param string $type    The type of content element we're formating
		 * @param string $title   The title of the content element, if any
		 * @param string $content The content of the element
		 *
		 * @return string
		 */
		protected function formatBlock($type, $title, $content) {
			$linkToEdit   = sprintf('<a title="%s" class="btn btn-default content-operation-link" href="%s"><i class="fa fa-pencil fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.edit"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "edit", ["uid" => $this->getUid()])
			);

			$linkToDelete = sprintf('<a title="%s" class="btn btn-danger content-operation-link" href="%s"><i class="fa fa-trash-o fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.delete"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "delete", ["uid" => $this->getUid()])
			);

			$linkToCopy   = sprintf('<a title="%s" class="btn btn-default content-operation-link" href="%s"><i class="fa fa-copy fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.copy"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "copy", ["uid" => $this->getUid()])
			);

			$linkToHide   = sprintf('<a title="%s" class="btn btn-default content-operation-link" href="%s"><i class="fa fa-eye fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.hide"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["uid" => $this->getUid(), "show" => 0])
			);

			$linkToShow   = sprintf('<a title="%s" class="btn btn-default content-operation-link" href="%s"><i class="fa fa-eye-slash text-danger fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.show"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["uid" => $this->getUid(), "show" => 1])
			);

			if ($this->getIsVisible()) {
				$visibilityLink = $linkToHide;
				$visibilityClass = "panel-visible";
			} else {
				$visibilityLink = $linkToShow;
				$visibilityClass = "panel-hidden";
				$title .= Utility::helper("Localization")->translate("backend.content.headerIsHidden");
			}

			$operationLinks = sprintf('<div class="btn-group btn-group-sm pull-right" role="group" aria-label="Element actions">%s</div>',
				$linkToEdit . $linkToCopy . $visibilityLink . $linkToDelete);

			$moveElementLink = sprintf('<a class="btn btn-default btn-sm drag-controller" title="%s"><i class="fa fa-fw fa-arrows"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.move")
			);

			$overallWrap = '<div class="panel panel-backend-content %s"><div class="panel-heading">%s <strong>%s</strong>%s</div><div class="panel-body">%s</div></div>';

			return sprintf($overallWrap, $visibilityClass, $moveElementLink, $title, $operationLinks, $content);
		}
	}

}