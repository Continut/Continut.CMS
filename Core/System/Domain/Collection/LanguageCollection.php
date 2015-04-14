<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 12:39
 * Project: Conţinut CMS
 */
namespace Core\System\Domain\Collection {

	use Core\Mvc\Model\BaseCollection;

	class LanguageCollection extends BaseCollection {

		/**
		 * Set tablename and element class for this collection
		 */
		public function __construct() {
			$this->_tablename = "sys_languages";
			$this->_elementClass = "\\Core\\System\\Domain\\Model\\Language";
		}

		public function toSimplifiedArray() {
			$data = [];
			foreach ($this->getAll() as $language) {
				$data[$language->getLanguageIso3()] = $language->getTitle();
			}
			return $data;
		}
	}

}
