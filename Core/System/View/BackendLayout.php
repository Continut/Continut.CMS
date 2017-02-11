<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 06.04.2015 @ 19:31
 * Project: Conţinut CMS
 */

namespace Continut\Core\System\View;

use Continut\Core\Mvc\View\BaseLayout;
use Continut\Core\Utility;

class BackendLayout extends BaseLayout
{
    /**
     * @var string Content to show in the layout
     */
    protected $content = NULL;

    /**
     * @return string
     */
    public function showContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Show all content from a container and wrap it in a special class, for backend drag & drop
     *
     * @param int $id Id if the container to show
     *
     * @return string
     */
    public function showContainerColumn($id)
    {
        return sprintf('<div data-id="%s" data-parent="0" class="container-receiver">%s</div><a class="btn btn-sm btn-success content-wizard" title="%s" href="%s"><i class="fa fa-plus fa-fw"></i></a>',
            $id,
            parent::showContainerColumn($id),
            $this->__("backend.content.addNew"),
            Utility::helper("Url")->linkToPath('admin_backend', ['_controller' => 'Content', '_action' => 'wizard', 'column_id' => $id, 'page_id' => Utility::getRequest()->getArgument('page_id')])
        );
    }
}
