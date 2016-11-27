<div class="col-sm-12 col-md-3" id="settings_sidebar">
    <h2><?= $this->__('backend.menu.settings') ?></h2>
    <p><?= $this->__('backend.settings.description')?></p>
    <div class="row">
        <div class="col-md-6">
            <select id="select_website" class="selectpicker" data-width="100%">
                <option value="0">- Global -</option>
                <?php foreach ($menu['domains']->getAll() as $domain): ?>
                    <option value="<?= $domain->getId() ?>"><?= $domain->getTitle() ?></option>
                <?php endforeach ?>
            </select>
            <script type="text/javascript">
                $('#select_website').on('change', function (event) {
                    $.ajax({
                        url: '<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'languages']) ?>',
                        data: {domain_id: this.value}
                    })
                        .done(function (data) {
                            var $languages = $('#select_language');
                            $languages.empty();
                            $.each($.parseJSON(data).languages, function (value, key) {
                                $languages.append($("<option data-icon='flag-icon flag-icon-" + key.flag + "'></option>").attr("value", value).text(key.title));
                            });
                            $languages.selectpicker('refresh');
                        });
                });
            </script>
        </div>
        <div class="col-md-6">
            <select id="select_language" class="selectpicker" data-width="100%">
                <option value="0"><?= $this->__('backend.select.allLanguages') ?></option>
                <?php foreach ($menu['languages']->getAll() as $language): ?>
                    <option data-icon="flag-icon flag-icon-<?= $language->getFlag() ?>"
                            value="<?= $language->getId() ?>"><?= $language->getTitle() ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="list-group" id="settings_menu" role="tablist" aria-multiselectable="true">
            <a class="list-group-item collapsed" data-toggle="collapse" data-parent="#settings_menu" href="#settings_menu_1" aria-expanded="false" aria-controls="settings_menu_1">
                <h4 class="list-group-item-heading"><i class="fa fa-fw fa-cog"></i> System</h4>
                <p class="list-group-item-text">General system settings</p>
            </a>
            <div id="settings_menu_1" class="list-group collapse" role="tabpanel">
                <a id="link_system_domains" href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_controller' => 'Settings', '_action' => 'domains']) ?>" class="active list-group-item"><i class="fa fa-fw fa-globe"></i> Domains and domain urls</a>
                <a id="link_system_sessions" href="#" class="list-group-item"><i class="fa fa-fw fa-user-secret"></i> Session</a>
                <a id="link_system_media" href="#" class="list-group-item"><i class="fa fa-fw fa-cloud"></i> Media storages</a>
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