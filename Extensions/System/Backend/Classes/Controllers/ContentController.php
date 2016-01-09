<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 19.04.2015 @ 21:25
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers {

	use Continut\Core\Mvc\Controller\BackendController;
	use Continut\Core\Utility;

	class ContentController extends BackendController {

		public function wizardAction() {
		}

		/**
		 * Delete a content element in the backend
		 *
		 * @return string
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function deleteAction() {
			$id = (int)$this->getRequest()->getArgument("id");

			$contentCollection = Utility::createInstance("\\Continut\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentElement = $contentCollection->where("id = :id AND is_deleted = 0", ["id" => $id])->getFirst();

			$contentElement->setIsDeleted(true);

			$contentCollection
				->reset()
				->add($contentElement)
				->save();

			return json_encode([
				"id" => $contentElement->getId(),
				"operation" => "delete"
			]);
		}

		/**
		 * Toggles an element's visibility
		 */
		public function toggleVisibilityAction() {
			$id = (int)$this->getRequest()->getArgument("id");

			$contentCollection = Utility::createInstance("\\Continut\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$content = $contentCollection->findById($id);

			$content->setIsVisible(!$content->getIsVisible());

			$contentCollection
				->reset()
				->add($content)
				->save();

			return json_encode([
				"id"       => $content->getId(),
				"operation" => "toggleVisibility"
			]);
		}

		public function editAction() {
			$id = (int)$this->getRequest()->getArgument("id");

			$content = Utility::$entityManager->getRepository('Continut\Extensions\System\Backend\Classes\Domain\Model\BackendContent')->find($id);

			$this->getView()->assign("element", $content);

			$data = json_decode($content->getValue(), TRUE);
			$wizardData = $data[$content->getType()];

			$wizard = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
			$wizardTemplate = ucfirst($content->getType()) . "s/" . $wizardData["template"];
			$wizard->setTemplate(Utility::getResource($wizardTemplate, $wizardData["extension"], "Frontend", "Wizard"));
			if (!isset($wizardData["data"]["title"])) {
				$wizardData["data"]["title"] = $content->getTitle();
			}
			$wizard->assignMultiple($wizardData["data"]);

			$this->getView()->assign("content", $wizard->render());

			return json_encode([
				"id"       => $content->getId(),
				"html"      => $this->getView()->render(),
				"operation" => "edit"
			]);
		}

		/**
			 * Saves the changes made to a content element in the backend
		 *
		 * @return string
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function updateAction() {
			$id  = (int)$this->getRequest()->getArgument("id");
			$data = $this->getRequest()->getArgument("data", null);
			if ($data && $id > 0) {
				$contentCollection = Utility::createInstance("\\Continut\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
				$content = $contentCollection->findById($id);
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
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function updateContainerAction() {
			$newParent = (int)$this->getRequest()->getArgument("parent_id");
			$newColumn = (int)$this->getRequest()->getArgument("column_id");
			$id       = (int)$this->getRequest()->getArgument("id");
			$beforeId = (int)$this->getRequest()->getArgument("before_id");

			$contentCollection = Utility::createInstance("\\Continut\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
			$contentElement = $contentCollection->where("id = :id AND is_deleted = 0", ["id" => $id])->getFirst();

			// the element was either added before one, ar at the very end of a container, in which case the $beforeId is not present
			if ($beforeId) {
				$otherElement = $contentCollection->where("id = :id", ["id" => $beforeId])
					->getFirst();
				$contentElement->setSorting($otherElement->getSorting());
				$elementsToModify = $contentCollection->where(
					"column_id = :column_id AND parent_id = :parent_id AND sorting >= :sorting_value",
					["column_id" => $newColumn, "parent_id" => $newParent, "sorting_value" => $otherElement->getSorting()]
				);
				foreach ($elementsToModify->getAll() as $element) {
					$element->setSorting($element->getSorting() + 1);
				}
				$elementsToModify->save();
			} else {
				$otherElement = $contentCollection->where(
					"column_id = :column_id AND parent_id = :parent_id ORDER BY sorting DESC",
					["column_id" => $newColumn, "parent_id" => $newParent]
				)->getFirst();
				if ($otherElement) {
					$contentElement->setSorting($otherElement->getSorting() + 1);
				} else {
					$contentElement->setSorting(1);
				}
			}

			$contentElement
				->setParentId($newParent)
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
