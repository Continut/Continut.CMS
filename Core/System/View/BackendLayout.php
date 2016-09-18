<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 06.04.2015 @ 19:31
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\View {

	use Continut\Core\Mvc\View\BaseLayout;

	class BackendLayout extends BaseLayout {
		protected $content = NULL;

		public function showContent() {
			return $this->content;
		}

		public function setContent($content) {
			$this->content = $content;
		}

		/**
		 * Show all content from a container and wrap it in a special class, for backend drag & drop
		 *
		 * @param int $id Id if the container to show
		 *
		 * @return string
		 */
		public function showContainerColumn($id) {
			return sprintf('<div data-id="%s" data-parent="0" class="container-receiver">%s</div>', $id, parent::showContainerColumn($id));
		}
	}

}