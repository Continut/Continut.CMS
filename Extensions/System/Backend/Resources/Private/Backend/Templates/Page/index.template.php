<div class="row">
    <div id="sidebar_tree" class="col-md-3">
        <!-- tree toolbar -->
        <div id="sidebar_toolbar" class="row">
            <form class="form">
                <div class="col-sm-7 col-md-12 col-lg-7">
                    <label for="select_website"><a class="btn btn-sm btn-default" href=""><i class="fa fa-cog"></i></a>
                        <span class="hidden-md"><?= $this->__("backend.pageTree.domain.label") ?></span></label>
                    <?php if ($domains->count() > 0): ?>
                        <select id="select_website" class="selectpicker" data-width="100%">
                            <?php foreach ($domains->getAll() as $domain): ?>
                                <option value="<?= $domain->getId() ?>"><?= $domain->getTitle() ?></option>
                            <?php endforeach ?>
                        </select>
                        <script type="text/javascript">
                            $('#select_website').on('change', function (event) {
                                $.ajax({
                                    url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'tree']) ?>',
                                    data: {domain_id: this.value}
                                })
                                    .done(function (data) {
                                        var json = $.parseJSON(data);
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
                        <p>Using global domain <a href="" class="btn btn-sm btn-success"><i
                                    class="fa fa-fw fa-plus"></i> </a></p>
                    <?php endif ?>
                </div>
                <div class="col-sm-5 col-md-12 col-lg-5">
                    <label for="select_language"><a class="btn btn-sm btn-default" href=""><i class="fa fa-cog"></i></a>
                        <span class="hidden-md"><?= $this->__("backend.pageTree.language.label") ?></span></label>
                    <select id="select_language" class="selectpicker" data-width="100%">
                        <?php foreach ($languages->getAll() as $language): ?>
                            <option data-icon="flag-icon flag-icon-<?= $language->getFlag() ?>"
                                    value="<?= $language->getId() ?>"><?= $language->getTitle() ?></option>
                        <?php endforeach ?>
                    </select>
                    <script type="text/javascript">
                        $('#select_language').on('change', function (event) {
                            $.ajax({
                                url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'tree']) ?>',
                                data: {domain_id: $('#select_website').val(), domain_url_id: this.value}
                            })
                                .done(function (data) {
                                    var json = $.parseJSON(data);
                                    $('#cms_tree').jstree(true).settings.core.data = json.pages;
                                    $('#cms_tree').jstree(true).refresh();
                                    $('#content').empty();
                                });
                        });
                    </script>
                </div>
            </form>
        </div>
        <div class="row tree-filter">
            <div class="col-xs-7">
                <form action="<?= $this->helper("Url")->linkToAction("Backend", "Index", "searchPageTree") ?>"
                      class="form-inline" method="post">
                    <div class="form-group entire-area">
                        <div class="input-group entire-area">
                            <div class="input-group-addon"><i id="search_page_progress" class="fa fa-fw fa-file"></i>
                            </div>
                            <input type="text" class="form-control" name="search_page" id="search_page"
                                   placeholder="<?= $this->__("backend.pageTree.findPage") ?>"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xs-5">
                <a href="#" class="btn btn-success col-xs-12 page-add"
                   title="<?= $this->__("backend.pageTree.createPage") ?>"><i
                        class="fa fa-fw fa-plus"></i> <?= $this->__("backend.pageTree.createPage") ?></a>
            </div>
        </div>
        <div id="cms_tree"></div>
        <script type="text/javascript">
            var searchPageTreeThread = null;
            var searchPageSpinner = $('#search_page_progress');
            var oldSearch = null;
            var previousSelectedNode = null;

            function findPageByName(term) {
                oldSearch = term;
                searchPageSpinner.removeClass("fa-file").addClass("fa-spinner fa-pulse");
                $.ajax({
                        url: '<?= $this->helper("Url")->linkToAction("Backend", "Page", "searchTree") ?>',
                        data: {query: term, domain_id: $('#select_website').val()}
                    }
                ).done(function (data) {
                    searchPageSpinner.removeClass("fa-spinner fa-pulse").addClass("fa-file");
                    $('#cms_tree').tree('loadData', $.parseJSON(data).pages);
                });
            }

            $('#search_page').keydown(function (e) {
                var $this = $(this);
                if ($this.val() == oldSearch) {
                    return;
                }
                // ignore Enter or Tab
                if (e.which != 9 && e.which != 13) {
                    clearTimeout(searchPageTreeThread);
                    searchPageTreeThread = setTimeout(function () {
                        findPageByName($this.val())
                    }, 500);
                }
            });

            $('#cms_tree')
                .on('changed.jstree', function (e, data) {
                    if (data.selected.length == 0) {
                        return;
                    }
                    var nodeId = data.selected[0];
                    // once a node is clicked, load the corresponding page in the right side
                    $.ajax({
                        url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'show']) ?>',
                        data: {page_id: nodeId},
                        beforeSend: function (xhr) {
                            $('#' + nodeId).prepend('<span class="pull-right fa fa-spinner fa-pulse"></span>');
                        }
                    })
                    .done(function (data) {
                        $('#content').html(data);
                        $('#' + nodeId).find('.fa-spinner').remove();
                        if (previousSelectedNode) {
                            $('#' + previousSelectedNode).find('.page-add').eq(0).hide();
                        }
                        $('#' + nodeId).find('.page-add').eq(0).show();
                        previousSelectedNode = nodeId;
                    });
                })
                .on('move_node.jstree', function(e, data) {
                    console.log(data);
                    $.post(
                        '<?= $this->helper("Url")->linkToAction("Backend", "Page", "treeMove") ?>',
                        {
                            movedId: data.node.id,
                            newParentId: data.parent,
                            position: data.position
                        }
                    );
                })
                .jstree({
                'core' : {
                    'multiple' : false,
                    'animation' : 0,
                    'check_callback': true,
                    'themes' : {
                        'variant' : 'large',
                        'dots' : true
                    },
                    'data' : {
                        'url' : '<?= $this->helper("Url")->linkToPath('editor', ['_controller' => 'Page', '_action' => 'tree']) ?>',
                        'data' : function (node) {
                            return { 'id' : node.id };
                        }
                    }
                },
                'dnd': {
                    'check_while_dragging': false,
                    'large_drag_target': true,
                    'large_drop_target': true
                },
                'plugins' : ['dnd', 'search', 'wholerow']
                //'plugins' : ['dnd', 'search', 'wholerow', 'checkbox']
            });

            $('.page-add').on('click', function (e) {
                e.preventDefault();
                var pid = $('#cms_tree').tree('getSelectedNode').id;
                BootstrapDialog.show({
                    title: <?= json_encode($this->__("backend.page.wizard.create.title")) ?>,
                    message: $('<div></div>').load('<?= $this->helper("Url")->linkToAction("Backend", "Page", "wizard") ?>&id=' + pid)
                });
            });

            /*$('#cms_tree').bind(
                        'tree.move',
                        function (event) {
                            event.preventDefault();
                            event.move_info.do_move();
                            $.post(
                                '<?= $this->helper("Url")->linkToAction("Backend", "Page", "treeMove") ?>',
                                {
                                    movedId: event.move_info.moved_node.id,
                                    newParentId: event.move_info.target_node.id,
                                    position: event.move_info.position
                                }
                            );
                        }
                    );*/

        </script>
    </div>
    <div id="content" class="col-md-9"></div>
</div>