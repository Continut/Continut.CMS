<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 06.04.2015 @ 19:42
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\View {

	use Continut\Core\Mvc\View\PageView;
	use Continut\Core\Utility;

	class BackendPageView extends PageView {

		public function setLayoutFromTemplate($template) {
			$this->_layout = Utility::createInstance('Continut\Core\System\View\BackendLayout');
			$this->_layout
				->setPage($this)
				->setTemplate($template);
		}

		public function render() {
			return $this->getLayout()->render();
		}
	}

}
