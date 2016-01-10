<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 20:38
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Model {

	use Continut\Core\Mvc\Model\BaseModel;
	use Continut\Core\Utility;

	/**
	 * Class Content
	 *
	 * @package Continut\Core\System\Domain\Model
	 * @Entity(repositoryClass="Continut\Core\System\Domain\Collection\ContentCollection")
	 * @Table(name="sys_content")
	 */
	class Content extends BaseModel {

		/**
		 * @var string value of the content element
		 *
		 * @Column(name="value", type="text")
		 */
		protected $value;

		/**
		 * @var string type of content element
		 *
		 * @Column(name="type", type="string")
		 */
		protected $type;

		/**
		 * @var int The uid of this element's parent
		 *
		 * @Column(type="integer", name="parent_id")
		 * @OneToOne(targetEntity="Content")
		 * @JoinColumn(name="parent_id", referencedColumnName="id")
		 */
		protected $parent;

		/**
		 * @var bool Is the content element visible?
		 *
		 * @Column(name="is_visible", type="boolean")
		 */
		protected $isVisible;

		/**
		 * @var bool Is the content element deleted?
		 *
		 * @Column(name="is_deleted", type="boolean")
		 */
		protected $isDeleted;

		/**
		 * @var int Column id
		 *
		 * @Column(name="column_id", type="integer")
		 */
		protected $columnId;

		/**
		 * @var \Continut\Core\System\Domain\Model\Page
		 *
		 * @OneToOne(targetEntity="\Continut\Core\System\Domain\Model\Page")
		 * @JoinColumn(name="page_id", referencedColumnName="id")
		 */
		protected $page;

		/**
		 * @var int The reference id, if this is a reference content element
		 * @Column(name="reference_id", type="integer")
		 */
		protected $referenceId;

		/**
		 * @var int Field used for the sorting order of content elements
		 *
		 * @Column(name="sorting", type="integer")
		 */
		protected $sorting;

		/**
		 * @var \Continut\Core\Mvc\View\PageView Link to the parent PageView
		 */
		protected $_pageView;

		/**
		 * @var string
		 *
		 * @Column(name="title", type="string")
		 */
		protected $title;

		/**
		 * @var bool if rendered from inside a reference, certain menu elements are disabled
		 */
		protected $fromReference = FALSE;

		/**
		 * @return Content Get the parent of this content element
		 */
		public function getParent() {
			return $this->parent;
		}

		/**
		 * Set parent
		 *
		 * @param Content $parent
		 *
		 * @return Content
		 */
		public function setParent($parent) {
			$this->parent = $parent;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getSorting()
		{
			return $this->sorting;
		}

		/**
		 * @param int $sorting
		 */
		public function setSorting($sorting)
		{
			$this->sorting = $sorting;
		}

		/**
		 * @return \Continut\Core\System\Domain\Model\Page
		 */
		public function getPage()
		{
			return $this->page;
		}

		/**
		 * @param \Continut\Core\System\Domain\Model\Page $page
		 *
		 * @return Content
		 */
		public function setPage($page)
		{
			$this->page = $page;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getReferenceId()
		{
			return $this->referenceId;
		}

		/**
		 * @param int $referenceId
		 *
		 * @return Content
		 */
		public function setReferenceId($referenceId)
		{
			$this->referenceId = $referenceId;

			return $this;
		}

		/**
		 * @return int Get id of column where content is stored
		 */
		public function getColumnId() {
			return $this->columnId;
		}

		/**
		 * Set column id
		 *
		 * @param $columnId
		 *
		 * @return Content
		 */
		public function setColumnId($columnId) {
			$this->columnId = $columnId;

			return $this;
		}

		/**
		 * @return mixed
		 */
		public function getTitle() {
			return $this->title;
		}

		/**
		 * @param $title
		 *
		 * @return Content
		 */
		public function setTitle($title) {
			$this->title = $title;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getType() {
			return $this->type;
		}

		/**
		 * @param string $type
		 *
		 * @return Content
		 */
		public function setType($type) {
			$this->type = $type;

			return $this;
		}

		/**
		 * Gets the element's serialized values. Do a json_decode after retrieving them
		 *
		 * @return string
		 */
		public function getValue() {
			return $this->value;
		}

		/**
		 * Sets the element's serialized values
		 *
		 * @param string $value
		 *
		 * @return Content
		 */
		public function setValue($value) {
			$this->value = $value;

			return $this;
		}

		/**
		 * @return \Continut\Core\Mvc\View\PageViews
		 */
		public function getPageView() {
			return $this->_pageView;
		}

		/**
		 * @param $pageView
		 *
		 * @return Content
		 */
		public function setPageView($pageView) {
			$this->_pageView = $pageView;

			return $this;
		}

		/**
		 * @return mixed
		 */
		public function getIsVisible()
		{
			return $this->isVisible;
		}

		/**
		 * @param mixed $isVisible
		 *
		 * @return Content
		 */
		public function setIsVisible($isVisible)
		{
			$this->isVisible = $isVisible;

			return $this;
		}

		/**
		 * @return boolean
		 */
		public function getIsDeleted()
		{
			return $this->isDeleted;
		}

		/**
		 * @param boolean $isDeleted
		 *
		 * @return Content
		 */
		public function setIsDeleted($isDeleted)
		{
			$this->isDeleted = $isDeleted;

			return $this;
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

		/**
		 * @param mixed $elements
		 */
		public function render($elements) {
			$scope = Utility::getApplicationScope();

			$title = $this->getTitle();
			if ($scope == Utility::SCOPE_BACKEND) {
				if ( $title == "" ) {
					$title = Utility::helper("Localization")->translate("backend.content.noTitle");
				}
			}

			$configuration = json_decode($this->getValue(), TRUE);
			$variables = $configuration["content"]["data"];
			$variables["title"] = $title;
			$view = Utility::createInstance("Continut\\Core\\Mvc\\View\\BaseView");
			$view->setTemplate(Utility::getResource(
				$configuration["content"]["template"],
				$configuration["content"]["extension"],
				$scope,
				"Content"
			));
			$view->assignMultiple($variables);

			$value = $view->render();
			if ($scope == Utility::SCOPE_BACKEND) {
				return $this->formatBackendBlock("content", $title, $value);
			}

			return $value;
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
		protected function formatBackendBlock($type, $title, $content) {
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

			$linkToShow   = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-eye-slash fa-fw"></i> %s</a>',
				Utility::helper("Localization")->translate("backend.content.operation.show"),
				Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["id" => $this->getId(), "show" => 1]),
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

			return sprintf($overallWrap, $this->getId(), $this->getId(), $this->getType(), $visibilityClass, $title, $operationLinks, $content);
		}
	}

}
