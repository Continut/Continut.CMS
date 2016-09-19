<blockquote>
    <p><i class="fa fa-fw fa-info"></i> <?= $this->__("backend.wizard.containers.info", ["count" => "1"]) ?></p>
    <footer><?= $this->__("backend.wizard.containers.info.footer") ?></footer>
</blockquote>
<div class="form-group">
    <?= $this->helper("Wizard")->textField("title", $this->__("backend.wizard.title"), $title) ?>
</div>