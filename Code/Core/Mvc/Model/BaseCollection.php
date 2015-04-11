<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 11:54
 * Project: Conţinut CMS
 */
namespace Core\Mvc\Model {

	use Core\Utility;

	class BaseCollection {
		/**
		 * @var string Tablename to use for collection
		 */
		protected $_tablename;

		/**
		 * @var string Class of each element
		 */
		protected $_elementClass = "";

		/**
		 * @var array List of elements held by this collection
		 */
		protected $_elements = [];

		/**
		 * Get all elements from the collection
		 *
		 * @return array
		 */
		public function getAll() {
			return $this->_elements;
		}

		/**
		 * Get first element from the collection
		 *
		 * @return null
		 */
		public function getFirst() {
			if (!empty($this->_elements)) {
				return $this->_elements[0];
			}
			return NULL;
		}

		/**
		 * Manually add an element
		 *
		 * @param $element
		 *
		 * @return $this
		 */
		public function add($element) {
			$this->_elements[] = $element;
			return $this;
		}

		/**
		 * Manually remove an element
		 *
		 * @param $elementToRemove
		 *
		 * @return $this
		 */
		public function remove($elementToRemove) {
			foreach ($this->_elements as $element) {
				if ($element === $elementToRemove) {
					unset($this->_elements[$element]);
				}
			}

			return $this;
		}

		/**
		 * Do a where on the collection
		 *
		 * @param $conditions
		 * @param $values
		 *
		 * @return $this
		 */
		public function where($conditions, $values = []) {
			$this->_elements = [];
			$sth = Utility::database()->prepare("SELECT * FROM $this->_tablename WHERE " . $conditions);
			$sth->execute($values);
			$sth->setFetchMode(\PDO::FETCH_CLASS, $this->_elementClass);
			while ($element = $sth->fetch()) {
				$this->add($element);
			}

			return $this;
		}

		/**
		 * Save all the collection elements
		 *
		 * @return $this
		 */
		public function save() {
			foreach ($this->_elements as $element) {
				$element->save();
			}

			return $this;
			}

		/**
		 * How many elements do we have in the collection?
		 *
		 * @return int
		 */
		public function count() {
			return sizeof($this->_elements);
		}
	}

}
