<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.08.2015 @ 21:17
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Frontend\Classes\Domain\Model\Content;

use Continut\Core\Utility;
use Continut\Extensions\System\Frontend\Classes\Domain\Model\FrontendContent;

class FrontendContainerContent extends FrontendContent
{
    /**
     * Rendere a "Container" element
     *
     * @param mixed $elements
     *
     * @return string
     */
    public function render($elements)
    {
        $configuration = json_decode($this->getValue(), TRUE);
        $variables = $configuration["container"]["data"];

        $container = Utility::createInstance('Continut\Core\Mvc\View\Container');
        $container->setId($this->getId());
        $container->setElements($elements);
        $container->setTemplate(
            Utility::getResourcePath(
                $configuration['container']['template'],
                $configuration['container']['extension'],
                'Frontend',
                'Container'
            )
        );
        $container->setAdditionalData($this->frontendEditor());
        $container->assignMultiple($variables);
        return $container->render();
    }
}
