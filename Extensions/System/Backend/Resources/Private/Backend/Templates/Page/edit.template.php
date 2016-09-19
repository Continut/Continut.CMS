<form method="POST" id="page_edit_template"
      action="<?= $this->helper("Url")->linkToAction("Backend", "Page", "saveProperties") ?>">
    <?= $this->helper("Wizard")->hiddenField("id", $page->getId()); ?>
    <div class="col-sm-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= $this->__("backend.page.properties.header") ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->textField("title", $this->__("backend.page.properties.pageTitle"), $page->getTitle()) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->selectField("layout", $this->__("backend.page.properties.pageLayout"), array_merge(array("" => $this->__("backend.layout.selectLayout")), $layouts), $page->getLayout()) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->textField("meta_keywords", $this->__("backend.page.properties.metaKeywords"), $page->getMetaKeywords()) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->selectField("layout_recursive", $this->__("backend.page.properties.pageLayoutRecursive"), array(0 => "No", 1 => "Yes"), $page->getLayoutRecursive()) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->textareaField("meta_description", $this->__("backend.page.properties.metaDescription"), $page->getMetaDescription()) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->dateTimeField("start_date", $this->__("backend.page.properties.startDate"), $page->getStartDate()) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->helper("Wizard")->dateTimeField("end_date", $this->__("backend.page.properties.endDate"), $page->getEndDate()) ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" name="submit" class="btn btn-primary"
                       value="<?= $this->__("backend.page.properties.saveChanges") ?>"/>
                <a class="close-button btn btn-danger pull-right"><?= $this->__("general.cancel") ?></a>
            </div>
        </div>
    </div>
</form>

<script>
    $('#page_edit_template .close-button').on('click', function () {
        $('#page_edit_block').empty();
    });
    // Post form using FormData, if supported
    $('#page_edit_template').on('submit', function () {
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
            beforeSend: function (xhr) {
                $('.loader-page-save-properties').show();
            }
        })
            .done(function (data) {
                $('#page_edit_block').empty();
                $('.loader-page-save-properties').hide();
                $('#content').html(data);
            });

        return false;
    });
</script>