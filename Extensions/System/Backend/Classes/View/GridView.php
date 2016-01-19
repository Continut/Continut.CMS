<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 16:33
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\View {

	use Continut\Core\Mvc\View\BaseView;
	use Continut\Core\Utility;

	class GridView extends BaseView {

		/**
		 * @var array Fields to be used by the widget
		 */
		protected $fields;

		/**
		 * @var \Continut\Core\Mvc\Model\BaseCollection
		 */
		protected $collection;

		/**
		 * @var int
		 */
		protected $limit = 10;

		/**
		 * @var int Paginator's current page
		 */
		protected $page = 1;

		/**
		 * @var int
		 */
		protected $totalRecords;

		/**
		 * @var string
		 */
		protected $formAction;

		/**
		 * @return mixed
		 */
		public function getCollection()
		{
			return $this->collection;
		}

		public function initialize() {
			$limit  = (int)$this->getLimit();
			$offset = ($this->getPage() - 1) * $limit;

			$filterQueries = [];
			$filterValues = [];
			foreach ($this->getFields() as $name => $field) {
				if ($field->getFilter()) {
					$queryText = $field->getFilter()->getQueryText();
					if ($queryText) {
						$filterQueries[] = $field->getFilter()->getQueryText();
						$filterValues = array_merge($filterValues, $field->getFilter()->getQueryValue());
					}
				}
			}

			if ($filterQueries) {
				$filterQueries = implode(" AND ", $filterQueries);
			} else {
				$filterQueries = "1=1";
			}

			$this->setTotalRecords($this->collection->whereCount($filterQueries, $filterValues));

			$this->collection->where("$filterQueries LIMIT $offset, $limit", $filterValues);
		}

		/**
		 * @param mixed $collection
		 *
		 * @return $this
		 */
		public function setCollection($collection)
		{
			$this->collection = $collection;

			return $this;
		}

		/**
		 * @param $fields
		 *
		 * @return $this
		 */
		public function setFields($fields) {
			foreach ($fields as $name => $fieldValues) {
				$field = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Model\Grid\Field');
				$field
					->setName($name)
					->update($fieldValues)
					->setValue(Utility::getRequest()->getArgument($name));
				$this->fields[$name] = $field;
			}

			return $this;
		}

		/**
		 * @return array
		 */
		public function getFields()
		{
			return $this->fields;
		}

		/**
		 * @param $limit  How many items to show per page
		 * @param $offest What page number to show
		 *
		 * @return $this
		 */
		public function setPager($limit, $page) {
			$this->limit = $limit;
			$this->page = $page;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getLimit()
		{
			return $this->limit;
		}

		/**
		 * @param int $limit
		 *
		 * @return $this
		 */
		public function setLimit($limit)
		{
			$this->limit = $limit;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getFormAction()
		{
			return $this->formAction;
		}

		/**
		 * @param $formAction
		 *
		 * @return $this
		 */
		public function setFormAction($formAction)
		{
			$this->formAction = $formAction;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getPage()
		{
			return $this->page;
		}

		/**
		 * @param $page
		 *
		 * @return $this
		 */
		public function setPage($page)
		{
			$this->page = $page;

			return $this;
		}

		/**
		 * @return int
		 */
		public function getTotalRecords()
		{
			return $this->totalRecords;
		}

		/**
		 * @param $totalRecords
		 *
		 * @return $this
		 */
		public function setTotalRecords($totalRecords)
		{
			$this->totalRecords = $totalRecords;

			return $this;
		}
	}

}
