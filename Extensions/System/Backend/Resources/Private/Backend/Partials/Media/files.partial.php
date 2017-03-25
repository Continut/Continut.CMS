<p>
    <small><?= $path ?></small>
    <span class="pull-right"><?= $this->__('backend.media.files.count', ['count' => count($files)]) ?></span>
</p>
<?php if ($files): ?>
    <form method="POST" action="">
    <div class="row">
        <?php if ($listType == \Continut\Extensions\System\Backend\Classes\Controllers\MediaController::LIST_TYPE_THUMBNAILS): ?>
            <?php foreach ($files as $file): ?>
                <div class="col-xs-6 col-md-3">
                    <a href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Media', '_action' => 'fileInfo', 'file' => urlencode($file->getRelativeFilename())]) ?>" class="thumbnail filetype-<?= $file->getExtension() ?>">
                                            <span class="extension"><?= $file->getExtension() ?>
                                                : <?= $this->helper('Units')->formatBytes($file->getSize()); ?></span>
                        <?php if (in_array($file->getExtension(), array('JPG', 'PNG', 'GIF'))): ?>
                            <img
                                src="<?= $this->helper('Image')->crop($file->getRelativeFilename(), 300, 300, 'storage') ?>"
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
        <?php else: ?>
            <div class="col-xs-12">
                <div class="list-group">
                <?php foreach ($files as $file): ?>
                        <a href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Media', '_action' => 'fileInfo', 'file' => urlencode($file->getRelativeFilename())]) ?>" class="list-group-item filetype-<?= $file->getExtension() ?>">
                        <div class="row">
                            <div class="col-xs-8 col-sm-6">
                                <?php if (in_array($file->getExtension(), array('JPG', 'PNG', 'GIF'))): ?>
                                    <img
                                            src="<?= $this->helper('Image')->crop($file->getRelativeFilename(), 60, 60, 'storage') ?>"
                                            alt=""/>
                                <?php elseif ($file->getExtension() == 'SVG'): ?>
                                    <img
                                            width="60"
                                            src="<?= $file->getRelativeFilename() ?>"
                                            alt=""/>
                                <?php else: ?>
                                    <i class="fa fa-file" style="font-size: 60px"></i>
                                <?php endif; ?>
                                <?= $file->getFullname(); ?>
                            </div>
                            <div class="col-xs-4 col-sm-3">
                                 <?= $this->helper('Units')->formatBytes($file->getSize()); ?>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <?= $file->getCreationDate() ?>
                            </div>
                        </div>
                        </a>
                <?php endforeach ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
        <?php if ($handlingType == \Continut\Extensions\System\Backend\Classes\Controllers\MediaController::HANDLING_TYPE_SELECT): ?>
            <input type="hidden" name="" />
        <?php endif; ?>
    </form>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        <p><?= $this->__('backend.media.files.missing') ?></p>
    </div>
<?php endif; ?>
<?php if ($handlingType == \Continut\Extensions\System\Backend\Classes\Controllers\MediaController::HANDLING_TYPE_SELECT): ?>
<script type="text/javascript">
    $('.panel-media .list-group-item').on('click', function(event) {
        event.preventDefault();

        $(this).toggleClass('active');

        totalSelectedFiles = $('.panel-media .list-group-item.active').length;

        var countText = '<?= $this->__('general.selectedXFiles'); ?>';
        countText = countText.replace('%(count)', totalSelectedFiles);

        $('#media_selected_count').html(countText);
    });
</script>
<?php endif; ?>
