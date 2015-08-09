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

		/**
		 * Delete a content element in the backend
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
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

		public function editAction() {
			$uid = (int)$this->getRequest()->getArgument("uid");

			$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentElement = $contentCollection->where("uid = :uid AND is_deleted = 0", ["uid" => $uid])->getFirst();

			$this->getView()->assign("element", $contentElement);

			$data = json_decode($contentElement->getValue(), TRUE);
			$wizardData = $data[$contentElement->getType()];

			$wizard = Utility::createInstance("Core\\Mvc\\View\\BaseView");
			$wizardTemplate = ucfirst($contentElement->getType()) . "s/" . $wizardData["template"];
			$wizard->setTemplate(Utility::getResource($wizardTemplate, $wizardData["extension"], "Frontend", "Wizard"));
			if (!isset($wizardData["data"]["title"])) {
				$wizardData["data"]["title"] = $contentElement->getTitle();
			}
			$wizard->assignMultiple($wizardData["data"]);

			$this->getView()->assign("content", $wizard->render());

			return json_encode([
				"uid"       => $contentElement->getUid(),
				"html"      => $this->getView()->render(),
				"operation" => "edit"
			]);
		}

		/**
		 * Saves the changes made to a content element in the backend
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function updateAction() {
			$uid  = (int)$this->getRequest()->getArgument("uid");
			$data = $this->getRequest()->getArgument("data", null);
			if ($data && $uid > 0) {
				$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
				$content = $contentCollection->findByUid($uid);
				$values = json_decode($content->getValue(), TRUE);
				if (isset($data["title"])) {
					$content->setTitle($data["title"]);
					unset($data["title"]);
				}
				$values[$content->getType()]["data"] = $data;
				$content->setValue(json_encode($values));
				$contentCollection
					->reset()
					->add($content)
					->save();
			}

			return json_encode([
				"status" => "ok"
			]);
		}

		/**
		 * Update content element's container once it is dragged & dropped
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function updateContainerAction() {
			$newParent = (int)$this->getRequest()->getArgument("parent_uid");
			$newColumn = (int)$this->getRequest()->getArgument("column_id");
			$uid       = (int)$this->getRequest()->getArgument("uid");
			$beforeUid = (int)$this->getRequest()->getArgument("before_uid");

			$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentElement = $contentCollection->where("uid = :uid AND is_deleted = 0", ["uid" => $uid])->getFirst();

			// the element was either added before one, ar at the very end of a container, in which case the $beforeUid is not present
			if ($beforeUid) {
				$otherElement = $contentCollection->where("uid = :uid", ["uid" => $beforeUid])
					->getFirst();
				$contentElement->setSorting($otherElement->getSorting());
				$elementsToModify = $contentCollection->where(
					"column_id = :column_id AND parent_uid = :parent_uid AND sorting >= :sorting_value",
					["column_id" => $newColumn, "parent_uid" => $newParent, "sorting_value" => $otherElement->getSorting()]
				);
				foreach ($elementsToModify->getAll() as $element) {
					$element->setSorting($element->getSorting() + 1);
				}
				$elementsToModify->save();
			} else {
				$otherElement = $contentCollection->where(
					"column_id = :column_id AND parent_uid = :parent_uid ORDER BY sorting DESC",
					["column_id" => $newColumn, "parent_uid" => $newParent]
				)->getFirst();
				if ($otherElement) {
					$contentElement->setSorting($otherElement->getSorting() + 1);
				} else {
					$contentElement->setSorting(1);
				}
			}

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
