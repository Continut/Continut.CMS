<?php
/**
 * This file is part of the Con?inut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogo? <radu.mogos@pixelplant.ch>
 * Date: 01.08.2015 @ 13:40
 * Project: Con?inut CMS
 */
namespace Core\System\Storage {

	/**
	 * Interface StorageInterface
	 *
	 * Used to manipulate files either in a local or cloud storage
	 *
	 * @package Core\System\Storage
	 */
	interface StorageInterface
	{
		public function getRoot();
		public function getFiles($path);
		public function getFolders($path);
	}

}
