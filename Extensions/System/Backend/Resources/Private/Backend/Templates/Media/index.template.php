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
                            <button type="button" class="btn btn-default"><i class="fa fa-fw fa-bars"></i></button>
                            <button type="button" class="btn btn-default"><i class="fa fa-fw fa-th"></i></button>
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
                           href="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Media', '_action' => 'createFolder', 'path' => urlencode($path)]) ?>"><?= $this->__("backend.media.folders.create") ?>
                            <i class="fa fa-fw fa-plus"></i></a>
                    </div>
                    <div class="btn-group" role="group">
                        <a class="btn btn-primary"><?= $this->__("backend.media.files.upload") ?> <i
                                class="fa fa-fw fa-upload"></i></a>
                    </div>
                </div>
                <div id="file_tree"></div>
            </div>
            <div class="col-sm-9">
                <p>
                    <small><?= $path ?></small>
                </p>
                <?php if ($files): ?>
                    <div class="row">
                        <?php foreach ($files as $file): ?>
                            <div class="col-xs-6 col-md-3">
                                <a href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Media', '_action' => 'fileInfo', 'file' => urlencode($file->getRelativeFilename())]) ?>" class="thumbnail filetype-<?= $file->getExtension() ?>">
                                    <span class="extension"><?= $file->getExtension() ?>
                                        : <?= $this->helper("Units")->formatBytes($file->getSize()); ?></span>
                                    <?php if (in_array($file->getExtension(), array('JPG', 'PNG', 'GIF'))): ?>
                                        <img
                                            src="<?= $this->helper("Image")->crop($file->getRelativeFilename(), 300, 300, "storage") ?>"
                                            alt=""/>
                                    <?php elseif ($file->getExtension() == 'SVG'): ?>
                                        <img
                                            src="<?= $file->getRelativeFilename() ?>"
                                            alt=""/>
                                    <?php else: ?>
                                        <i class="fa fa-file" style="font-size: 125px"></i>
                                    <?php endif; ?>
                                    <div class="caption">
                                        <p><?= $file->getFullname(); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        <p><?= $this->__("backend.media.files.missing") ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
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
            'data': {}
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