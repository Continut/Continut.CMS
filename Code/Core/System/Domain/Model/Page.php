<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 05.04.2015 @ 12:40
 * Project: Conţinut CMS
 */

namespace Core\System\Domain\Model {

	use Core\Mvc\Model\BaseModel;
	use Core\Utility;

	class Page extends BaseModel {

		/**
		 * @var string Page title
		 */
		protected $title = "Unnamed page";

		protected $parent;

		/**
		 * @var int Parent page id
		 */
		protected $parent_uid;

		/**
		 * @var string iso3 code of this page's language
		 */
		protected $language_iso3 = "";

		/**
		 * @var bool Is our Page visible in the Frontend?
		 */
		protected $is_visible = TRUE;

		/**
		 * @var boor Has our Page been deleted?
		 */
		protected $is_deleted = FALSE;

		/**
		 * @var int The id of the domain this page belongs to
		 */
		protected $domain_uid = 0;

		/**
		 * @var string Layout used by this Page
		 */
		protected $frontend_layout;

		/**
		 * @var string Cached path used for breadcrumb (List of comma separated values of parent uids)
		 */
		protected $cached_path;

		/**
		 * @var string Backend layout
		 */
		protected $backend_layout;

		public function getTitle() {
			return $this->title;
		}

		public function getLanguageIso3() {
			return $this->language_iso3;
		}

		public function getParentUid() {
			return $this->parent_uid;
		}

		public function getParent() {
			if ($this->parent_uid) {
				if (empty($this->parent)) {
					$this->parent = Utility::createInstance("\\Core\\System\\Domain\\Collection\\PageCollection")->
					where("uid = :parent_uid", $this->getParentUid())
						->getFirst();
				}
			}

			return $this->parent;
		}

		public function getFrontendLayout() {
			return $this->frontend_layout;
		}

		public function getBackendLayout() {
			return $this->backend_layout;
		}

		public function getCachedPath() {
			return $this->cached_path;
		}
	}
}