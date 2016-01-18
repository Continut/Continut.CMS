<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 16:33
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\View\Filter {

	use Continut\Core\Mvc\View\BaseView;

	class BaseFilter extends BaseView {

		/**
		 * @var Continut\Extensions\System\Backend\Classes\Domain\Model\Grid\Field
		 */
		protected $field;

		/**
		 * @var array
		 */
		protected $values;

		/**
		 * @return Continut\Extensions\System\Backend\Classes\Domain\Model\Grid\Field
		 */
		public function getField()
		{
			return $this->field;
		}

		/**
		 * @param Continut\Extensions\System\Backend\Classes\Domain\Model\Grid\Field $field
		 *
		 * @return $this
		 */
		public function setField($field)
		{
			$this->field = $field;

			return $this;
		}

		/**
		 * @return array
		 */
		public function getValues()
		{
			return $this->values;
		}

		/**
		 * @param $values
		 *
		 * @return $this
		 */
		public function setValues($values)
		{
			$this->values = $values;

			return $this;
		}

		public function getQueryText() {}
		public function getQueryValue() {}
	}

}