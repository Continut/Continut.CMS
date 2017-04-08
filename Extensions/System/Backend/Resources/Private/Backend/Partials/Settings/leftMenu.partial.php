<div class="col-sm-12 col-md-3" id="settings_sidebar">
    <h2><?= $this->__('backend.menu.settings') ?></h2>
    <p><?= $this->__('backend.settings.description')?></p>
    <div class="row">
        <div class="col-md-12">
            <form id="form_scope" method="post" action="<?= $this->helper("Url")->linkToPath('admin', ['_controller' => 'Settings', '_action' => $data['action']]) ?>">
            <?= $this->partial('General/domainsSelect', 'Backend', 'Backend', ['data' => $data]) ?>
            </form>
            <script type="text/javascript">
                $('#configuration_site').on('change', function (event) {
                    $('#form_scope').submit();
                });
            </script>
        </div>
    </div>

    <div class="row">
        <div class="list-group" id="settings_menu" role="tablist" aria-multiselectable="true">
            <a class="list-group-item collapsed" data-toggle="collapse" data-parent="#settings_menu" href="#settings_menu_1" aria-expanded="false" aria-controls="settings_menu_1">
                <h4 class="list-group-item-heading"><i class="fa fa-fw fa-cog"></i> <?= $this->__('backend.settings.general.title') ?></h4>
                <p class="list-group-item-text"><?= $this->__('backend.settings.general.subtitle') ?></p>
            </a>
            <div id="settings_menu_1" class="list-group collapse" role="tabpanel">
                <a id="link_system_domains" href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Settings', '_action' => 'domains']) ?>" class="<?= ($data['action'] == 'domains' ? 'active' : '')?> list-group-item"><i class="fa fa-fw fa-globe"></i> <?= $this->__('backend.settings.domains.title') ?></a>
                <a id="link_system_sessions" href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Settings', '_action' => 'session']) ?>" class="<?= ($data['action'] == 'session' ? 'active' : '')?> list-group-item"><i class="fa fa-fw fa-user-secret"></i> <?= $this->__('backend.settings.session.title') ?></a>
                <a id="link_system_media" href="<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Settings', '_action' => 'media']) ?>" class="<?= ($data['action'] == 'media' ? 'active' : '')?> list-group-item"><i class="fa fa-fw fa-cloud"></i> <?= $this->__('backend.settings.media.title')?></a>
            </div>
            <a class="list-group-item collapsed" data-toggle="collapse" data-parent="#settings_menu" href="#settings_menu_2" aria-expanded="false" aria-controls="settings_menu_2">
                <h4 class="list-group-item-heading"><i class="fa fa-fw fa-list-alt"></i> News</h4>
                <p class="list-group-item-text">News and news categories settings</p>
            </a>
            <div id="settings_menu_2" class="list-group collapse" role="tabpanel">
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-image"></i> Image settings</a>
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-refresh"></i> Sync API</a>
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-facebook"></i> Social network sharing</a>
            </div>
            <a class="list-group-item collapsed" data-toggle="collapse" data-parent="#settings_menu" href="#settings_menu_3" aria-expanded="false" aria-controls="settings_menu_3">
                <h4 class="list-group-item-heading"><i class="fa fa-fw fa-shopping-cart"></i> Shop</h4>
                <p class="list-group-item-text">Payment, shipment and orders</p>
            </a>
            <div id="settings_menu_3" class="list-group collapse" role="tabpanel">
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-users"></i> Customers</a>
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-credit-card"></i> Payment</a>
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-car"></i> Shipment</a>
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-list"></i> Orders and invoices</a>
                <a href="#" class="list-group-item"><i class="fa fa-fw fa-info"></i> Notifications</a>
            </div>
        </div>
    </div>

</div>