<div class="form-group">
	<?= $this->helper("Wizard")->textField("title", "Title", $title) ?>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?= $this->helper("Wizard")->selectField("icon", "Icon", ["fa fa-code fa-3x" => "Code", "fa fa-pagelines fa-3x" => "Pagelines", "fa fa-edit fa-3x" => "Edit", "fa fa-desktop fa-3x" => "Desktop"], $icon) ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= $this->helper("Wizard")->textField("link", "Link", $link) ?>
		</div>
	</div>
</div>
<div class="form-group">
	<?= $this->helper("Wizard")->rteField("content", "Content", $content) ?>
</div>