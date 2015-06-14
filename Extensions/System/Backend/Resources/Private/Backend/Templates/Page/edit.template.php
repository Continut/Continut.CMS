<div class="col-sm-12">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<div class="panel-title">
				<?= $this->__("backend.page.properties.header") ?>
			</div>
		</div>
		<div class="panel-body">
			<div class="col-sm-12">
				<div class="form-group">
					<?= $this->helper("Wizard")->textField("title", $this->__("backend.page.properties.page_title"), $page->getTitle()) ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?= $this->helper("Wizard")->textField("meta_keywords", $this->__("backend.page.properties.meta_keywords"), $page->getMetaKeywords()) ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?= $this->helper("Wizard")->textareaField("meta_description", $this->__("backend.page.properties.meta_description"), $page->getMetaDescription()) ?>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<a class="btn btn-primary"><?= $this->__("backend.page.properties.save_changes") ?></a>
		</div>
	</div>
</div>