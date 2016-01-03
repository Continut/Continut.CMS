<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.01.2016 @ 17:50
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Domain\Model\Grid {

	use Core\Mvc\Model\BaseModel;
	use Core\Utility;

	class Field extends BaseModel {

		/**
		 * @var string Css class to use for the field
		 */
		protected $css;

		/**
		 * @var string Label of the field
		 */
		protected $label;

		/**
		 * @var string
		 */
		protected $filter;

		/**
		 * @var mixed @TODO - replace with abstract filter class
		 */
		protected $filterObject;

		/**
		 * @var string
		 */
		protected $renderer;

		/**
		 * @return string
		 */
		public function getCss()
		{
			return $this->css;
		}

		/**
		 * @param $css
		 *
		 * @return $this
		 */
		public function setCss($css)
		{
			$this->css = $css;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getLabel()
		{
			return $this->label;
		}

		/**
		 * @param $label
		 *
		 * @return $this
		 */
		public function setLabel($label)
		{
			$this->label = $label;

			return $this;
		}

		/**
		 * @return mixed
		 */
		public function getFilter()
		{
			return $this->filterObject;
		}

		/**
		 * @param $filter
		 *
		 * @return $this
		 * @throws \Core\Tools\ErrorException
		 */
		public function setFilter($filter)
		{
			$this->filter = $filter;
			$this->filterObject = Utility::createInstance($filter);

			return $this;
		}

		/**
		 * @return string
		 */
		public function getRenderer()
		{
			return $this->renderer;
		}

		/**
		 * @param $renderer
		 *
		 * @return $this
		 */
		public function setRenderer($renderer)
		{
			$this->renderer = $renderer;

			return $this;
		}
	}

}