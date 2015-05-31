<blockquote>
	<p><i class="fa fa-fw fa-newspaper-o"></i> <?= $this->__("backend.news.pluginInfo") ?></p>
	<footer><a href=""><?= $this->__("backend.news.pluginManual") ?></a></footer>
</blockquote>
<div class="form-group">
	<?= $this->helper("Wizard")->textField("title", $this->__("backend.wizard.title"), $title) ?>
</div>