<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 13.04.2015 @ 22:06
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Helper;

use Continut\Core\Utility;

class Image
{

    /**
     * Resize an image and return it's url
     *
     * @param int|string $image Image name or image id from sys_file to resize with path and file extension
     * @param int $width Image width to resize to
     * @param int $height Image height to resize to
     * @param string $prefix Prefix to use for the cached image, by default it is "resize"
     *
     * @return string The fullpath of the newly generated image
     */
    public function resize($image, $width, $height, $prefix = 'resize')
    {
        $fileParts = $this->getImageOrReference($image, $width, $height, $prefix);

        $resizedImage         = $fileParts['resizedImage'];
        $resizedImageAbsolute = $fileParts['resizedImageAbsolute'];
        $absoluteFilename     = $fileParts['absoluteFilename'];

        if (file_exists($resizedImageAbsolute)) {
            return $resizedImage;
        }
        if (!file_exists($absoluteFilename)) {
            return '';
        }

        Utility::$imageManager
            ->make($absoluteFilename)
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($resizedImageAbsolute);

        return $resizedImage;
    }

    /**
     * Crop an image and return it's url
     *
     * @param int|string $image Image name or image id from sys_file to resize with path and file extension
     * @param int $width Image width to resize to
     * @param int $height Image height to resize to
     * @param string $prefix Prefix to use for the cached image, by default it is "resize"
     *
     * @return string The fullpath of the newly generated image
     */
    public function crop($image, $width, $height, $prefix = 'crop')
    {
        $fileParts = $this->getImageOrReference($image, $width, $height, $prefix);

        $resizedImage         = $fileParts['resizedImage'];
        $resizedImageAbsolute = $fileParts['resizedImageAbsolute'];
        $absoluteFilename     = $fileParts['absoluteFilename'];

        if (file_exists($resizedImageAbsolute)) {
            return $resizedImage;
        }
        if (!file_exists($absoluteFilename)) {
            return '';
        }

        Utility::$imageManager
            ->make($absoluteFilename)
            ->fit($width, $height)
            ->save($resizedImageAbsolute);

        return $resizedImage;
    }

    /**
     * Fetches the absolute path of an image or of a file reference from sys_file_reference
     *
     * @param int|string $image
     * @param int $width
     * @param int $height
     * @param string $prefix
     *
     * @return array The absolute filename's path and the absolute filename path for it's resized version
     */
    protected function getImageOrReference($image, $width, $height, $prefix)
    {
        $imageId = (int)$image;
        if ($imageId > 0) {
            $fileReferenceCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\FileReferenceCollection');
            $fileReference = $fileReferenceCollection->findById($imageId);
            if ($fileReference) {
                $image = $fileReference->getFile()->getRelativePath();
            }
        }
        $extension            = pathinfo($image, PATHINFO_EXTENSION);
        $resizedImage         = 'Cache/Temp/Images/' . $prefix . '_' . md5($image . $width . $height) . '.' . $extension;
        $resizedImageAbsolute = __ROOTCMS__ . DS . $resizedImage;
        $absoluteFilename     = __ROOTCMS__ . DS . $image;

        return [
            'resizedImage'         => $resizedImage,
            'absoluteFilename'     => $absoluteFilename,
            'resizedImageAbsolute' => $resizedImageAbsolute
        ];
    }

    public function getPath($filename, $extensionName)
    {
        return "/" . Utility::getAssetPath($filename, $extensionName);
    }
}
