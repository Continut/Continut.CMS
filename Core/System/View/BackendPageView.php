<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 06.04.2015 @ 19:42
 * Project: Conţinut CMS
 */
namespace Core\System\View {

	use Core\Mvc\View\PageView;
	use Core\Utility;

	class BackendPageView extends PageView {

		public function setLayoutFromTemplate($template) {
			$this->_layout = Utility::createInstance("\\Core\\System\\View\\BackendLayout");
			$this->_layout
				->setPage($this)
				->setTemplate($template);
		}

		public function render() {
			return $this->getLayout()->render();
		}
	}

}
