<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 02.01.2016 @ 18:04
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Domain\Collection {

    use Continut\Core\Mvc\Model\BaseCollection;

    class NewsCollection extends BaseCollection
    {

        /**
         * Set tablename and each element's class
         */
        public function __construct()
        {
            $this->tablename = "ext_news";
            $this->elementClass = 'Continut\Extensions\Local\News\Classes\Domain\Model\News';
        }
    }
}