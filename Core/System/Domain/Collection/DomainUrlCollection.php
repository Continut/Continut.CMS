<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 08.08.2015 @ 15:11
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Domain\Collection {

	use Continut\Core\Mvc\Model\BaseRepository;

	class DomainUrlCollection extends BaseRepository {

		/**
		 * @param bool   $addEmpty   Should an initial empty value be added?
		 * @param string $emptyTitle If so, what title should be shown, if any
		 *
		 * @return array
		 */
		public function toSimplifiedArray($addEmpty = false, $emptyTitle = "") {
			$data = [];
			if ($addEmpty) {
				$data = [0 => ["title" => $emptyTitle, "flag" => "eu"]];
			}
			foreach ($this->getAll() as $language) {
				$data[$language->getId()] = [
					"title" => $language->getTitle(),
					"flag"  => $language->getFlag()
				];
			}
			return $data;
		}

	}

}
