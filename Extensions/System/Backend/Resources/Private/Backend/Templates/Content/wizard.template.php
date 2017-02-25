<div role="tabpanel">
    <div class="form-group">
        <?php if (sizeof($extensions) > 0): ?>
            <?= $this->helper('Form')->selectField('theme', $this->__('backend.content.wizard.select.theme'), array_merge(['' => $this->__("backend.content.wizard.select.theme.all")], $extensions), $page->getLayoutExtension()); ?>
        <?php endif ?>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <?php $counter = 0; ?>
        <?php foreach ($types as $type => $elements): ?>
            <li role="presentation" <?= ($counter == 0) ? 'class="active"' : ''; ?>>
                <a href="#wizard_tab_<?= $type ?>" aria-controls="<?= $type ?>"  role="tab" data-toggle="tab"><?= $this->__("backend.content.wizard.type.$type") ?></a>
            </li>
            <?php $counter++; ?>
        <?php endforeach ?>
    </ul>

    <div class="tab-content" id="themes_list">
        <?php $counter = 0; ?>
        <?php foreach ($types as $type => $elements): ?>
            <div role="tabpanel" class="tab-pane <?= ($counter == 0) ? 'active' : ''; ?>" id="wizard_tab_<?= $type ?>">
                <ul class="nav tab-elements">
                    <?php foreach ($elements as $element): ?>
                        <?php foreach ($element["configuration"] as $identifier => $value): ?>
                            <li class="theme-<?= $element["extension"] ?>">
                                <a href="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Content', '_action' => 'add', 'id' => $id, 'column_id' => $columnId, 'page_id' => $pageId, 'settings' => ['extension' => $element['extension'], 'identifier' => $identifier, 'type' => $type, 'template' => $value['template']]]) ?>"
                                   class="content-wizard-element">
                                    <?php if (isset($value["icon"])): ?>
                                        <img src="<?= $this->publicAsset($value["icon"], $element["extension"]); ?>"
                                             width="64" height="64" class="media-object" alt=""/>
                                    <?php endif ?>
                                    <p class="title"><?= $this->__($value["label"]) ?></p>
                                    <p><?= $this->__($value["description"]) ?></p>
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php $counter++; ?>
        <?php endforeach ?>
    </div>

</div>

<script>
    $('.content-wizard-element').on('click', function (event) {
        $.getJSON($(this).attr('href'), function (data) {
            $('#content').html(data.html);
            $.each(BootstrapDialog.dialogs, function (id, dialog) {
                dialog.close();
            });
        });
        return false;
    });

    $('#field_theme').on('change', function (event) {
        if ($(this).val() == "") {
            $('#themes_list li').show();
        } else {
            $('#themes_list li').hide();
            $('#themes_list li.theme-' + $(this).val()).show();
        }
    });
</script>