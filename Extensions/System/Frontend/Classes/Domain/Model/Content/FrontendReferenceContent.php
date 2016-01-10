<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 21:28
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Domain\Model\Content {

	use Continut\Core\Utility;
	use Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendContent;

	class FrontendReferenceContent extends FrontendContent {

		/**
		 * Render the reference element
		 *
		 * @param mixed $elements
		 *
		 * @return string
		 */
		public function render($elements) {
			$id = (int)$this->getReferenceId();
			$value = "";
			if ($id > 0) {
				$reference = Utility::getRepository('Continut\Core\System\Domain\Model\Content')->findOneBy(['isDeleted' => 0, 'id' => $id], ['sorting' => 'ASC']);
				// set the element's id to the reference id, so that we do not modify the original
				$reference->setId($this->getId());
				if ($reference) {
					if ($reference->getType() != "container") {
						$value = $reference->render(null);
					} else {
						$contentCollection
							->where("page_id = :page_id", ["page_id" => $reference->getPageId()]);
						$elements = $contentCollection->findChildrenForId($reference);
						$value = $reference->render($elements->children);
					}
				}
			}
			return $value;
		}
	}

}
