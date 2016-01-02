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
		 * @return mixed
		 */
		public function getCollection()
		{
			$offset = (int)$this->getOffset();
			$limit  = (int)$this->getLimit();
			return $this->collection->where("1=1 LIMIT $offset, $limit");
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
			$this->fields = $fields;

			foreach ($this->fields as $name => $field) {
				if (isset($field['filter'])) {
					$filter = Utility::createInstance($field['filter']);
					$this->fields[$name]['filter'] = $filter->render();
				}
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
	}

}
