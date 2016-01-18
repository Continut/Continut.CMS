<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 19.04.2015 @ 17:31
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Helper {

	class String {

		/**
		 * Truncates a text on the first $chars characters. It also tries to truncate them at the end of the word
		 * @param string $text           The text to truncate
		 * @param int    $truncateAfter  After how many characters to truncate
		 * @param string $append         Text to append at the end of the string
		 *
		 * @return string
		 */
		public function truncate($text, $truncateAfter = 25, $append = "...") {
			$initialText = $text;
			$text = $text . " ";
			$text = mb_substr($text, 0, $truncateAfter);
			$text = mb_substr($text, 0, mb_strrpos($text, " "));
			if (mb_strlen($text) < mb_strlen($initialText)) {
				// some languages, like japanese, do not have spaces between words so truncating them
				// by spaces might return a zero length string, thus we need to check if the truncated string
				// is zero, we do a basic substr to return the first $chars characters
				if ((mb_strlen($text) == 0) && mb_strlen($initialText) > 0) {
					$text = mb_substr($initialText, 0, $truncateAfter);
				}
				$text = $text . $append;
			}
			return $text;
		}

		/**
		 * @param $string
		 *
		 * @return mixed|string
		 *
		 * @see https://php.net/manual/en/function.strip-tags.php#110280
		 */
		public function stripTags($string) {

			$string = preg_replace ('/<[^>]*>/', ' ', $string);

			$string = str_replace("\r", '', $string);
			$string = str_replace("\n", ' ', $string);
			$string = str_replace("\t", ' ', $string);

			$string = trim(preg_replace('/ {2,}/', ' ', $string));

			return $string;

		}
	}

}
