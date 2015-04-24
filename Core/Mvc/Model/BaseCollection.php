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
		 * Empty the collection
		 *
		 * @return $this
		 */
		public function reset() {
			$this->_elements = [];

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
		 * Return 1 record by uid
		 *
		 * @param $uid
		 *
		 * @return mixed
		 */
		public function findByUid($uid) {
			$sth = Utility::database()->prepare("SELECT * FROM $this->_tablename WHERE uid = :uid");
			$sth->execute(["uid" => $uid]);
			$sth->setFetchMode(\PDO::FETCH_CLASS, $this->_elementClass);

			$element = $sth->fetch();

			return $element;
		}

		/**
		 * Save all the collection elements
		 *
		 * @return $this
		 */
		public function save() {
			foreach ($this->_elements as $element) {
				$dataMapper = $element->dataMapper();
				$listOfFields = implode(",", array_keys($dataMapper));
				$listOfValues = [];
				// element does not exist, insert it
				if (is_null($element->getUid())) {
					foreach ($dataMapper as $key => $value) {
						$listOfValues[] = ":" . $key;
					}
					$listOfValues = implode(",", $listOfValues);
					$sth = Utility::database()->prepare("INSERT INTO $this->_tablename ($listOfFields) VALUES ($listOfValues)");
				// element exists, update it
				} else {
					foreach ($dataMapper as $key => $value) {
						$listOfValues[] = $key . "= :" . $key;
					}
					$listOfValues = implode(",", $listOfValues);
					$sth = Utility::database()->prepare("UPDATE $this->_tablename SET $listOfValues WHERE uid = :uid");
					$dataMapper["uid"] = $element->getUid();
				}
				$sth->execute($dataMapper);
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