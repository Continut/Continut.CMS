<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 16:33
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\View {

	use Core\Mvc\View\BaseView;
	use Core\Utility;

	class GridView extends BaseView {

		/**
		 * @var array Fields to be used by the widget
		 */
		protected $fields;

		/**
		 * @var Core\Mvc\Model\BaseCollection
		 */
		protected $collection;

		/**
		 * @var int
		 */
		protected $limit = 10;

		/**
		 * @var int
		 */
		protected $offset = 0;

		/**
		 * @var string
		 */
		protected $formAction;

		/**
		 * @return mixed
		 */
		public function getCollection()
		{
			$offset = (int)$this->getOffset();
			$limit  = (int)$this->getLimit();

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
			return $this->collection->where("$filterQueries LIMIT $offset, $limit", $filterValues);
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
				$field = Utility::createInstance("Extensions\\System\\Backend\\Classes\\Domain\\Model\\Grid\\Field");
				$field
					->setName($name)
					->update($fieldValues)
					->setValue(Utility::getRequest()->getArgument($name));
				/*if ($field->getFilter()) {
					$field->getFilter()
						->setFieldName($name)
						->setFieldValue(Utility::getRequest()->getArgument($name));
				}*/
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
		public function setPager($limit, $offset) {
			$this->limit = $limit;
			$this->offset = $offset;

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
		 * @return int
		 */
		public function getOffset()
		{
			return $this->offset;
		}

		/**
		 * @param int $offset
		 *
		 * @return $this
		 */
		public function setOffset($offset)
		{
			$this->offset = $offset;

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
	}

}
