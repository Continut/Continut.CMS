<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 18.04.2015 @ 20:12
 * Project: Conţinut CMS
 */
namespace Core\System\Helper {

	class Localization {

		/**
		 * List of available translation labels for the current selected language
		 *
		 * @var array
		 */
		protected $_translationLabels = [];

		/**
		 * Return a translated label, if found, otherwise return the label key
		 *
		 * @param string $label
		 * @param array  $parameters
		 *
		 * @return string
		 */
		public function translate($label, $parameters = []) {
			if (isset($this->_translationLabels[$label])) {
				if (empty($parameters)) {
					return $this->_translationLabels[ $label ];
				}
				return $this->sprintfWithParameters($this->_translationLabels[ $label ], $parameters);
			}
			return $label;
		}

		/**
		 * @return array
		 */
		public function getTranslationLabels() {
			return $this->_translationLabels;
		}

		/**
		 * @param $translationLabels
		 */
		public function setTranslationLabels($translationLabels) {
			$this->_translationLabels = $translationLabels;
		}

		/**
		 * Adds a translated label to the global list
		 *
		 * @param string $key
		 * @param string $value
		 */
		public function addLabel($key, $value) {
			$this->_translationLabels[$key] = $value;
		}

		/**
		 * Load language labels from a file
		 *
		 * @param string $file
		 */
		public function loadLabelsFromFile($file) {
			if (file_exists($file)) {
				$labels = json_decode(file_get_contents($file), TRUE);
				foreach ($labels as $extensionName => $languages) {
					foreach ($languages as $languageCode => $language) {
						if ($languageCode == "ro_RO") {
							$this->_translationLabels = array_merge_recursive($this->_translationLabels, $language);
						}
					}
				}
			}
		}

		/**
		 * Allows us to use named parameters for vsprintf calls
		 *
		 * @param string $text
		 * @param array  $parameters
		 *
		 * @return string
		 */
		public function sprintfWithParameters($text, $parameters) {
			$matchesCount = preg_match_all('/%\((.*?)\)/', $text, $matches, PREG_SET_ORDER);
			if ($matchesCount == 0) {
				return $text;
			}

			$values = [];
			foreach($matches as $match) {
				$values[] = $parameters[$match[1]];
			}

			$text = preg_replace('/%\((.*?)\)/', '%s', $text);
			return vsprintf($text, $values);
		}
	}

}
