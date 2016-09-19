<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 12:54
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Helper {

    use Continut\Core\Utility;

    class Units
    {

        /**
         * Formats bytes to any other measurement unit
         *
         * @param int $size Size in bytes
         * @param int $precision Precission to use
         *
         * @return string
         */
        public function formatBytes($size, $precision = 2)
        {
            $unitLabels = [
                'system.helper.units.bytes',
                'system.helper.units.kilobytes',
                'system.helper.megabytes',
                'system.helper.gigabytes',
                'system.helper.terabytes'
            ];

            $size = max($size, 0);
            $pow = floor(($size ? log($size) : 0) / log(1024));
            $pow = min($pow, count($unitLabels) - 1);

            $size /= pow(1024, $pow);

            return Utility::helper("Localization")->translate($unitLabels[$pow], ["size" => round($size, $precision)]);
        }
    }

}
