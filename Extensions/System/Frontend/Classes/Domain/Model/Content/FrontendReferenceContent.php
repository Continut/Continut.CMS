<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 21:28
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Domain\Model\Content;

use Continut\Core\Utility;
use Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendContent;

class FrontendReferenceContent extends FrontendContent
{
    /**
     * Render the reference element
     *
     * @param mixed $elements
     *
     * @return string
     */
    public function render($elements) {
        $reference = (int)$this->getReferenceId();
        $value = "";
        if ($reference > 0) {
            // Load the content collection model and then find all the content elements that belong to this page_id
            $contentCollection = Utility::createInstance('Continut\Extensions\System\\Frontend\Classes\Domain\Collection\FrontendContentCollection');
            $referencedContent = $contentCollection
                ->where("is_deleted = 0 AND id = :id ORDER BY sorting ASC", [":id" => $reference])
                ->getFirst();
            // set the element's id to the reference id, so that we do not modify the original
            $referencedContent->setId($this->getId());
            if ($referencedContent) {
                if ($referencedContent->getType() != "container") {
                    $value = $referencedContent->render(null);
                } else {
                    $contentCollection
                        ->where("page_id = :page_id", ["page_id" => $referencedContent->getPageId()]);
                    $elements = $contentCollection->findChildrenForId($reference);
                    $value = $referencedContent->render($elements->children);
                }
            }
        }
        return $value;
    }
}
