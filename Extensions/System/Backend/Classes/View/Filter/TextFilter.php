<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 16:33
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\View\Filter {

	use Core\Utility;

	class TextFilter extends BaseFilter {

		/**
		 * TextFilter constructor
		 */
		public function __construct()
		{
			$this->setTemplate(Utility::getResource("Filter/text", "Backend", "Backend", "Template"));
		}

		/**
		 * @return string
		 */
		public function getQueryText() {
			$fieldname = $this->getFieldName();
			return "$fieldname LIKE :$fieldname";
		}

		/**
		 * @return array
		 */
		public function getQueryValues() {
			return [$this->getFieldName() => "%news%"];
		}
	}

}