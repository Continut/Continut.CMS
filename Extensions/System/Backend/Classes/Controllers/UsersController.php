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

class UsersController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayoutTemplate(Utility::getResource('Default', 'Backend', 'Backend', 'Layout'));
    }

    /**
     * Backend users management
     */
    public function backendUsersAction()
    {
        $grid = Utility::createInstance('Continut\Extensions\System\Backend\Classes\View\GridView');

        $grid
            ->setFormAction(Utility::helper('Url')->linkToPath('admin_backend', ['_controller' => 'Users', '_action' => 'backendUsers']))
            ->setTemplate(Utility::getResource('Grid/gridView', 'Backend', 'Backend', 'Template'))
            ->setCollection(Utility::createInstance('Continut\Core\System\Domain\Collection\BackendUserCollection'))
            ->setPager(10, Utility::getRequest()->getArgument('page', 1))
            ->setFields(
                [
                    'id' => [
                        'label' => 'backend.users.grid.field.id',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ]
                    ],
                    'name' => [
                        'label' => 'backend.users.grid.field.name',
                        'css' => 'col-sm-3',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'username' => [
                        'label' => 'backend.users.grid.field.username',
                        'css' => 'col-sm-3',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'usergroupId' => [
                        'label' => 'backend.users.grid.field.usergroupId',
                        'css' => 'col-sm-1',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter',
                            'values' => ['' => '', '0' => 'No', '1' => 'Yes']
                        ]
                    ],
                    'isDeleted' => [
                        'label' => 'backend.users.grid.field.isDeleted',
                        'css' => 'col-sm-1',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\YesNoRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => $this->__('general.no'), '1' => $this->__('general.yes')]
                        ]
                    ],
                    'isActive' => [
                        'label' => 'backend.users.grid.field.isActive',
                        'css' => 'col-sm-1',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\YesNoRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => $this->__('general.no'), '1' => $this->__('general.yes')]
                        ]
                    ],
                    'actions' => [
                        'label' => 'backend.users.grid.field.actions',
                        'css' => 'col-sm-2 text-right',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\ActionsRenderer',
                            'parameters' => ['showEdit' => true, 'showDelete' => true]
                        ]
                    ]
                ]
            )
            ->initialize();

        $this->getView()->assign('grid', $grid);
    }

    /**
     * Backend Groups management
     */
    public function backendGroupsAction()
    {
        $grid = Utility::createInstance('Continut\Extensions\System\Backend\Classes\View\GridView');

        $grid
            ->setFormAction(Utility::helper('Url')->linkToPath('admin_backend', ['_controller' => 'Users', '_action' => 'backendGroups']))
            ->setTemplate(Utility::getResource('Grid/gridView', 'Backend', 'Backend', 'Template'))
            ->setCollection(Utility::createInstance('Continut\Core\System\Domain\Collection\BackendUserGroupCollection'))
            ->setPager(10, Utility::getRequest()->getArgument('page', 1))
            ->setFields(
                [
                    'id' => [
                        'label' => 'backend.groups.grid.field.id',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ]
                    ],
                    'title' => [
                        'label' => 'backend.groups.grid.field.title',
                        'css' => 'col-sm-3',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'isDeleted' => [
                        'label' => 'backend.groups.grid.field.isDeleted',
                        'css' => 'col-sm-2',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\YesNoRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => $this->__('general.no'), '1' => $this->__('general.yes')]
                        ]
                    ],
                    'actions' => [
                        'label' => 'backend.groups.grid.field.actions',
                        'css' => 'col-sm-2 text-right',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer',
                            'parameters' => ['showEdit' => true, 'showDelete' => true]
                        ]
                    ]
                ]
            )
            ->initialize();

        $this->getView()->assign('grid', $grid);
    }

    /**
     * Frontend users management
     */
    public function frontendUsersAction()
    {
        $grid = Utility::createInstance('Continut\Extensions\System\Backend\Classes\View\GridView');

        $grid
            ->setFormAction(Utility::helper('Url')->linkToPath('admin_backend', ['_controller' => 'Users', '_action' => 'frontendUsers']))
            ->setTemplate(Utility::getResource('Grid/gridView', 'Backend', 'Backend', 'Template'))
            ->setCollection(Utility::createInstance('Continut\Core\System\Domain\Collection\FrontendUserCollection'))
            ->setPager(10, Utility::getRequest()->getArgument('page', 1))
            ->setFields(
                [
                    'id' => [
                        'label' => 'backend.users.grid.field.id',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ]
                    ],
                    'username' => [
                        'label' => 'backend.users.grid.field.username',
                        'css' => 'col-sm-3',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'usergroupId' => [
                        'label' => 'backend.users.grid.field.usergroupId',
                        'css' => 'col-sm-2',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'isDeleted' => [
                        'label' => 'backend.users.grid.field.isDeleted',
                        'css' => 'col-sm-1',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\YesNoRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => $this->__('general.no'), '1' => $this->__('general.yes')]
                        ]
                    ],
                    'isActive' => [
                        'label' => 'backend.users.grid.field.isActive',
                        'css' => 'col-sm-1',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\YesNoRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => $this->__('general.no'), '1' => $this->__('general.yes')]
                        ]
                    ],
                    'actions' => [
                        'label' => 'backend.users.grid.field.actions',
                        'css' => 'col-sm-2 text-right',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer',
                            'parameters' => ['showEdit' => true, 'showDelete' => true]
                        ]
                    ]
                ]
            )
            ->initialize();

        $this->getView()->assign('grid', $grid);
    }


    /**
     * Frontend Groups management
     */
    public function frontendGroupsAction()
    {
        $grid = Utility::createInstance('Continut\Extensions\System\Backend\Classes\View\GridView');

        $grid
            ->setFormAction(Utility::helper('Url')->linkToPath('admin_backend', ['_controller' => 'Users', '_action' => 'backendGroups']))
            ->setTemplate(Utility::getResource('Grid/gridView', 'Backend', 'Backend', 'Template'))
            ->setCollection(Utility::createInstance('Continut\Core\System\Domain\Collection\FrontendUserGroupCollection'))
            ->setPager(10, Utility::getRequest()->getArgument('page', 1))
            ->setFields(
                [
                    'id' => [
                        'label' => 'backend.groups.grid.field.id',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ]
                    ],
                    'title' => [
                        'label' => 'backend.groups.grid.field.title',
                        'css' => 'col-sm-3',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer'
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\TextFilter'
                        ]
                    ],
                    'isDeleted' => [
                        'label' => 'backend.groups.grid.field.isDeleted',
                        'css' => 'col-sm-2',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\YesNoRenderer',
                        ],
                        'filter' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Filter\SelectFilter',
                            'values' => ['' => '', '0' => $this->__('general.no'), '1' => $this->__('general.yes')]
                        ]
                    ],
                    'actions' => [
                        'label' => 'backend.groups.grid.field.actions',
                        'css' => 'col-sm-2 text-right',
                        'renderer' => [
                            'class' => 'Continut\Extensions\System\Backend\Classes\View\Renderer\BaseRenderer',
                            'parameters' => ['showEdit' => true, 'showDelete' => true]
                        ]
                    ]
                ]
            )
            ->initialize();

        $this->getView()->assign('grid', $grid);
    }
}
