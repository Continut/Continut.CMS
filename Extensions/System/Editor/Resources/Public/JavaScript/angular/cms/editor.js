// Simplified Page Model
function Page(args) {
    this.id = args.id;
    this.data = args;
    this.contentElements = [];

    this.fields = {
        'title': {'type': 'text', 'state': 'to-publish', 'label': 'Title', 'mapTo': 'title'},
        'slug': {'type': 'text', 'state': 'normal', 'label': 'Url path', 'mapTo': 'slug'},
        'visible': {
            'type': 'checkbox',
            'state': 'normal',
            'label': 'Page is visible in the frontend',
            'mapTo': 'visible'
        }
    };

    // used in the toolbar actions
    this.actions = {
        canEdit: true,
        canCreate: true,
        isVisible: true,
        canCopy: true,
        canCut: true,
        canPaste: false,
        canDelete: true
    };
}

// Simplified Content Model
function Content(args) {
    this.id = args.id;
    this.data = args;
    this.content = args.content;

    // used in the toolbar actions
    this.actions = {
        canEdit: true,
        canCreate: true,
        isVisible: true,
        canCopy: true,
        canPaste: true,
        canDelete: true
    };

    this.fields = {
        'title': {'type': 'text', 'state': 'normal', 'label': 'Title', 'mapTo': 'title'},
        'visible': {
            'type': 'checkbox',
            'state': 'normal',
            'label': 'Content is visible in the frontend',
            'mapTo': 'visible'
        }
    };
}

angular.module('continut.cms').controller('EditorController', function ($scope, $http, $log) {

    // jsTree pageTree data
    $scope.pageTreeData = [];

    // jsTree config for the pageTree
    $scope.pageTreeConfig = {
        core: {
            multiple: false,
            animation: 0,
            themes: {
                variant: 'large',
                dots: true
            },
            error: function (error) {
                $log.error('treeCtrl: error from js tree - ' + angular.toJson(error));
            },
        },
        version: 1,
        plugins: ['dnd', 'search', 'wholerow', 'changed']
        //'plugins' : ['dnd', 'search', 'wholerow', 'checkbox']
    };

    // jsTree contentTree data
    $scope.contentTreeData = [];

    // jsTree config for the contentTree
    $scope.contentTreeConfig = {
        core: {
            multiple: false,
            animation: 0,
            themes: {
                variant: 'large',
                dots: true
            },
            error: function (error) {
                $log.error('treeCtrl: error from js tree - ' + angular.toJson(error));
            }
        },
        version: 1,
        plugins: ['dnd', 'search', 'wholerow', 'changed']
        //'plugins' : ['dnd', 'search', 'wholerow', 'checkbox']
    };

    $scope.reloadPageTree = function ($event) {
        reloadPageTree();
        $event.preventDefault();
    };

    $scope.pageTreeEvents = {
        'ready': readyPageTree,
        'changed': changedPageTree
    };

    function reloadPageTree() {
        $http({method: 'GET', url: 'admin.php?_controller=Page&_extension=Editor&_action=tree'}).then(
            function successCallback(response) {
                $scope.pageTreeData = response.data;
                // this is needed in order to recreate the tree
                $scope.pageTreeConfig.version++;
                // get all content elements for this page, and preselect the first content element
                /*$http({method: 'GET', url: 'admin.php?_controller=Content&_extension=Editor&_action=tree'}).then(
                    function successCallback(response) {
                        $scope.contentTreeData = response.data;
                        $scope.contentTreeConfig.version++;
                    },
                    function errorCallback(response) {
                    }
                );*/
            },
            function errorCallback(response) {
                //@TODO: error messages
            }
        );
    }

    function readyPageTree() {
        $log.info('ready called for page tree');
    }

    // called when we select a different page in the page tree
    function changedPageTree(event, data) {
        var selectedIds = data.changed.selected;
        // if multiple selection is active then selectedIds will contain multiple page ids
        // so we only need to fetch the id of the first selected one
        if (selectedIds.length > 0) {
            $http({
                method: 'GET',
                url: 'admin.php?_controller=Page&_extension=Editor&_action=pageDetails',
                params: {id: selectedIds[0]}
            }).then(
                function successCallback(response) {
                    var json = response.data;
                    // sync actions
                    $scope.page.actions = json.actions;
                    // sync editable page data
                    $scope.page.data = json.data;
                    // switch to 'page' selection mode
                    $scope.selectionType = 'page';

                    $http({method: 'GET', url: 'admin.php?_controller=Content&_extension=Editor&_action=tree', params: {id: selectedIds[0]}}).then(
                        function successCallback(response) {
                            $scope.contentTreeData.data = response.data;
                            $scope.contentTreeConfig.version++;
                        },
                        function errorCallback(response) {
                            //@TODO : error messages
                        }
                    );
                },
                function errorCallback(response) {
                    //@TODO : error messages
                }
            );
        }
    }

    $scope.contentTreeEvents = {
        'ready': readyContentTree,
        'changed': changedContentTree
    };

    function readyContentTree() {
        $log.info('ready called for content tree');
    }

    function changedContentTree(event, data) {
        var selectedIds = data.changed.selected;

        // if multiple selection is active then selectedIds will contain multiple page ids
        // so we only need to fetch the id of the first selected one
        if (selectedIds) {
            $http({method: 'GET', url: 'admin.php?_controller=Content&_extension=Editor&_action=contentDetails', params: {id: selectedIds[0]}}).then(
                function successCallback(response) {
                    var json = response.data;
                    // sync actions
                    $scope.content.actions = json.actions;
                    // sync editable page data
                    $scope.content.data = json.data;
                    // switch to 'page' selection mode
                    $scope.selectionType = 'content';
                },
                function errorCallback(response) {
                    //@TODO : error messages
                }
            );
        }
    }

    var init = function () {
        loadPage();
    };

    var loadPage = function () {
        // create a dummy page
        var page = new Page({id: 13, title: 'Test page', url: '/test-page', parentId: 2, visible: true});
        // and 1 content elements for it
        var content = new Content({
            id: 1,
            parentId: 0,
            page: page,
            title: 'First item is a container',
            type: 'container',
            content: '<div class="container">|</div>'
        });
        //page.contentElements.push(content);

        // then pass them to the controller scope
        //$scope.selectedContentElement = content2;
        $scope.page = page;
        $scope.selectionType = 'content';
        $scope.content = content;
    };

    init();
});
