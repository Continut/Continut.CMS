<?php
$elementType = (isset($settings['type'])) ? $settings['type'] : $element->getType();
?>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb breadcrumb-page-tree">
            <li class="active"><?= $this->__('backend.content.type.' . $elementType) ?></li>
            <li>
                <?php if (!$element->getTitle()): ?>
                    <?= $this->__('backend.content.noTitle') ?>
                <?php else: ?>
                    <?= $element->getTitle() ?>
                <?php endif ?>
                (<?= $element->getId() ?>)
            </li>
        </ol>
    </div>
</div>
<?= $this->partial('Content/editButtons', 'Backend', 'Backend', ['id' => $id, 'pageId' => $pageId]) ?>
<div class="row">
    <div class="col-sm-12">
        <form method="post" id="form_content" class="form-content"
              action="<?= $this->helper("Url")->linkToPath('admin', ['_controller' => 'Content', '_action' => $action, 'id' => $element->getId()]) ?>">
            <input type="hidden" name="id" value="<?= $id ?>"/>
            <input type="hidden" name="page_id" value="<?= $pageId ?>"/>
            <input type="hidden" name="column_id" value="<?= $columnId ?>"/>
            <?php if (isset($settings)): ?>
                <?php foreach ($settings as $key => $value): ?>
                    <input type="hidden" name="settings[<?= $key ?>]" value="<?= $value ?>"/>
                <?php endforeach ?>
            <?php endif ?>
            <?= $content ?>
        </form>
    </div>
</div>
<?= $this->partial('Content/editButtons', 'Backend', 'Backend', ['id' => $id, 'pageId' => $pageId]) ?>

<script>
    // Post form using FormData, if supported
    $('#form_content').on('submit', function (event) {
        var form = $(this);
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        $.ajax({
            url: formAction,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                $('.ajax-loader').hide();
                if (data.success) {
                    $('.ajax-saved').show();
                    if (saveAction == 'saveAndClose') {
                        var contentId = data.content.id;
                        $.ajax({
                            url: '<?= $this->helper('Url')->linkToPath('admin', ['_controller' => 'Page', '_action' => 'show']) ?>',
                            data: {id: data.content.page_id}
                        }).done(function (data) {
                            // reload page data
                            $('#content').html(data);
                            // scroll to our updated element
                            var scrollTo = $('.panel-backend-content[data-id="' + contentId + '"]');
                            $('html, body').scrollTop(scrollTo.offset().top);
                        });
                    }
                } else {
                    $('.ajax-not-saved').show();
                }
            }
        });

        return false;
    });

    // default action is save, without closing the form
    var saveAction = 'save';

    // Submit form on click
    $('.wizard-save, .wizard-save-close').on('click', function (event) {
        if ($(this).hasClass('wizard-save-close')) {
            saveAction = 'saveAndClose';
        }
        event.preventDefault();

        $('.ajax-loader').show();
        $('.ajax-saved').hide();
        $('.ajax-not-saved').hide();
        $('#form_content').submit();
    });

    // close form
    $('.wizard-close').on('click', function (event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('href')
        }).done(function (data) {
            // reload page data
            $('#content').html(data);
        });
    });
</script>