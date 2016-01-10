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
		 * @param mixed $elements Chidren elements to render
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
			$container->setId($this->getId());
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


		/**
		 * Renders the backend editable part of a content element
		 *
		 * @param string $type    The type of content element we're formating (deprecated, will be removed)
		 * @param string $title   The title of the content element, if any
		 * @param string $content The content of the element
		 *
		 * @return string
		 */
		protected function formatBlock($type, $title, $content) {
			$linkToEdit   = sprintf('<a title="%s" class="btn btn-default content-operation-link" href="%s"><i class="fa fa-pencil fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.edit"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "edit", ["id" => $this->getId()])
			);

			$linkToDelete = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-trash-o fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.delete"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "delete", ["id" => $this->getId()]),
				Utility::helper("Localization")->translate("backend.content.operation.delete")
			);

			$linkToCopy   = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-copy fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.copy"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "copy", ["id" => $this->getId()]),
				Utility::helper("Localization")->translate("backend.content.operation.copy")
			);

			$linkToHide   = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-eye fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.hide"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["id" => $this->getId(), "show" => 0]),
				Utility::helper("Localization")->translate("backend.content.operation.hide")
			);

			$linkToShow   = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-eye-slash text-danger fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.show"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["id" => $this->getId(), "show" => 1])
			);

			$linkNewElement = sprintf('<a class="btn btn-sm btn-success content-wizard" title="%s" href="%s"><i class="fa fa-plus fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.addNew"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "addElement", ["id" => $this->getId()])
			);

			if ($this->getIsVisible()) {
				$visibilityLink = $linkToHide;
				$visibilityClass = "panel-visible";
			} else {
				$visibilityLink = $linkToShow;
				$visibilityClass = "panel-hidden";
				$title .= Utility::helper("Localization")->translate("backend.content.headerIsHidden");
			}

			if ($this->getFromReference()) {
				$linkToCopy = "";
			}

			$operationLinks = sprintf('<div class="btn-group btn-group-sm pull-right no-pep" role="group" aria-label="Element actions">%s %s<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu" role="menu"><li>%s</li><li>%s</li><li>%s</li></div>',
				$linkNewElement,
				$linkToEdit,
				$linkToCopy,
				$visibilityLink,
				$linkToDelete);

			$overallWrap = '<div id="panel-backend-content-%s" data-id="%s" class="content-type-%s panel panel-backend-content content-drag-sender %s"><div class="panel-heading"><strong>%s</strong>%s</div><div class="panel-body no-pep">%s</div></div>';

			return sprintf($overallWrap, $this->getId(), $this->getId(), $this->getType(), $visibilityClass, $title, $operationLinks, $content);
		}
	}

}
