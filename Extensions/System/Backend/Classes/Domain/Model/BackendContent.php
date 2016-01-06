<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 11.04.2015 @ 17:50
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Domain\Model {

	use Continut\Core\System\Domain\Model\Content;
	use Continut\Core\Utility;

	class BackendContent extends Content {

		/**
		 * @var bool if rendered from inside a reference, certain menu elements are disabled
		 */
		protected $fromReference = FALSE;

		/**
		 * Outputs "regular" content, of type "content" in the database
		 *
		 * @param mixed $elements
		 *
		 * @return string
		 */
		public function render($elements) {
			$title = $this->getContentTitle();

			$configuration = json_decode($this->getValue(), TRUE);
			$variables = $configuration["content"]["data"];
			$view = Utility::createInstance("Continut\\Core\\Mvc\\View\\BaseView");
			$view->setTemplate(Utility::getResource(
				$configuration["content"]["template"],
				$configuration["content"]["extension"],
				"Backend",
				"Content"
			));
			$view->assignMultiple($variables);

			$value = $view->render();
			return $this->formatBlock("content", $title, $value);
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
		 * @param bool   $fromReference Rendered from inside a reference?
		 *
		 * @return string
		 */
		protected function formatBlock($type, $title, $content) {
			$linkToEdit   = sprintf('<a title="%s" class="btn btn-default content-operation-link" href="%s"><i class="fa fa-pencil fa-fw"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.edit"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "edit", ["uid" => $this->getUid()])
			);

			$linkToDelete = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-trash-o fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.delete"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "delete", ["uid" => $this->getUid()]),
				Utility::helper("Localization")->translate("backend.content.operation.delete")
			);

			$linkToCopy   = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-copy fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.copy"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "copy", ["uid" => $this->getUid()]),
				Utility::helper("Localization")->translate("backend.content.operation.copy")
			);

			$linkToHide   = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-eye fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.hide"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["uid" => $this->getUid(), "show" => 0]),
				Utility::helper("Localization")->translate("backend.content.operation.hide")
			);

			$linkToShow   = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-eye-slash fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.show"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["uid" => $this->getUid(), "show" => 1]),
				Utility::helper("Localization")->translate("backend.content.operation.show")
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
				$visibilityLink = "";
			}

			$operationLinks = sprintf('<div class="btn-group btn-group-sm pull-right no-pep" role="group" aria-label="Element actions">%s<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu" role="menu"><li>%s</li><li>%s</li><li>%s</li></div>',
				$linkToEdit, $linkToCopy, $visibilityLink, $linkToDelete);

			// not used so far, in stand by
			/*$moveElementLink = sprintf('<a class="btn btn-default btn-sm drag-controller" title="%s"><i class="fa fa-fw fa-arrows"></i></a>',
				Utility::helper("Localization")->translate("backend.content.operation.move")
			);*/

			$overallWrap = '<div id="panel-backend-content-%s" data-id="%s" class="content-type-%s panel panel-backend-content content-drag-sender %s"><div class="panel-heading"><strong>%s</strong>%s</div><div class="panel-body no-pep">%s</div></div>';

			return sprintf($overallWrap, $this->getUid(), $this->getUid(), $this->getType(), $visibilityClass, $title, $operationLinks, $content);
		}

		/**
		 * @return boolean
		 */
		public function getFromReference()
		{
			return $this->fromReference;
		}

		/**
		 * @param boolean $fromReference
		 *
		 * @return $this;
		 */
		public function setFromReference($fromReference)
		{
			$this->fromReference = $fromReference;

			return $this;
		}
	}

}
