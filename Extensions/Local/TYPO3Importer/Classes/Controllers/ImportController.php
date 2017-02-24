<?php

namespace Continut\Extensions\Local\TYPO3Importer\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

class ImportController extends BackendController
{
    /**
     * Set the layout to be used on this page by default, for all actions
     */
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource('Default', 'Backend', 'Backend', 'Layout'));
    }

    public function indexAction() {
    }

    public function importAction() {
        $import = $this->getRequest()->getArgument('import');

        try {
            $dbh = new \PDO($import['dsn'], 'root', 'virtua311');

            /** @var \Continut\Core\System\Domain\Collection\PageCollection $pageCollection */
            $pageCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\PageCollection');

            $lastUid = 0;

            $pageCollection
                ->where('domain_url_id = :id', ['id' => $import['domain_url_id']])
                ->delete();

            foreach ($dbh->query('SELECT * FROM pages ORDER BY uid ASC') as $typoPage) {
                $pageData = [
                    //'id' => $page['uid']
                    'domain_url_id'    => (int)$import['domain_url_id'],
                    'title'            => $typoPage['title'],
                    'is_deleted'       => $typoPage['deleted'],
                    'is_visible'       => ($typoPage['hidden']) ? 0 : 1,
                    'is_in_menu'       => ($typoPage['nav_hide']) ? 0 : 1,
                    'parent_id'        => ($typoPage['pid'] == 0) ? 0 : ($lastUid + (int)$typoPage['pid'] - 1),
                    'meta_keywords'    => $typoPage['keywords'],
                    'meta_description' => $typoPage['description'],
                    'sorting'          => $typoPage['sorting'],
                    'original_id'      => 0,
                    'slug'             => Utility::generateSlug($typoPage['title'])
                ];

                /** @var \Continut\Core\System\Domain\Model\Page $page */
                $page = Utility::createInstance('Continut\Core\System\Domain\Model\Page');
                $page->update($pageData);

                // offset the PID based on the first insert
                if ($lastUid == 0) {
                    $pageCollection->reset()->add($page);
                    $lastUid = (int)$pageCollection->getLastInsertId();
                    $pageCollection->save();
                } else {
                    $pageCollection->add($page);
                }
            }
            $pageCollection->save();

        } catch (\PDOException $e) {
            // @TODO: treat error
            var_dump($e->getMessage());
        }
    }
}
