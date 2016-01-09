<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 20:43
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Domain\Model\Content {

	use Continut\Core\Utility;
	use Continut\Extensions\System\Backend\Classes\Domain\Model\BackendContent;

	class BackendReferenceContent extends BackendContent {
		/**
		 * Shows Referenced content elements
		 *
		 * @param mixed $elements
		 *
		 * @return string
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function render($elements) {
			$reference = (int)$this->getReferenceId();
			$value = "";
			if ($reference > 0) {
				// Load the content collection model and then find all the content elements that belong to this page_id
				$referencedContent = Utility::$entityManager->getRepository('Continut\Extensions\System\Backend\Classes\Domain\Model\BackendContent')->findOneBy(["isDeleted" => 0, "id" => $reference]);

				// set the element's id to the reference id, so that we do not modify the original
				if ($referencedContent) {
					$referencedContent->setId($this->getId());
					//$referencedContent->setType("reference");

					// if not a container, render it directly
					if ( $referencedContent->getType() != "container" ) {
						$value = $referencedContent->setFromReference(TRUE)->render(NULL);
					// otherwise render all it's children
					} else {
						$elements = Utility::$entityManager->getRepository('Continut\Extensions\System\Backend\Classes\Domain\Model\BackendContent')->findChildrenForId($referencedContent->getPageId(), $reference);
						$value = $referencedContent->setFromReference(TRUE)->render($elements->children);
					}

					return sprintf('<div class="content-type-reference"><p class="reference-title"><i class="fa fa-fw fa-chain"></i> %s </p>%s <a class="btn btn-danger" href=""><i class="fa fa-unlink"></i> %s</a></div>',
						Utility::helper("Localization")->translate("backend.content.reference.info", ["content_id" => $reference, "page_id" => $referencedContent->getPageId()]),
						$value,
						Utility::helper("Localization")->translate("backend.content.reference.delete")
					);
				}
			}
			return "";

		}
	}

}
