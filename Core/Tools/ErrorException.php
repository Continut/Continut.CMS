<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 09.08.2015 @ 15:29
 * Project: Conţinut CMS
 */
namespace Continut\Core\Tools {

	class ErrorException extends Exception {
		/**
		 * @param string $message
		 * @param int    $code
		 */
		public function __construct($message, $code = 0) {
			$message = $message . " | Error occured in the file " . $this->getFile() . " on line " . $this->getLine();
			$message .= $this->simpleTrace();
			parent::__construct($message, $code);
		}

		protected function simpleTrace() {
			$trace = explode("\n", $this->getTraceAsString());
			$trace = array_reverse($trace);
			array_shift($trace);
			array_pop($trace);
			$length = count($trace);
			$result = array();

			for ($i = 0; $i < $length; $i++)
			{
				$result[] = ($i + 1)  . ')' . substr($trace[$i], strpos($trace[$i], ' '));
			}

			return "\t" . implode("\n\t", $result);
		}
	}

}
