<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 08.05.2015 @ 23:07
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\Helper {

    use Continut\Core\Utility;

    class Session
    {

        /**
         * @param $type
         *
         * @return string
         */
        public function showFlashMessages($type = null)
        {
            $html = "";
            $messageTypes = null;
            if ($type) {
                $messageTypes[$type] = Utility::getSession()->getFlashMessages($type);
                Utility::getSession()->clearFlashMessages($type);
            } else {
                $messageTypes = Utility::getSession()->getAllFlashMessages();
                Utility::getSession()->clearAllFlashMessages();
            }
            if ($messageTypes) {
                foreach ($messageTypes as $type => $messages) {
                    if ($messages) {
                        foreach ($messages as $message) {
                            $html .= sprintf('<div class="alert flash-%s">%s</div>', $type, $message);
                        }
                    }
                }
            }
            return $html;
        }
    }

}
