<div class="row page-editor">
    <div id="sidebar_tree" class="col-md-4 col-sm-5">
        <!-- tree toolbar -->
        <div id="sidebar_toolbar" class="row">
            <form class="form">
                <div class="col-xs-6 col-sm-12 col-lg-6">
                    <div class="simple-margins bottom">
                        <a class="btn btn-sm btn-default" title="<?= $this->__('backend.settings.description') ?>" href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'domains']) ?>"><i class="fa fa-cog"></i></a>
                        <label for="select_website"><?= $this->__('backend.pageTree.domain.label') ?></label>
                    </div>
                    <?php if ($domains->count() > 0): ?>
                        <select id="select_website" class="selectpicker" data-width="100%">
                            <?php foreach ($domains->getAll() as $domain): ?>
                                <option <?= (\Continut\Core\Utility::getSession()->get('current_domain') == $domain->getId()) ? 'selected="selected"' : ''?> value="<?= $domain->getId() ?>"><?= $domain->getTitle() ?></option>
                            <?php endforeach ?>
                        </select>
                        <script type="text/javascript">
                            <!-- once the current website is changed, it loads the pages for it's first domain url/language -->
                            $('#select_website').on('change', function (event) {
                                $.ajax({
                                    url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'tree']) ?>',
                                    dataType: 'json',
                                    data: { domain_id: this.value }
                                })
                                    .done(function (json) {
                                        var $languages = $('#select_language');
                                        if (json.success == 1) {
                                            $languages.empty();
                                            $.each(json.languages, function (value, key) {
                                                $languages.append($("<option data-icon='flag-icon flag-icon-" + key.flag + "'></option>").attr("value", value).text(key.title));
                                            });
                                            $languages.selectpicker('refresh');
                                            $('#cms_tree').jstree(true).settings.core.data = json.pages;
                                            $('#content').empty();
                                        } else {
                                            $('#cms_tree').jstree(true).settings.core.data = [];
                                            $languages.empty().selectpicker('refresh');
                                        }
                                        $('#cms_tree').jstree(true).refresh();
                                    });
                            });
                        </script>
                    <?php else: ?>
                        <p>@TODO: should show a link to the System > Config so that they can add at least 1 domain!</p>
                        <p>Using global domain <a href="" class="btn btn-sm btn-success"><i
                                    class="fa fa-fw fa-plus"></i> </a></p>
                    <?php endif ?>
                </div>
                <div class="col-xs-6 col-sm-12 col-lg-6">
                    <div class="simple-margins bottom">
                        <a class="btn btn-sm btn-default" title="<?= $this->__('backend.settings.description') ?>" href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'domains']) ?>"><i class="fa fa-cog"></i></a>
                        <label for="select_language"><?= $this->__('backend.pageTree.language.label') ?></label>
                    </div>
                    <select id="select_language" class="selectpicker" data-width="100%">
                        <?php foreach ($languages->getAll() as $language): ?>
                            <option <?= (\Continut\Core\Utility::getSession()->get('current_language') == $language->getId()) ? 'selected="selected"' : ''?> data-icon="flag-icon flag-icon-<?= $language->getFlag() ?>"
                                    value="<?= $language->getId() ?>"><?= $language->getTitle() ?></option>
                        <?php endforeach ?>
                    </select>
                    <script type="text/javascript">
                        <!-- Once the domain url/language is changed, it loads it's pages -->
                        $('#select_language').on('change', function (event) {
                            $.ajax({
                                url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'tree']) ?>',
                                dataType: 'json',
                                data: {domain_id: $('#select_website').val(), domain_url_id: this.value}
                            })
                                .done(function (json) {
                                    $('#cms_tree').jstree(true).settings.core.data = json.pages;
                                    $('#cms_tree').jstree(true).refresh();
                                    $('#content').empty();
                                });
                        });
                    </script>
                </div>
            </form>
            <a href="#" class="btn btn-success <?= $user->getAttribute('touchEnabled', false) ? 'toggled' : ''; ?>" title="Toggle touch enhancements" id="toggle_touch">
                <span class="fa fa-fw fa-hand-pointer-o open"></span>
                <span class="fa fa-fw fa-mouse-pointer closed"></span>
            </a>
        </div>
        <div class="row tree-filter">
            <div class="col-xs-6">
                <div class="entire-area">
                    <div class="input-group entire-area">
                        <div class="input-group-addon"><i id="search_page_progress" class="fa fa-fw fa-search"></i>
                        </div>
                        <input type="text" class="form-control" name="search_page" id="search_page"
                               autocomplete="off" placeholder="<?= $this->__("backend.pageTree.findPage") ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <a href="#" class="btn btn-success col-xs-12 page-add"
                   title="<?= $this->__("backend.pageTree.createPage") ?>"><i
                        class="fa fa-fw fa-plus"></i> <?= $this->__("backend.pageTree.createPage") ?></a>
            </div>
        </div>
        <div id="cms_tree" class="<?= $user->getAttribute('touchEnabled', false) ? 'touch-friendly' : ''; ?>"></div>
    </div>
    <!-- Main page content will be loaded inside this div -->
    <div id="content_wrapper" class="col-md-8 col-sm-7">
        <a href="#" class="btn btn-success" title="Toggle sidebar visibility" id="toggle_sidebar">
            <span class="fa fa-fw fa-chevron-left open"></span>
            <span class="fa fa-fw fa-chevron-right closed"></span>
        </a>
        <div id="content"></div>
    </div>
