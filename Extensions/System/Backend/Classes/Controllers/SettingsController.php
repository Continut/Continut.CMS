<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 31.12.2015 @ 14:46
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\System\Backend\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

class SettingsController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->getMenuItems();
        $this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
    }

    public function indexAction()
    {
    }

    public function languagesAction()
    {
        $domainId = $this->getRequest()->getArgument("domain_id", 0);

        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');

        if ($domainId > 0) {
            $languagesCollection->where("domain_id = :domain_id ORDER BY sorting ASC", ["domain_id" => $domainId]);
        }
        $languages = $languagesCollection->toSimplifiedArray(TRUE, "All");

        return json_encode(["languages" => $languages]);
    }

    public function domainsAction() {
    }

    public function sessionAction() {
    }

    /**
     * The menu should be displayed on every subsection of "settings", in a partial, so we call it in the constructor
     */
    protected function getMenuItems() {
        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');
        $domainsCollection->where("is_visible = :is_visible ORDER BY sorting ASC", ["is_visible" => 1]);

        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
        $languagesCollection->where("domain_id = :domain_id ORDER BY sorting ASC", ["domain_id" => $domainsCollection->getFirst()->getId()]);

        $this->getView()->assign('menu',
            [
                'domains'   => $domainsCollection,
                'languages' => $languagesCollection
            ]
        );
    }
}
