<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 18:59
 * Project: Conţinut CMS
 */
namespace Continut\Core\System\View {

    use Continut\Core\Mvc\View\Container;

    class BackendContainer extends Container
    {
        /**
         * Show all content from a child container, can be called recursively inside other containers
         *
         * @param $id Id if the container to show
         *
         * @return string
         */
        public function showContainerColumn($id)
        {
            $htmlElements = "";

            foreach ($this->getElements() as $element) {
                if ($element->getColumnId() == $id) {
                    $htmlElements .= $element->render($element->children);
                }
            }

            return sprintf('<div data-parent="%s" data-id="%s" class="container-receiver">%s</div>', $this->getId(), $id, $htmlElements);
        }
    }
}