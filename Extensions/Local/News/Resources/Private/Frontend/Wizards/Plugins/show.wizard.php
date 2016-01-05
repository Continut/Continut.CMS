<blockquote>
	<p><i class="fa fa-fw fa-newspaper-o"></i> <?= $this->__("backend.news.pluginInfo") ?></p>
	<footer><a href=""><?= $this->__("backend.news.pluginManual") ?></a></footer>
</blockquote>
<div class="form-group">
	<?= $this->helper("Wizard")->textField("title", $this->__("backend.wizard.title"), $title) ?>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			<?= $this->helper("Wizard")->textField("limit", "How many news to show", $limit) ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?= $this->helper("Wizard")->selectField(
				"order",
				"Order by",
				[
					"title" => "Title",
					"crdate" => "Creation date",
				]
			)
			?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?= $this->helper("Wizard")->selectField(
				"order",
				"Order direction",
				[
					"asc" => "Ascending",
					"desc" => "Descending",
				]
			)
			?>
		</div>
	</div>
</div>