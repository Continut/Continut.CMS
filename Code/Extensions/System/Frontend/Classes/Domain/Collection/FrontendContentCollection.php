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

	class FrontendContentCollection extends ContentCollection {
		public function __construct() {
			$this->_tablename = "sys_content";
			$this->_elementClass = "\\Core\\System\\Domain\\Model\\Content";
		}
	}

}