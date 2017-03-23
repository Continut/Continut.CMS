<div class="row" id="content_saver">
    <div class="col-sm-8">
        <div class="btn-group">
            <button type="button" class="btn btn-primary wizard-save"><i
                    class="fa fa-fw fa-save"></i> <?= $this->__('backend.content.save') ?></button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" class="wizard-save-close"><i
                            class="fa fa-fw fa-save"></i> <?= $this->__('backend.content.saveAndClose') ?></a></li>
                <li><a href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'show', 'id' => $pageId]) ?>" class="wizard-close"><i
                            class="fa fa-fw fa-close"></i> <?= $this->__('backend.content.close') ?></a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-fw fa-history"></i> <?= $this->__('backend.content.history') ?></a></li>
            </ul>
        </div>
        <i class="fa fa-spinner fa-pulse ajax-loader" style="display: none"></i>
        <p class="ajax-text ajax-saved text-success" style="display: none"><i
                class="fa fa-check"></i> <?= $this->__('backend.content.saved') ?></p>
        <p class="ajax-text ajax-not-saved text-danger" style="display: none"><i
                class="fa fa-close"></i> <?= $this->__('backend.content.notSaved') ?></p>
    </div>
    <div class="col-sm-4">
        <div role="group" class="btn-group pull-right">
            <button id="page-delete" class="btn btn-danger wizard-delete" type="button"><i
                    class="fa fa-fw fa-trash"></i> <?= $this->__('backend.content.delete') ?></button>
        </div>
    </div>
</div>