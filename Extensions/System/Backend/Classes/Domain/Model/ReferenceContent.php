<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 11.04.2015 @ 17:50
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Domain\Model;

use Continut\Core\Utility;

class ReferenceContent extends BackendContent
{
    /**
     * Renders the backend editable part of a content element. Overwritten for references, since the menus are different
     *
     * @param string $type The type of content element we're formating
     * @param string $title The title of the content element, if any
     * @param string $content The content of the element
     *
     * @return string
     */
    protected function formatBlock($type, $title, $content)
    {
        $linkToEdit = sprintf('<a title="%s" class="btn btn-default content-operation-link" href="%s"><i class="fa fa-pencil fa-fw"></i></a>',
            Utility::helper("Localization")->translate("backend.content.operation.edit"),
            Utility::helper("Url")->linkToAction("Backend", "Content", "edit", ["id" => $this->getId()])
        );

        $linkToDelete = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-trash-o fa-fw"></i> %s</a>',
            Utility::helper("Localization")->translate("backend.content.operation.delete"),
            Utility::helper("Url")->linkToAction("Backend", "Content", "delete", ["id" => $this->getId()]),
            Utility::helper("Localization")->translate("backend.content.operation.delete")
        );

        $linkToCopy = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-copy fa-fw"></i> %s</a>',
            Utility::helper("Localization")->translate("backend.content.operation.copy"),
            Utility::helper("Url")->linkToAction("Backend", "Content", "copy", ["id" => $this->getId()]),
            Utility::helper("Localization")->translate("backend.content.operation.copy")
        );

        $linkToHide = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-eye fa-fw"></i> %s</a>',
            Utility::helper("Localization")->translate("backend.content.operation.hide"),
            Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["id" => $this->getId(), "show" => 0]),
            Utility::helper("Localization")->translate("backend.content.operation.hide")
        );

        $linkToShow = sprintf('<a title="%s" class="content-operation-link" href="%s"><i class="fa fa-eye-slash text-danger fa-fw"></i> %s</a>',
            Utility::helper("Localization")->translate("backend.content.operation.show"),
            Utility::helper("Url")->linkToAction("Backend", "Content", "toggleVisibility", ["id" => $this->getId(), "show" => 1]),
            Utility::helper("Localization")->translate("backend.content.operation.show")
        );

        if ($this->getIsVisible()) {
            $visibilityLink = $linkToHide;
            $visibilityClass = "panel-visible";
        } else {
            $visibilityLink = $linkToShow;
            $visibilityClass = "panel-hidden";
            $title .= Utility::helper("Localization")->translate("backend.content.headerIsHidden");
        }

        $operationLinks = sprintf('<div class="btn-group btn-group-sm pull-right" role="group" aria-label="Element actions">%s<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu" role="menu"><li>%s</li><li>%s</li><li>%s</li></div>',
            $linkToEdit, $linkToCopy, $visibilityLink, $linkToDelete);

        // not used so far, in stand by
        /*$moveElementLink = sprintf('<a class="btn btn-default btn-sm drag-controller" title="%s"><i class="fa fa-fw fa-arrows"></i></a>',
            Utility::helper("Localization")->translate("backend.content.operation.move")
        );*/

        $overallWrap = '<div id="panel-backend-content-%s" data-id="%s" class="content-type-%s panel panel-backend-content %s"><div class="panel-heading"><strong>%s</strong>%s</div><div class="panel-body">%s</div></div>';

        return sprintf($overallWrap, $this->getId(), $this->getId(), $this->getType(), $visibilityClass, $title, $operationLinks, $content);
    }
}