</div>

<script type="text/javascript">
    var searchPageTreeThread = null;
    var oldSearch = null;
    var previousSelectedNode = null;

    // --- Handles search inside the page tree ---
    $('#search_page').keyup(function (e) {
        var $this = $(this);
        if ($this.val() == oldSearch) {
            return;
        }
        // ignore Enter or Tab
        if (e.which != 9 && e.which != 13) {
            clearTimeout(searchPageTreeThread);
            searchPageTreeThread = setTimeout(function () {
                $('#cms_tree').jstree(true).search($this.val());
            }, 200);
        }
    });
    // --- Handles what happens when clicking on a page in the pagetree => loads the page in the BE preview ---
    $('#cms_tree')
        .on('changed.jstree', function (e, data) {
            if (data.selected.length == 0) {
                return;
            }
            var nodeId = data.selected[0];
            // once a node is clicked, load the corresponding page in the right side
            $.ajax({
                url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'show']) ?>',
                data: { id: nodeId }
                /*beforeSend: function (xhr) {
                 $('#' + nodeId).prepend('<span class="pull-right fa fa-spinner fa-pulse"></span>');
                 }*/
            })
                .done(function (data) {
                    $('#content').html(data);
                    //$('#' + nodeId).find('.fa-spinner').remove();
                    if (previousSelectedNode) {
                        $('#' + previousSelectedNode).find('.page-add').eq(0).hide();
                    }
                    $('#' + nodeId).find('.page-add').eq(0).show();
                    previousSelectedNode = nodeId;
                });
        })
        // --- Handles moving pages in the page tree ---
        .on('move_node.jstree', function(e, data) {
            //console.log(data);
            var pagesOrder = [];
            var children = null;
            if (data.parent == '#') {
                children = $($('#cms_tree').jstree().get_json(data.parent, {'no_children': false}));
                for (var i = 0; i < children.length; i++) {
                    pagesOrder.push(children[i].id);
                }
            } else {
                var parent = $($('#cms_tree').jstree().get_json(data.parent, {'no_children': false}))
                for (var i = 0; i < parent[0].children.length; i++) {
                    pagesOrder.push(parent[0].children[i].id);
                }
            }
            //console.log(pagesOrder);
            $.post(
                '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'treeMove']) ?>',
                {
                    movedId: data.node.id,
                    position: data.position,
                    newParentId: data.parent,
                    order: pagesOrder
                }
            );
        });
    // --- jsTree initialization ---
    $.ajax({
        url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'tree']) ?>',
        dataType: 'json'
    })
        .done(function (json) {
            $('#cms_tree').jstree({
                'core' : {
                    'multiple' : false,
                    'animation' : 0,
                    'check_callback': true,
                    'themes' : {
                        'variant' : 'large',
                        'dots' : true
                    },
                    'strings': {
                        'Loading ...' : '<?= $this->__('backend.tree.loading') ?>',
                    },
                    'data': json.pages
                },
                'dnd': {
                    'copy': false, // true allows to make copies while dragging and holding Ctrl. We don't want this
                    'always_copy': false,
                    'check_while_dragging': false,
                    'large_drag_target': true,
                    'large_drop_target': true
                },
                'search': {
                    'show_only_matches': true,
                    'show_only_matches_children': false
                },
                'plugins' : ['dnd', 'search', 'wholerow']
                //'plugins' : ['dnd', 'search', 'wholerow', 'checkbox']
            });
        });

    // --- Shows the "Add new page" modal ---

    // Add page modal reference. Would be better if it would be self-contained
    // @TODO: check for a solution to use it inside the modal's context, even for remote content
    var addModal;

    $('.page-add').on('click', function (e) {
        e.preventDefault();
        var pid = $('#cms_tree').jstree('get_selected');
        addModal = BootstrapDialog.show({
            title: <?= json_encode($this->__("backend.page.wizard.create.title")) ?>,
            message: $('<div></div>').load('<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'wizard']) ?>?id=' + pid),
            cssClass: 'large-dialog'
        });
    });

    $("#toggle_sidebar").click(function (e) {
        e.preventDefault();
        $(this).toggleClass('toggled');
        $("#sidebar_tree").toggle();
        $("#content_wrapper").toggleClass('col-md-8 col-sm-7 col-xs-12');
    });

    $("#toggle_touch").click(function (e) {
        e.preventDefault();

        var $link = $(this);

        $.getJSON('<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'toggleTouch']) ?>', function(data) {
            if (data.touchEnabled) {
                $link.addClass('toggled');
                $("#cms_tree, #content_wrapper .page-panel").addClass('touch-friendly');
            } else {
                $link.removeClass('toggled');
                $("#cms_tree, #content_wrapper .page-panel").removeClass('touch-friendly');
            }
        });
    });

</script>