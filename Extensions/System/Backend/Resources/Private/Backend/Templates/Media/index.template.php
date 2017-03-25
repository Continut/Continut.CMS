<div class="panel panel-default panel-media">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-3">
                <h2 class="title">Media</h2>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-6">
                        <form class="form-inline">
                            <input type="text" class="form-control" placeholder="Search">
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="btn-group pull-right" role="group" aria-label="Thumbnail display">
                            <button type="button" class="btn btn-default <?= ($listType == 'list') ? 'active': ''; ?>"><i class="fa fa-fw fa-bars"></i></button>
                            <button type="button" class="btn btn-default <?= ($listType == 'thumbnails') ? 'active': ''; ?>"><i class="fa fa-fw fa-th"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <a class="btn btn-success" id="create_folder"
                           href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Media', '_action' => 'createFolder', 'path' => urlencode($path)]) ?>"><?= $this->__("backend.media.folders.create") ?>
                            <i class="fa fa-fw fa-plus"></i></a>
                    </div>
                    <div class="btn-group" role="group">
                        <a class="btn btn-primary"><?= $this->__('backend.media.files.upload') ?> <i
                                class="fa fa-fw fa-upload"></i></a>
                    </div>
                </div>
                <div id="file_tree"></div>
            </div>
            <div class="col-sm-9">
                <div id="content">
                    <?= $this->partial('Media/files', 'Backend', 'Backend', ['path' => $path, 'files' => $files, 'listType' => $listType, 'handlingType' => $handlingType]); ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($handlingType == \Continut\Extensions\System\Backend\Classes\Controllers\MediaController::HANDLING_TYPE_SELECT): ?>
        <div class="panel-footer stick-to-bottom text-center">
            <input type="submit" name="submit" class="btn btn-primary pull-left"
                   value="<?= $this->__('general.select') ?>"/>
            <span id="media_selected_count"><?= $this->__('general.selectedXFiles', ['count' => 0]); ?></span>
            <a class="close-button btn btn-danger pull-right"><?= $this->__('general.close') ?></a>
        </div>
    <?php endif; ?>
</div>

<script>
    var totalSelectedFiles = 0;

    $('#file_tree').jstree({
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
            'data': {
                'url': '<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Media', '_action' => 'treeGetNode']) ?>',
                dataType: 'json',
                    'data' : function (node) {
                    return { 'id' : node.id };
                }
            },
            force_text: true
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
        'types' : {
            'default' : { 'icon' : 'folder' },
            'file' : { 'valid_children' : [], 'icon' : 'file' }
        },
        'plugins' : ['dnd', 'search', 'wholerow']
        //'plugins' : ['dnd', 'search', 'wholerow', 'checkbox']
    })
        .on('changed.jstree', function (e, data) {
            if(data && data.selected && data.selected.length) {
                // once a node is clicked, load the corresponding media elements in the right side
                var nodeId = data.node.id;
                $.ajax({
                    url: '<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Media', '_action' => 'getFiles']) ?>',
                    data: { path: nodeId },
                    beforeSend: function (xhr) {
                        //$('#' + nodeId + ' > .jstree-anchor').append('<span class="fa fa-spinner fa-pulse"></span>');
                    }
                })
                    .done(function (data) {
                        $('#content').html(data);
                        //$('#' + nodeId).find('.fa-spinner').remove();
                        //previousSelectedNode = nodeId;
                        //anchor.data('requestRunning', false);
                    });
            }

        });

    // create folder button
    $('#create_folder').on('click', function (event) {
        event.preventDefault();
        var path = $(this).attr('href');
        BootstrapDialog.confirm({
            message: '<?= preg_replace('/[\r\n]+/', null, $this->partial("Media/createDirectory", "Backend", "Backend")) ?>',
            title: '<?= $this->__("backend.media.folders.create") ?>',
            type: BootstrapDialog.TYPE_SUCCESS,
            callback: function (result) {
                // if user confirms, send delete request
                if (result) {
                    $.getJSON(path, {
                        folder: $('#folder').val()
                    }).done(function (data) {
                        console.log(data);
                    });
                }
            }
        });
    });

    // browse folder button - @TODO remove, replaced by jstree
    $('#folders_menu .list-group-item').on('click', function (event) {
        event.preventDefault();
        var path = $(this).attr('href');
        $.get(path).done(function (data) {
            $('#container').html(data);
        });
    });
</script>