<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 11.04.2015 @ 18:48
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Controllers {

	use Continut\Core\Mvc\Controller\BackendController;
	use Continut\Core\Utility;

	class PreviewController extends BackendController {
		public function backendConfigureAction() {

		}

		public function backendPreviewAction() {
			$limit = (isset($this->data["limit"])) ? $this->data["limit"] : 1;

			$news = Utility::$entityManager->getRepository('\Continut\Extensions\Local\News\Classes\Domain\Model\News')->findBy([], [], $limit);

			$this->getView()->assign('news', $news);
			$this->getView()->assign('data', $this->data);
		}
	}

}
