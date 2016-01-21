<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 13.04.2015 @ 22:06
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Helper {

	use Continut\Core\Utility;

	class Image {

		/**
		 * Resize an image and return it's url
		 *
		 * @param string $image  Image name to resize with path and file extension
		 * @param int    $width  Image width to resize to
		 * @param int    $height Image height to resize to
		 * @param string $prefix Prefix to use for the cached image, by default it is "pic"
		 *
		 * @return string The fullpath of the newly generated image
		 */
		public function resize($image, $width, $height, $prefix = "pic") {

			$extension = pathinfo($image, PATHINFO_EXTENSION);
			$newFilename = "Cache/Temp/Images/" . $prefix . "_" . md5($image . $width . $height) . "." . $extension;
			$newFilenameFullpath = __ROOTCMS__ . "/$newFilename";

			$absoluteFilename = __ROOTCMS__ . $image;

			if (file_exists($newFilenameFullpath)) {
				return $newFilename;
			}
			if (!file_exists($absoluteFilename)) {
				return "";
			}

			Utility::$imageManager->make($absoluteFilename)->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
			})->save($newFilenameFullpath);

			return $newFilename;
		}

		public function getPath($filename, $extensionName) {
			return "/" . Utility::getAssetPath($filename, $extensionName);
		}
	}

}