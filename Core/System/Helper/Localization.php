<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 18.04.2015 @ 20:12
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\Helper;

use Continut\Core\Utility;

class Localization
{

    /**
     * List of available translation labels for the current selected language
     *
     * @var array
     */
    protected $translationLabels = [];

    /**
     * Return a translated label, if found, otherwise return the label key
     *
     * @param string $label
     * @param array $parameters
     *
     * @return string
     */
    public function translate($label, $parameters = [])
    {
        if (isset($this->translationLabels[$label])) {
            if (empty($parameters)) {
                return $this->translationLabels[$label];
            }
            return $this->sprintfWithParameters($this->translationLabels[$label], $parameters);
        }
        return $label;
    }

    /**
     * @return array
     */
    public function getTranslationLabels()
    {
        return $this->translationLabels;
    }

    /**
     * @param $translationLabels
     */
    public function setTranslationLabels($translationLabels)
    {
        $this->translationLabels = $translationLabels;
    }

    /**
     * Adds a translated label to the global list
     *
     * @param string $key
     * @param string $value
     */
    public function addLabel($key, $value)
    {
        $this->translationLabels[$key] = $value;
    }

    /**
     * Load language labels from a file
     *
     * @param string $locale
     * @param string $path
     */
    public function loadLabelsFromPath($locale, $path)
    {
        $fileToLoad = $path . DS . $locale . '.json';
        // en_US is the default locale, and extensions should at least be translated for this locale
        // so if you're loading a different translation and it does not exist, check for the en_US one first
        if (!file_exists($fileToLoad) && $locale != 'en_US') {
            $fileToLoad = $path . DS . 'en_US.json';
        }
        if (file_exists($fileToLoad)) {
            $labels = json_decode(file_get_contents($fileToLoad), TRUE);
            if (is_array($labels)) {
                $this->translationLabels = Utility::arrayMergeRecursiveUnique($this->translationLabels, $labels);
            } else {
                Utility::debugData("$fileToLoad: The localization file could not be loaded. It was either empty, or has invalid data.", "error");
            }
        }
    }

    /**
     * Allows us to use named parameters for vsprintf calls
     *
     * @param string $text
     * @param array $parameters
     *
     * @return string
     */
    public function sprintfWithParameters($text, $parameters)
    {
        $matchesCount = preg_match_all('/%\((.*?)\)/', $text, $matches, PREG_SET_ORDER);
        if ($matchesCount == 0) {
            return $text;
        }

        $values = [];
        foreach ($matches as $match) {
            $values[] = $parameters[$match[1]];
        }

        $text = preg_replace('/%\((.*?)\)/', '%s', $text);
        return vsprintf($text, $values);
    }
}
