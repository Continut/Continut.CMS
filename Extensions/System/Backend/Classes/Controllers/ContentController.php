<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 19.04.2015 @ 21:25
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

class ContentController extends BackendController
{
    /**
     * Shows the "add content element" wizard
     */
    public function wizardAction()
    {
        // element id, if it will be added inside another container
        $id            = (int)$this->getRequest()->getArgument("id");
        // the pid of the new element
        $pageId        = (int)$this->getRequest()->getArgument("page_id");
        // column into which it will be added
        $columnId      = (int)$this->getRequest()->getArgument("column_id");
        $configuration = Utility::getExtensionSettings();

        $types = [];
        $extensions = [];
        foreach ($configuration as $extensionName => $values) {
            if (isset($values["elements"])) {
                foreach ($values["elements"] as $type => $elementValues) {
                    $types[$type][] = ["extension" => $extensionName, "configuration" => $elementValues];
                    $extensions[$extensionName] = $extensionName;
                }
            }
        }

        $this->getView()->assignMultiple(
            [
                "types"      => $types,
                "extensions" => $extensions,
                "id"         => $id,
                "pageId"     => $pageId,
                "columnId"   => $columnId
            ]
        );
    }

    /**
     * Delete a content element in the backend
     *
     * @return string
     * @throws \Continut\Core\Tools\Exception
     */
    public function deleteAction()
    {
        $id = (int)$this->getRequest()->getArgument("id");

        $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');
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
    public function toggleVisibilityAction()
    {
        $id = (int)$this->getRequest()->getArgument("id");

        $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');
        $content = $contentCollection->findById($id);

        $content->setIsVisible(!$content->getIsVisible());

        $contentCollection
            ->reset()
            ->add($content)
            ->save();

        return json_encode([
            "id" => $content->getId(),
            "operation" => "toggleVisibility"
        ]);
    }

    /**
     * Adds a content element to the page
     */
    public function addAction()
    {
        $id       = (int)$this->getRequest()->getArgument("id", 0);
        $pageId   = (int)$this->getRequest()->getArgument("page_id", 0);
        $columnId = (int)$this->getRequest()->getArgument("column_id", 0);
        $settings = $this->getRequest()->getArgument("settings");

        $wizard = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
        $wizardTemplate = ucfirst($settings["type"] . "s" . DS . $settings["template"]);
        $wizard->setTemplate(Utility::getResource($wizardTemplate, $settings["extension"], "Frontend", "Wizard"));

        $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');

        $this->getView()->assignMultiple(
            [
                "element"  => $contentCollection->createEmptyFromType($settings["type"]),
                "content"  => $wizard->render(),
                "settings" => $settings,
                "id"       => $id,
                "pageId"   => $pageId,
                "columnId" => $columnId
            ]
        );

        return json_encode([
            "id" => null,
            "html" => $this->getView()->render(),
            "operation" => "add"
        ]);
    }

    /**
     * Allows you to edit a content element
     *
     * @return string
     * @throws \Continut\Core\Tools\ErrorException
     */
    public function editAction()
    {
        $id = (int)$this->getRequest()->getArgument("id");

        $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');
        $content = $contentCollection->where("id = :id AND is_deleted = 0", ["id" => $id])->getFirst();

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

        $this->getView()->assignMultiple(
            [
                "id"       => $id,
                "pageId"   => $content->getPageId(),
                "columnId" => $content->getColumnId(),
                "content"  => $wizard->render()
            ]
        );

        return json_encode([
            "id"        => $content->getId(),
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
    public function updateAction()
    {
        $id      = (int)$this->getRequest()->getArgument("id");
        $data    = $this->getRequest()->getArgument("data", null);
        $success = 0;

        if ($data && $id > 0) {
            $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');
            $content = $contentCollection->findById($id);
            $values = json_decode($content->getValue(), TRUE);
            if (isset($data["title"])) {
                $content->setTitle($data["title"]);
            }
            $values[$content->getType()]["data"] = $data;
            $content->setValue(json_encode($values));
            $contentCollection
                ->reset()
                ->add($content)
                ->save();
            $success = 1;
        }

        return json_encode([
            "success" => $success
        ]);
    }

    /**
     * Adds a content element to the backend page
     *
     * @return string
     */
    public function createAction()
    {
        $pageId           = (int)$this->getRequest()->getArgument("page_id");
        $parentId         = (int)$this->getRequest()->getArgument("id");
        $columnId         = (int)$this->getRequest()->getArgument("column_id");
        $data             = $this->getRequest()->getArgument("data");
        $settings         = $this->getRequest()->getArgument("settings");
        $settings["data"] = $data;
        $type             = $settings["type"];
        $value            = [$type => $settings];

        $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');

        $content = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Model\BackendContent');
        $content
            ->setType($type)
            ->setPageId($pageId)
            ->setParentId($parentId)
            ->setIsVisible(1)
            ->setIsDeleted(0)
            ->setSorting(0)
            ->setColumnId($columnId)
            ->setValue(json_encode($value));
        if (isset($data["title"])) {
            $content->setTitle($data["title"]);
        }

        $contentCollection
            ->add($content)
            ->save();

        return json_encode([
            "success" => 1
        ]);
    }

    /**
     * Update content element's container once it is dropped
     *
     * @return string
     * @throws \Continut\Core\Tools\Exception
     */
    public function updateContainerAction()
    {
        $newParent = (int)$this->getRequest()->getArgument("parent_id");
        $newColumn = (int)$this->getRequest()->getArgument("column_id");
        $id        = (int)$this->getRequest()->getArgument("id");
        $beforeId  = (int)$this->getRequest()->getArgument("before_id");

        $contentCollection = Utility::createInstance('Continut\Extensions\System\Backend\Classes\Domain\Collection\BackendContentCollection');
        $contentElement = $contentCollection->where("id = :id AND is_deleted = 0", ["id" => $id])->getFirst();

        // the element was either added before a container or at the very end of a container, in which case the $beforeId is not present
        if ($beforeId) {
            // if it is added before an element then get it's "sorting" value and set it to our element
            $otherElement = $contentCollection->where("id = :id", ["id" => $beforeId])
                ->getFirst();
            $contentElement->setSorting($otherElement->getSorting());
            // all the other elements AFTER our new element get a "sorting" value + 1
            $elementsToModify = $contentCollection->where(
                "column_id = :column_id AND parent_id = :parent_id AND sorting >= :sorting_value",
                ["column_id" => $newColumn, "parent_id" => $newParent, "sorting_value" => $otherElement->getSorting()]
            );
            foreach ($elementsToModify->getAll() as $element) {
                $element->setSorting($element->getSorting() + 1);
            }
            $elementsToModify->save();
        } else {
            // if it is added at the beginning of a container, then it has the "sorting" value 1
            // if it is added at the end then it has the "sorting" value of the last element + 1
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

        // Update our element setting it's container parent, column id and the last modified date
        $contentElement
            ->setParentId($newParent)
            // @TODO Change all time manipulations to GMT+0
            ->setModifiedAt(time())
            ->setColumnId($newColumn);

        // The element gets saved by the collection. If the collection was already used to do a select, then we reset it
        // this way it only impacts our element
        $contentCollection
            ->reset()
            ->add($contentElement)
            ->save();

        return json_encode([
            "success" => 1
        ]);
    }
}
