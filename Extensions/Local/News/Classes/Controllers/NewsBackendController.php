<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 31.05.2015 @ 22:28
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Controllers;

use Continut\Core\Mvc\Controller\BackendController;
use Continut\Core\Utility;

class NewsBackendController extends BackendController
{

    /**
     * NewsBackendController constructor - set default layout
     */
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource('Default', 'Backend', 'Backend', 'Layout'));
    }

    /**
     * Backend News Grid View
     */
    public function indexAction()
    {
        $grid = Utility::createInstance('Continut\Extensions\System\Backend\Classes\View\GridView');

        $grid
            ->setFormAction(Utility::helper('Url')->linkToPath('admin_backend', ['_extension' => 'News', '_controller' => 'NewsBackend', '_action' => 'index']))
            ->setTemplate(Utility::getResource('Grid/gridView', 'Backend', 'Backend', 'Template'))
            ->setCollection(Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Collection\NewsCollection'))
            ->setPager(10, Utility::getRequest()->getArgument('page', 1))
            ->setFields(
                [
                    'photo' => [
                        'label' => 'backend.news.grid.field.photo',
                        'renderer' => [
                            'class' => 'Continut\Extensions\Local\News\Classes\View\Renderer\PhotoRenderer'
                        ]
                    ],
                    'title' => [
                        'label' => 'backend.news.grid.field.title',
                        'css' => 'col-sm-3',
                        'renderer' => [
                            'parameters' => ['crop' => 200, 'cropAppend' => '...', 'removeHtml' => TRUE]
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'description' => [
                        'label' => 'backend.news.grid.field.description',
                        'css' => 'col-sm-3',
                        'renderer' => [
                            'parameters' => ['crop' => 300, 'cropAppend' => '...', 'removeHtml' => TRUE]
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'isVisible' => [
                        'label' => 'backend.news.grid.field.isVisible',
                        'css' => 'col-sm-1',
                        'renderer' => [
                            'class' => 'Continut\Extensions\Local\News\Classes\View\Renderer\IsVisibleRenderer'
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => 'Hidden', '1' => 'Is visible']
                        ]
                    ],
                    'categories' => [
                        'label' => 'backend.news.grid.field.categories',
                        'css' => 'col-sm-2',
                        'renderer' => [
                            'class' => 'Continut\Extensions\Local\News\Classes\View\Renderer\CategoriesRenderer'
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => 'Category 1', '1' => 'Category 2']
                        ]
                    ],
                    'actions' => [
                        'label' => 'backend.news.grid.field.actions',
                        'css' => 'col-sm-2 text-right',
                        'renderer' => [
                            'class' => 'Continut\Extensions\Local\News\Classes\View\Renderer\ActionsRenderer',
                            'parameters' => ['showEdit' => true, 'showDelete' => true]
                        ]
                    ]
                ]
            )
            ->initialize();

        $this->getView()->assign('grid', $grid);
    }

    /**
     * Create news
     */
    public function createNewsAction()
    {
        $news = Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Model\News');
        $usersCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\FrontendUserCollection');

        $this->getView()->assign('news', $news);
        $this->getView()->assign('authors', $usersCollection->findAll());
    }

    /**
     * Edit news
     */
    public function editNewsAction()
    {
        $id = (int)$this->getRequest()->getArgument('id');

        $newsCollection  = Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Collection\NewsCollection');
        $usersCollection = Utility::createInstance('Continut\Core\System\Domain\Collection\FrontendUserCollection');
        $news = $newsCollection->findById($id);

        $this->getView()->assign('news', $news);
        $this->getView()->assign('authors', $usersCollection->findAll());
    }

    public function saveNewsAction()
    {
        $data = $this->getRequest()->getArgument('data');
        $id = (int)$data['id'];

        // reference the collection
        $newsCollection = Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Collection\NewsCollection');

        if ($id == 0) {
            $news = Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Model\News');
        }
        else {
            $news = $newsCollection->findById($id);
        }
        $news->update($data);

        if ($news->validate()) {
            $newsCollection
                ->reset()
                ->add($news)
                ->save();

            // redirect to the "domainsAction" since all went well and data is saved
            $this->redirect(Utility::helper('Url')->linkToPath('admin_backend', ['_extension' => 'News', '_controller' => 'NewsBackend', '_action' => 'index']));
        }

        $this->getView()->assign('news', $news);
    }
}
