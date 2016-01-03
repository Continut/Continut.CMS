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

	use Core\Mvc\View\BaseView;
	use Core\Utility;

	class BaseFilter extends BaseView {

		/**
		 * @var string Input's field name
		 */
		protected $fieldName;

		/**
		 * @var mixed
		 */
		protected $fieldValue;

		/**
		 * @return mixed
		 */
		public function getFieldName()
		{
			return $this->fieldName;
		}

		/**
		 * @param string $fieldName
		 *
		 * @return $this
		 */
		public function setFieldName($fieldName)
		{
			$this->fieldName = $fieldName;

			return $this;
		}

		/**
		 * @return mixed
		 */
		public function getFieldValue()
		{
			return $this->fieldValue;
		}

		/**
		 * @param mixed $fieldValue
		 *
		 * @return $this
		 */
		public function setFieldValue($fieldValue)
		{
			$this->fieldValue = $fieldValue;

			return $this;
		}
	}

}