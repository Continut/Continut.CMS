<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 22:46
 * Project: Conţinut CMS
 */
namespace Core\System\Domain\Model {

	use Core\Mvc\Model\BaseModel;

	class Language extends BaseModel {

		/**
		 * Get language title
		 *
		 * @return string
		 */
		public function getTitle() {
			return $this->title;
		}

		/**
		 * Get language iso3 code
		 *
		 * @return string
		 */
		public function getLanguageIso3() {
			return $this->language_iso_3;
		}
	}

}
