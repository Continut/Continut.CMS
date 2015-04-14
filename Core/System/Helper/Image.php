<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 13.04.2015 @ 22:06
 * Project: Conţinut CMS
 */
namespace Core\System\Helper {

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

			$newFilename = "Cache/Temp/Images/" . $prefix . "_" . md5($image . $width . $height);
			$newFilenameFullpath = __ROOTCMS__ . "/" . $newFilename;

			// if cached version already exists, send it
			if (file_exists($newFilenameFullpath)) {
				return $newFilename;
			}

			$filename = __ROOTCMS__ . $image;

			$imageInfo = getimagesize($filename);
			$imageType = $imageInfo[2];

			if ($imageType == IMAGETYPE_JPEG) {
				$imageResource = imagecreatefromjpeg($filename);
			} elseif ($imageType == IMAGETYPE_GIF) {
				$imageResource = imagecreatefromgif($filename);
			} elseif ($imageType == IMAGETYPE_PNG) {
				$imageResource = imagecreatefrompng($filename);
			}

			$newImage = imagecreatetruecolor($width, $height);

			// retain transparency for PNG or GIF files
			if ($imageType == IMAGETYPE_GIF || $imageType == IMAGETYPE_PNG) {
				$currentTransparent = imagecolortransparent($imageResource);
				if ($currentTransparent != -1) {
					$transparentColor = imagecolorsforindex($imageResource, $currentTransparent);
					$currentTransparent = imagecolorallocate($newImage, $transparentColor['red'], $transparentColor['green'], $transparentColor['blue']);
					imagefill($newImage, 0, 0, $currentTransparent);
					imagecolortransparent($newImage, $currentTransparent);
				} elseif ($imageType == IMAGETYPE_PNG) {
					imagealphablending($newImage, false);
					$color = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
					imagefill($newImage, 0, 0, $color);
					imagesavealpha($newImage, true);
				}
			}
			imagecopyresampled($newImage, $imageResource, 0, 0, 0, 0, $width, $height, imagesx($imageResource), imagesy($imageResource));

			if ($imageType == IMAGETYPE_JPEG) {
				imagejpeg($newImage, $newFilenameFullpath, 75);
			} elseif ($imageType == IMAGETYPE_GIF) {
				imagegif($newImage, $newFilenameFullpath);
			} elseif ($imageType == IMAGETYPE_PNG) {
				imagepng($newImage, $newFilenameFullpath);
			}

			imagedestroy($newImage);
			imagedestroy($imageResource);

			return $newFilename;
		}
	}

}