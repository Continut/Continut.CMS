<?php if ($page): ?>
    <p class="lead"><?= $this->__('backend.page.wizard.create.description', ['page' => $page->getTitle()]) ?></p>
<?php else: ?>
    <p class="lead"><?= $this->__('backend.page.wizard.title.root') ?></p>
<?php endif ?>
<form method="post" id="form_page_wizard" class="form" action="<?= $this->helper("Url")->linkToAction("Backend", "Page", "add", ["id" => (($page) ? $page->getId() : 0)]) ?>">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <p><strong><?= $this->__('backend.page.wizard.placement.title') ?></strong></p>
            <?php if ($page): ?>
            <div class="radio">
                <label>
                    <input type="radio" value="before" name="page_placement" id="before_page"> <?= $this->__('backend.page.wizard.placement.before') ?>
                </label>
            </div>
            <?php endif ?>
            <div class="radio">
                <label>
                    <input type="radio" value="inside" name="page_placement" id="inside_page" checked> <?= $this->__('backend.page.wizard.placement.inside') ?>
                </label>
            </div>
            <?php if ($page): ?>
            <div class="radio">
                <label>
                    <input type="radio" value="after" name="page_placement" id="after_page"> <?= $this->__('backend.page.wizard.placement.after') ?>
                </label>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 col-md-8">
            <p><strong><?= $this->__('backend.page.wizard.pages.list') ?></strong></p>
            <div id="wizard_pages">
                <div class="row page-line form-group">
                    <div class="col-sm-8">
                        <input type="text" name="page[names][]" class="form-control" placeholder="<?= $this->__('backend.page.wizard.placeholder.title') ?>">
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control">
                            <option><?= $this->__('backend.page.wizard.state.visible') ?></option>
                            <option><?= $this->__('backend.page.wizard.state.hidden') ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-success page-wizard-add"><i class="fa fa-plus"></i> <?= $this->__('backend.page.wizard.additionalPage') ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a class="btn btn-default" data-dismiss="modal"><?= $this->__('backend.page.wizard.button.close') ?></a>
            <input type="submit" class="pull-right btn btn-primary" value="<?= $this->__('backend.page.wizard.button.save') ?>" />
        </div>
    </div>
</form>
<script>
    $('.page-wizard-add').on('click', function (event) {
        $('.page-line').eq(0).clone().appendTo('#wizard_pages');
    });

    // Post form using FormData, if supported
    $('#form_page_wizard').on('submit', function() {
        var form = $(this);
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        $.ajax({
            url         : formAction,
            data        : formdata ? formdata : form.serialize(),
            cache       : false,
            contentType : false,
            processData : false,
            type        : 'POST',
            dataType    : 'html',
            success     : function(data, textStatus, jqXHR){
                /*$('.ajax-loader').hide();
                if (data.status) {
                    $('.ajax-saved').show();
                } else {
                    $('.ajax-not-saved').show();
                }*/
            }
        });

        return false;
    });
</script>