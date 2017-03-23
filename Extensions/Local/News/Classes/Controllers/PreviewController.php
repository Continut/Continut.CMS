<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 11.04.2015 @ 18:48
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Controllers {

    use Continut\Core\Mvc\Controller\BackendController;
    use Continut\Core\Utility;

    class PreviewController extends BackendController
    {

        public function backendConfigureAction()
        {
        }

        public function backendPreviewAction()
        {
            $newsCollection = Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Collection\NewsCollection');

            $limit = (isset($this->data['limit'])) ? $this->data['limit'] : 1;
            $order = (isset($this->data['order'])) ? $this->data['order'] : 'created_at';
            $direction = (isset($this->data['direction'])) ? $this->data['direction'] : 'asc';
            $newsCollection->where("1=1 ORDER BY $order $direction LIMIT $limit");

            $this->getView()->assign('news', $newsCollection);
            $this->getView()->assign('data', $this->data);
        }
    }

}
