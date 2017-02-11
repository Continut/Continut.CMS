<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 09.08.2015 @ 15:29
 * Project: Conţinut CMS
 */

namespace Continut\Core\Tools;

class ErrorException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 0)
    {
        $message = $message . " | Error occured in the file " . $this->getFile() . " on line " . $this->getLine();
        parent::__construct($message, $code);
    }
}
