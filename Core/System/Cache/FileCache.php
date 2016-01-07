<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 11:22
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Cache {

	class FileCache implements CacheInterface
	{
		const CACHE_DIR = "/Cache/Content/";

		/**
		 * @var int Default lifetime for cache, in seconds
		 */
		protected $_lifetime = 3600;

		public function getById($id, $type) {
			return NULL;
			$filename = __ROOTCMS__ . self::CACHE_DIR . $type . "_" . $id;
			if (file_exists($filename)) {
				return file_get_contents($filename);
			}
		}

		public function setById($id, $type, $data) {
			$filename = __ROOTCMS__ . self::CACHE_DIR . $type . "_" . $id;
			file_put_contents($filename, $data);
		}

		public function getByKey($key, $type) {

		}
	}
}