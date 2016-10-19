<div class="row">
    <div class="col-sm-12">
        <h2><?= $this->__('backend.menu.settings') ?></h2>
        <div class="row">
            <div class="col-md-3">
                <p><?= $this->__('backend.settings.description')?></p>
                <div class="row">
                    <div class="col-md-6">
                        <select id="select_website" class="selectpicker" data-width="100%">
                            <option value="0">- Global -</option>
                            <?php foreach ($domains->getAll() as $domain): ?>
                                <option value="<?= $domain->getId() ?>"><?= $domain->getTitle() ?></option>
                            <?php endforeach ?>
                        </select>
                        <script type="text/javascript">
                            $('#select_website').on('change', function (event) {
                                $.ajax({
                                    url: '<?= $this->helper("Url")->linkToAction("Backend", "Settings", "languages") ?>',
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
                            <?php foreach ($languages->getAll() as $language): ?>
                                <option data-icon="flag-icon flag-icon-<?= $language->getFlag() ?>"
                                        value="<?= $language->getId() ?>"><?= $language->getTitle() ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
            </div>
        </div>
        <div class="row settings-content" id="content">
            <div class="col-sm-12">
                <div class="row">
                    <form method="post" action="">
                        <div class="col-md-3">
                            <ul id="settings_general" class="nav nav-pills nav-stacked" role="tablist">
                                <li><h3>System</h3></li>
                                <li role="presentation" class="active"><a href="#option1" aria-controls="option1"
                                                                          role="tab" data-toggle="tab">Domains and
                                        domain urls</a></li>
                                <li role="presentation"><a href="#option2" aria-controls="option2" role="tab"
                                                           data-toggle="tab">Sessions</a></li>
                                <li role="presentation"><a href="#option3" aria-controls="option3" role="tab"
                                                           data-toggle="tab">Media storages</a></li>
                                <li><h3>Extensions</h3></li>
                                <li role="presentation"><a href="#option4" aria-controls="option4" role="tab"
                                                           data-toggle="tab">News</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="option1">
                                    <div class="pull-right">
                                        <a href="" class="btn btn-success"><i class="fa fa-icon fa-home"></i> Add new
                                            domain</a>
                                        <a href="" class="btn btn-success"><i class="fa fa-icon fa-globe"></i> Add new
                                            language</a>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-title">Domains and domain urls</div>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-readable list-enclosed">
                                                <?php foreach ($domains->getAll() as $domain): ?>
                                                    <li>
                                                        <label><strong><input type="checkbox" name="domains[]"
                                                                              value="<?= $domain->getId() ?>"> <?= $domain->getTitle() ?>
                                                            </strong></label>
                                                        <ul class="list-readable">
                                                            <?php foreach ($domain->getDomainUrls() as $language): ?>
                                                                <li>
                                                                    <label><input type="checkbox" name="domain_urls[]"
                                                                                  value="<?= $language->getId() ?>"> <i
                                                                            class="flag-icon flag-icon-<?= $language->getFlag() ?>"></i> <?= $language->getTitle() ?>
                                                                    </label>
                                                                    <i class="fa fa-icon fa-globe"></i> <?= $language->getUrl() ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="option2">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="panel-title">Sessions</div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg">
                                                        <label>Frontend session expires in</label>
                                                        <div class="input-group col-sm-4">
                                                            <div class="input-group-addon"><span
                                                                    class="fa fa-icon fa-hourglass-half"></span></div>
                                                            <input type="text" class="form-control"
                                                                   name="settings[session][feuser_expire]" value="360"/>
                                                            <div class="input-group-addon">minutes</div>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-default" href=""><span
                                                            class="fa fa-icon fa-users"></span> Administer Frontend
                                                        Users</a>
                                                    <a class="btn btn-default" href=""><span
                                                            class="fa fa-icon fa-users"></span> Administer Frontend
                                                        Groups</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg">
                                                        <label>Backend session expires in</label>
                                                        <div class="input-group col-sm-4">
                                                            <div class="input-group-addon"><span
                                                                    class="fa fa-icon fa-hourglass-half"></span></div>
                                                            <input type="text" class="form-control"
                                                                   name="settings[session][beuser_expire]" value="360"/>
                                                            <div class="input-group-addon">minutes</div>
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-default" href=""><span
                                                            class="fa fa-icon fa-users"></span> Administer Backend Users</a>
                                                    <a class="btn btn-default" href=""><span
                                                            class="fa fa-icon fa-users"></span> Administer Backend
                                                        Groups</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="option3">
                                    <h3>Media storages</h3>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="option4">
                                    <h3>News</h3>
                                </div>
                            </div>
                            <a href="" class="btn btn-success">Save changes</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>