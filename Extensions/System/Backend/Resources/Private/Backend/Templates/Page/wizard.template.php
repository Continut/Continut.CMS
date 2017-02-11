<?php if ($page): ?>
    <p class="lead"><?= $this->__('backend.page.wizard.create.description', ['page' => $page->getTitle()]) ?></p>
<?php else: ?>
    <p class="lead"><?= $this->__('backend.page.wizard.title.root') ?></p>
<?php endif ?>
<form method="post" id="form_page_wizard" class="form"
      action="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Page', '_action' => 'add', 'id' => (($page) ? $page->getId() : 0)]) ?>">
    <input type="hidden" name="domain_url_id" value=""/>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <p><strong><?= $this->__('backend.page.wizard.placement.title') ?></strong></p>
            <?php if ($page): ?>
                <div class="radio">
                    <label>
                        <input type="radio" value="before" name="page_placement"
                               id="before_page">
                            <?= $this->__('backend.page.wizard.placement.before') ?>
                    </label>
                </div>
            <?php endif; ?>
            <?php if ($page): ?>
            <div class="radio">
                <label>
                    <input type="radio" value="inside" name="page_placement" id="inside_page">
                    <?= $this->__('backend.page.wizard.placement.inside') ?>
                </label>
            </div>
            <?php endif ?>
                <div class="radio">
                    <label>
                        <input type="radio" value="after" name="page_placement"
                               checked id="after_page">
                        <?php if ($page): ?>
                            <?= $this->__('backend.page.wizard.placement.after') ?>
                        <?php else: ?>
                            <?= $this->__('backend.page.wizard.root.placement.after') ?>
                        <?php endif; ?>
                    </label>
                </div>
        </div>
        <div class="col-sm-12 col-md-9">
            <p><strong><?= $this->__('backend.page.wizard.pages.list') ?></strong></p>
            <div id="wizard_pages">
                <div class="row page-line form-group">
                    <div class="col-sm-6">
                        <?= $this->helper('Form')->textField("name[]", $this->__("backend.page.wizard.placeholder.title")) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $this->helper('Form')->selectField("layout[]", $this->__("backend.page.properties.pageLayout"), array_merge(array("" => $this->__("backend.layout.selectLayout")), $layouts)) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $this->helper('Form')->selectField("visibility[]", $this->__("backend.page.properties.visibility"), [
                            'visible' => $this->__('backend.page.wizard.state.visible'),
                            'hidden'  => $this->__('backend.page.wizard.state.hidden'),
                            'hidden_in_menu'    => $this->__('backend.page.wizard.state.hiddenInMenu')
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-success page-wizard-add"><i
                            class="fa fa-plus"></i> <?= $this->__('backend.page.wizard.additionalPage') ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <hr/>
        <div class="col-sm-12">
            <a class="btn btn-default" data-dismiss="modal"><?= $this->__('backend.page.wizard.button.close') ?></a>
            <a class="btn btn-info" href="">Need help <i class="fa fa-icon fa-question-circle"></i></a>
            <input type="submit" id="btn-save" class="pull-right btn btn-primary btn-save"
                   value="<?= $this->__('backend.page.wizard.button.save') ?>"/>
        </div>
    </div>
</form>
<script>

    // set the domain_url_id (also known as the "language")
    $('#form_page_wizard input[name=domain_url_id]').val($('#select_language').val());

    // when adding a new page just duplicate the existing line
    $('.page-wizard-add').on('click', function (event) {
        $('.page-line').eq(0).clone().appendTo('#wizard_pages');
    });

    // Post form using FormData, if supported
    $('#form_page_wizard').on('submit', function () {
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
                 if (data.success) {
                     var index ;
                     for (index = 0; index < data.pages.length; index++) {
                         var page = data.pages[index];
                         $('#cms_tree').jstree('create_node', page.parent, page.node, page.position)
                     }
                     addModal.close();
                 } else {
                     // @TODO add error message
                 }
            }
        });

        return false;
    });
</script>