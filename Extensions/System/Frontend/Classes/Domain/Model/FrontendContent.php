<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 21:41
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Domain\Model;

use Continut\Core\System\Domain\Model\Content;
use Continut\Core\Utility;

class FrontendContent extends Content
{
    /**
     * Render a regular "Content" element
     *
     * @param mixed $elements
     *
     * @return string
     */
    public function render($elements)
    {
        $configuration = json_decode($this->getValue(), TRUE);

        $variables = $configuration['content']['data'];
        // we overwrite the title, if such a variable exists, with the value of the column "title" in the content table
        $variables['title'] = $this->getTitle();

        $view = Utility::createInstance('Continut\Core\Mvc\View\BaseView');
        $view->setTemplate(Utility::getResourcePath(
            $configuration['content']['template'],
            $configuration['content']['extension'],
            'Frontend',
            'Content'
        ));
        $view->setAdditionalData($this->frontendEditor());
        $view->assignMultiple($variables);

        return $view->render();
    }
}
