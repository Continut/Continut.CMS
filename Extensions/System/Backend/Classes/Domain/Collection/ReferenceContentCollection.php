<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:02
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Domain\Collection {

	use Core\System\Domain\Collection\ContentCollection;

	class ReferenceContentCollection extends ContentCollection {
		/**
		 * Set tablename and element class
		 */
		public function __construct() {
			$this->_tablename = "sys_content";
			$this->_elementClass = "\\Extensions\\System\\Backend\\Classes\\Domain\\Model\\ReferenceContent";
		}
	}

}
