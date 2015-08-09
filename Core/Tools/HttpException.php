<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 09.08.2015 @ 14:44
 * Project: Conţinut CMS
 */
namespace Core\Tools {

	class HttpException extends Exception {

		/**
		 * @param int    $code
		 * @param string $message
		 */
		public function __construct($code, $message = "") {
			parent::__construct($message, $code);
		}
	}

}
