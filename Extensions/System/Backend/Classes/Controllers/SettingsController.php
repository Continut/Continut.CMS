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
    /**
     * Set the layout to be used on this page by default, for all actions
     */
    public function __construct()
    {
        parent::__construct();
        $this->getMenuItems();
        $this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
    }

    /**
     * Default action
     */
    public function indexAction()
    {
    }

    /**
     * Grab available languages (domainUrls) for the selected domain
     *
     * @return string JSON encoded list of available languages
     */
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

    /**
     * Show and handle domains and domainUrl settings
     */
    public function domainsAction() {
        $allDomains = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection')->findAll();

        $this->getView()->assign('allDomains', $allDomains);
    }

    /**
     * Create a new domain
     */
    public function newDomainAction() {
        $domain = Utility::createInstance('Continut\Core\System\Domain\Model\Domain');

        $domain->setId(0);
        $this->getView()->assign('domain', $domain);
    }


    public function saveDomainAction() {
        $data = $this->getRequest()->getArgument("data");
        $id = (int)$data["id"];

        // reference the collection
        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');

        // new domain, to add
        if ($id == 0) {
            $domain = Utility::createInstance('Continut\Core\System\Domain\Model\Domain');

            $domain->update($data);
        }
        // edit and save
        else {
            $domain = $domainsCollection->findById($id);
        }

        if ($domain->validate()) {
            $domainsCollection
                ->reset()
                ->add($domain)
                ->save();

            // redirect to the "domainsAction" since all went well and data is saved
            $this->redirect(Utility::helper("Url")->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'domains']));
        }

        $this->getView()->assign('domain', $domain);
    }

    /**
     * Edit a language/domainUrl
     */
    public function editDomainUrlAction() {
        $domainUrlId = $this->getRequest()->getArgument("id", 0);

        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');
        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');

        $domainUrl = null;
        if ($domainUrlId > 0) {
            $domainUrl = $languagesCollection->findById($domainUrlId);
        }

        $this->getView()->assign('domainUrl', $domainUrl);
        $this->getView()->assign('domains', $domainsCollection->getAll());
    }

    /**
     * Save domainUrl object
     */
    public function saveDomainUrlAction() {
        $data = $this->getRequest()->getArgument("data");
        $id   = (int)$data["id"];

        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
        $domainUrl = $languagesCollection->findById($id);

        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');

        $domainUrl->update($data);

        if ($domainUrl->validate()) {
            $languagesCollection
                ->reset()
                ->add($domainUrl)
                ->save();
        }

        $this->getView()->assign('domainUrl', $domainUrl);
        $this->getView()->assign('domains',   $domainsCollection->getAll());
    }

    /**
     * Show session settings
     */
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
