<form method="POST" id="page_edit_template" action="<?= $this->helper("Url")->linkToAction("Backend", "Page", "saveProperties") ?>">
	<?= $this->helper("Wizard")->hiddenField("uid", $page->getUid()); ?>
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
						<?= $this->helper("Wizard")->textareaField("meta_description", $this->__("backend.page.properties.metaDescription"), $page->getMetaDescription()) ?>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<input type="submit" name="submit" class="btn btn-primary" value="<?= $this->__("backend.page.properties.saveChanges") ?>" />
			</div>
		</div>
	</div>
</form>

<script>
	// Post form using FormData, if supported
	$('#page_edit_template').on('submit', function() {
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
				$('#page_edit').empty();
			}
		});

		return false;
	});
</script>