<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 04.04.2015 @ 13:02
 * Project: Conţinut CMS
 */
namespace Core\System\Domain\Collection {

	use Core\Mvc\Model\BaseCollection;

	class ContentCollection extends BaseCollection{
		public function __construct() {
			$this->_tablename = "sys_content";
			$this->_elementClass = "\\Extensions\\Local\\News\\Classes\\Domain\\Model\\Page";
		}
	}

}
