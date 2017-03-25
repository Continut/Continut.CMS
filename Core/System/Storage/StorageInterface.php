<?php
/**
 * This file is part of the Conținut CMS project.
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
    /**
     * Returns the root path of this storage
     *
     * @return mixed
     */
    public function getRoot();

    /**
     * Returns a list of all the files found in the path
     *
     * @param string $path
     * @return mixed
     */
    public function getFiles($path);

    /**
     * Returns a list of all the folders found in the path
     *
     * @param string $path
     * @return mixed
     */
    public function getFolders($path);

    /**
     * Createa a folder in a certain path
     *
     * @param string $folder
     * @param string $path
     * @return mixed
     */
    public function createFolder($folder, $path);

    /**
     * Returns all the information found on a file
     *
     * @param $identifier
     * @return mixed
     */
    public function getFileInfo($identifier);
}
