<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 20:43
 * Project: Conţinut CMS
 */
namespace Extensions\System\Backend\Classes\Domain\Model\Content {

	use Core\Utility;
	use Extensions\System\Backend\Classes\Domain\Model\BackendContent;

	class BackendReferenceContent extends BackendContent {
		/**
		 * Shows Referenced content elements
		 *
		 * @param mixed $elements
		 *
		 * @return string
		 * @throws \Core\Tools\Exception
		 */
		public function render($elements) {
			$reference = (int)$this->getReferenceUid();
			$value = "";
			if ($reference > 0) {
				// Load the content collection model and then find all the content elements that belong to this page_uid
				$contentCollection = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\Domain\\Collection\\BackendContentCollection");
				$referencedContent = $contentCollection
					->where("is_deleted = 0 AND uid = :uid ORDER BY sorting ASC", [":uid" => $reference])
					->getFirst();
				// set the element's id to the reference id, so that we do not modify the original
				$referencedContent->setUid($this->getUid());
				//$referencedContent->setType("reference");
				if ($referencedContent) {
					if ($referencedContent->getType() != "container") {
						$value = $referencedContent->render(null);
					} else {
						$contentCollection
							->where("page_uid = :page_uid", ["page_uid" => $referencedContent->getPageUid()]);
						$elements = $contentCollection->findChildrenForUid($reference);
						$value = $referencedContent->render($elements->children);
					}
				}
			}

			return sprintf('<div class="content-type-reference"><p class="reference-title"><i class="fa fa-fw fa-chain"></i> %s </p>%s <a class="btn btn-danger" href=""><i class="fa fa-unlink"></i> %s</a></div>',
				Utility::helper("Localization")->translate("backend.content.reference.info", ["content_id" => $referencedContent->getUid(), "page_id" => $referencedContent->getPageUid()]),
				$value,
				Utility::helper("Localization")->translate("backend.content.reference.delete")
			);
		}
	}

}
