<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 06.04.2015 @ 19:31
 * Project: Conţinut CMS
 */
namespace Core\System\View {

	use Core\Mvc\View\BaseLayout;

	class BackendLayout extends BaseLayout {
		public function showContent() {
			return "";
		}
	}

}
