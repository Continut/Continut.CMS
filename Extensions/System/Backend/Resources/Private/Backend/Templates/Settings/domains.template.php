<div class="row">
    <?= $this->partial('Settings/leftMenu', 'Backend', 'Backend', ['menu' => $menu]); ?>
    <div class="col-sm-12 col-md-9">
        <div class="quick-panel pull-right">
            <a class="btn btn-success" href="#"><i class="fa fa-icon fa-plus"></i> <?= $this->__('backend.settings.domains.new') ?></a>
        </div>
        <h3><?= $this->__('backend.settings.domains.title') ?></h3>
        <?php if ($menu['domains']): ?>
        <div class="panel panel-default panel-grid">
            <div class="panel-body">
                <div class="grid">
                <?php foreach ($menu['domains']->getAll() as $domain): ?>
                <div class="row grid-row grid-even">
                    <div class="col-sm-8">
                        <strong><?= $domain->getTitle() ?></strong>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a class="btn btn-sm btn-warning" href="#"><i class="fa fa-icon fa-pencil"></i> <?= $this->__('general.edit') ?></a>
                        <a class="btn btn-sm btn-danger" href="#"><i class="fa fa-icon fa-recycle"></i> <?= $this->__('general.delete') ?></a>
                    </div>
                </div>
                    <?php foreach ($domain->getDomainUrls() as $language): ?>
                        <div class="row grid-row">
                            <div class="col-sm-3">
                                <i class="flag-icon flag-icon-<?= $language->getFlag() ?>"></i> <?= $language->getTitle() ?> (<?= $language->getLocale() ?>)
                            </div>
                            <div class="col-sm-3">
                                <i class="fa fa-icon fa-globe"></i> <?= $language->getUrl() ?>
                            </div>
                            <div class="col-sm-2">
                                /<?= $language->getCode() ?>
                            </div>
                            <div class="col-sm-4 text-right">
                                <a class="btn btn-sm btn-warning" href="#"><i class="fa fa-icon fa-pencil"></i> <?= $this->__('general.edit') ?></a>
                                <a class="btn btn-sm btn-danger" href="#"><i class="fa fa-icon fa-recycle"></i> <?= $this->__('general.delete') ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="row grid-row">
                        <a class="btn btn-success" href="#"><i class="fa fa-icon fa-plus"></i> <?= $this->__('backend.settings.domainUrls.new') ?></a>
                    </div>
                <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php else: ?>
            <p class="bg-danger"><?= $this->__('backend.settings.domains.empty') ?></p>
        <?php endif; ?>
    </div>
</div>

<script>
    $('#settings_menu_1').collapse('show');
</script>