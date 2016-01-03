<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 12:39
 * Project: Conţinut CMS
 */
namespace Extensions\System\Frontend\Classes\Domain\Collection {

	use Core\System\Domain\Collection\ContentCollection;
	use Core\Utility;

	class FrontendContentCollection extends ContentCollection {

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->_tablename = "sys_content";
			$this->_elementClass = "\\Extensions\\System\\Frontend\\Classes\\Domain\\Model\\FrontendContent";
		}

		/**
		 * Do a custom where on the collection and return different type objects
		 *
		 * @param $conditions
		 * @param $values
		 *
		 * @return $this
		 */
		public function where($conditions, $values = []) {
			$this->_elements = [];
			$sth = Utility::getDatabase()->prepare("SELECT * FROM $this->_tablename WHERE " . $conditions);
			$sth->execute($values);
			$sth->setFetchMode(\PDO::FETCH_ASSOC);
			while ($row = $sth->fetch()) {
				switch ($row["type"]) {
					case "plugin":    $element = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Model\\Content\\FrontendPluginContent"); break;
					case "container": $element = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Model\\Content\\FrontendContainerContent"); break;
					case "reference": $element = Utility::createInstance("\\Extensions\\System\\Frontend\\Classes\\Domain\\Model\\Content\\FrontendReferenceContent"); break;
					default:          $element = Utility::createInstance($this->_elementClass);
				}
				$element->update($row);
				$this->add($element);
			}

			return $this;
		}
	}

}
