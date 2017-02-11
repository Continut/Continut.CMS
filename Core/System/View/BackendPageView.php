<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 06.04.2015 @ 19:42
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\View;

use Continut\Core\Mvc\View\PageView;
use Continut\Core\Utility;

class BackendPageView extends PageView
{

    /**
     * A custom premade layout is used for this PageView
     *
     * @param string $template
     *
     * @return void
     */
    public function setLayoutFromTemplate($template)
    {
        $this->layout = Utility::createInstance('Continut\Core\System\View\BackendLayout');
        $this->layout
            ->setPageView($this)
            ->setTemplate($template);
    }

    /**
     * The BackendPageView only renders the content inside <body>, no wrappers (so no <head> parts) and it is only
     * used to render the backend pages once selected in the page tree
     *
     * @return string
     */
    public function render()
    {
        return $this->getLayout()->render();
    }
}
