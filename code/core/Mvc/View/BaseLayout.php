<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 18:55
 * Project: Conţinut CMS
 */
namespace Core\Mvc\View {

	class BaseLayout {
		/**
		 * @var string Layout template to use
		 */
		protected $_template;

		/**
		 * @var PageView the Pageview this layout is linked to
		 */
		protected $_page = NULL;

		/**
		 * Set layout template file
		 *
		 * @param string $template
		 */
		public function setTemplate($template) {
			$this->_template = $template;
		}

		/**
		 * @return string
		 */
		public function getTemplate() {
			return $this->_template;
		}

		/**
		 * Set the PageView this layout belongs to
		 *
		 * @param PageView $page
		 */
		public function setPage($page) {
			$this->_page = $page;
		}

		/**
		 * @return PageView
		 */
		public function getPage() {
			return $this->_page;
		}

		/**
		 * Render layout
		 *
		 * @return string
		 */
		public function render() {
			ob_start();
			include_once $this->_template;
			return ob_get_clean();
		}

		/**
		 * @param string $partial Renders a partial
		 *
		 * @return string
		 */
		public function renderPartial($partial) {
			echo "Partials not yet implemented :)";
		}
	}

}
