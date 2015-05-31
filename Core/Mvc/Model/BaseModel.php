<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 29.03.2015 @ 18:43
 * Project: Conţinut CMS
 */

namespace Core\Mvc\Model {
	use Core\Utility;

	/**
	 * Class BaseModel
	 *
	 * @package Core\Mvc\Model
	 */
	class BaseModel {
		/**
		 * @var int model unique identifier
		 */
		protected $uid;

		/**
		 * @return int Model's unique id in the database
		 */
		public function getUid() {
			return $this->uid;
		}

		/**
		 * @param int $uid new uid to use
		 */
		public function setUid($uid) {
			$this->uid = $uid;
		}

		/**
		 * Simple datamapper used for the database
		 * @return array
		 */
		public function dataMapper() {
			return [];
		}

		/**
		 * Updates the values of this model
		 *
		 * @param array $values Array of key/value pairs to update the model with
		 *
		 * @return $this
		 */
		public function update($values) {
			foreach ($values as $key => $value) {
				if (property_exists($this, "key")) {
					$this->$key = $value;
				}
			}

			return $this;
		}
	}
}