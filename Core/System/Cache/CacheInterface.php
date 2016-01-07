<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project

 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 07.04.2015 @ 11:20
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Cache {

	interface CacheInterface
	{
		public function getById($id, $type);
		public function getByKey($key, $type);
		public function setById($id, $type, $data);
	}
}