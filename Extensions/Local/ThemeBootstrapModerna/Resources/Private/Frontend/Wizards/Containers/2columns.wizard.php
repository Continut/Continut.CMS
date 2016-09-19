<blockquote>
    <p><i class="fa fa-fw fa-info"></i> <?= $this->__("backend.wizard.containers.info", ["count" => "2"]) ?></p>
    <footer><?= $this->__("backend.wizard.containers.info.footer") ?></footer>
</blockquote>
<div class="form-group">
    <?= $this->helper("Wizard")->textField("title", $this->__("backend.wizard.title"), $title) ?>
</div>
<div class="form-group">
    <?= $this->helper("Wizard")->selectField(
        "formatColumns",
        $this->__("backend.wizard.containers.spaceUsage"),
        [
            "1" => $this->__("backend.wizard.containers.usage.2_1"),
            "2" => $this->__("backend.wizard.containers.usage.2_2"),
            "3" => $this->__("backend.wizard.containers.usage.2_3"),
            "4" => $this->__("backend.wizard.containers.usage.2_4"),
            "5" => $this->__("backend.wizard.containers.usage.2_5"),
            "6" => $this->__("backend.wizard.containers.usage.2_6"),
            "7" => $this->__("backend.wizard.containers.usage.2_7"),
            "8" => $this->__("backend.wizard.containers.usage.2_8"),
            "9" => $this->__("backend.wizard.containers.usage.2_9"),
            "10" => $this->__("backend.wizard.containers.usage.2_10"),
            "11" => $this->__("backend.wizard.containers.usage.2_11")
        ],
        $formatColumns
    )
    ?>
</div>