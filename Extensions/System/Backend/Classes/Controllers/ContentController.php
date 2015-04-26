<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 19.04.2015 @ 21:25
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Controllers {

	use Core\Mvc\Controller\BackendController;
	use Core\Utility;

	class ContentController extends BackendController {

		public function wizardAction() {
		}

		public function deleteAction() {
			$uid = (int)$this->getRequest()->getArgument("uid");

			$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentElement = $contentCollection->where("uid = :uid AND is_deleted = 0", ["uid" => $uid])->getFirst();

			$contentElement->setIsDeleted(true);

			$contentCollection
				->reset()
				->add($contentElement)
				->save();

			return json_encode([
				"uid" => $contentElement->getUid(),
				"operation" => "delete"
			]);
		}

		public function updateContainerAction() {
			$newParent = (int)$this->getRequest()->getArgument("parent_uid");
			$newColumn = (int)$this->getRequest()->getArgument("column_id");
			$uid       = (int)$this->getRequest()->getArgument("uid");

			$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentElement = $contentCollection->where("uid = :uid AND is_deleted = 0", ["uid" => $uid])->getFirst();

			$contentElement
				->setParentUid($newParent)
				->setColumnId($newColumn);

			$contentCollection
				->reset()
				->add($contentElement)
				->save();

			return json_encode([
				"status" => "ok"
			]);
		}
	}

}
