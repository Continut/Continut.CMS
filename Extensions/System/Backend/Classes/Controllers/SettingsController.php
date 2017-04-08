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
        $this->initializeDefaults();
        $this->setLayoutTemplate(Utility::getResourcePath('Default', 'Backend', 'Backend', 'Layout'));
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
        $allDomains = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection')
            ->findAll();

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

    /**
     * Save config data into sys_configuration
     */
    public function saveSettingsAction() {
        $data = $this->getRequest()->getArgument('data');
        // @TODO : Store data into the DB
    }


    public function saveDomainAction() {
        $data = $this->getRequest()->getArgument('data');
        $id = (int)$data['id'];

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
            $this->redirect(Utility::helper('Url')->linkToPath('admin', ['_controller' => 'Settings', '_action' => 'domains']));
        }

        $this->getView()->assign('domain', $domain);
    }

    /**
     * Edit a language/domainUrl
     */
    public function editDomainUrlAction() {
        $domainUrlId = $this->getRequest()->getArgument('id', 0);

        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection')
            ->findAll();
        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');

        $domainUrl = null;
        if ($domainUrlId > 0) {
            $domainUrl = $languagesCollection->findById($domainUrlId);
        }

        $this->getView()->assign('domainUrl', $domainUrl);
        $this->getView()->assign('domains', $domainsCollection);
    }

    /**
     * Save domainUrl object
     */
    public function saveDomainUrlAction() {
        $data = $this->getRequest()->getArgument('data');
        $id   = (int)$data["id"];

        $languagesCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainUrlCollection');
        $domainUrl = $languagesCollection->findById($id);

        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection')
            ->findAll();

        $domainUrl->update($data);

        if ($domainUrl->validate()) {
            $languagesCollection
                ->reset()
                ->add($domainUrl)
                ->save();
        }

        $this->getView()->assign('domainUrl', $domainUrl);
        $this->getView()->assign('domains',   $domainsCollection);
    }

    /**
     * Show session settings
     */
    public function sessionAction() {
        //var_dump(Utility::getConfiguration());
    }

    /**
     * Show media/files settings
     */
    public function mediaAction() {
    }

    /**
     * The menu should be displayed on every subsection of "settings", in a partial, so we call it in the constructor
     */
    protected function initializeDefaults() {
        $domainsCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\DomainCollection');
        $domainsCollection->findAll();

        if ($this->getSession()->has('configurationSite')) {
            $this->getSession()->set('configurationSite', (string)$this->getRequest()->getArgument('configuration_site', $this->getSession()->get('configurationSite')));
        } else {
            $this->getSession()->set('configurationSite', (string)$this->getRequest()->getArgument('configuration_site', 0));
        }

        $configurationCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\ConfigurationCollection');
        $config = [];

        // if we are in global scope, get global config only
        if ($this->getSession()->get('configurationSite') === '0') {
            $configurationCollection->where('domain_id = 0 AND language_id = 0 ORDER BY domain_id ASC, language_id ASC');
        }

        // or get domain level
        if (strpos($this->getSession()->get('configurationSite'), 'domain_') === 0) {
            $parts = explode('_', $this->getSession()->get('configurationSite'));
            $domainId = (int)$parts[1];
            $configurationCollection
                ->where(
                    '(domain_id = 0 AND language_id = 0) OR (domain_id = :domain_id AND language_id = 0) ORDER BY domain_id ASC, language_id ASC',
                    [
                        'domain_id' => $domainId
                    ]
                );
        }

        // or language one
        if (strpos($this->getSession()->get('configurationSite'), 'url_') === 0) {
            $parts = explode('_', $this->getSession()->get('configurationSite'));
            $languageId = (int)$parts[1];
            $configurationCollection
                ->where(
                    'language_id = :language_id ORDER BY domain_id ASC, language_id ASC',
                    [
                        'language_id' => $languageId
                    ]
                );
        }

        foreach ($configurationCollection->getAll() as $configuration) {
            $config[$configuration->getKey()] = $configuration->getValue();
        }

        $this->getView()->assign('data',
            [
                'domains' => $domainsCollection,
                'action'  => $this->getRequest()->getAction(),
                'config'  => $config,
                'configurationSite' => $this->getSession()->get('configurationSite')
            ]
        );
    }
}
