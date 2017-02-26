<?php
/**
 * This file is part of the Con?inut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 01.08.2015 @ 13:40
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Storage;

/**
 * Interface StorageInterface
 *
 * Used to manipulate files either in a local or cloud storage
 *
 * @package Continut\Core\System\Storage
 */
interface StorageInterface
{
    public function getRoot();

    public function getFiles($path);

    public function getFolders($path);

    public function createFolder($folder, $path);

    public function getFileInfo($identifier);
}
