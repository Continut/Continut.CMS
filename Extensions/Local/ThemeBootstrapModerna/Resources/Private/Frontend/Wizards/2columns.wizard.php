<div class="form-group">
	<?= $this->helper("Wizard")->textField("title", "Title", $title) ?>
</div>
<div class="form-group">
	<?= $this->helper("Wizard")->selectField("formatColumn1", "Space usage per column", ["1" => "8% left, 92% right", "2" => "16% left, 84% right", "3" => "24% left, 76% right", "4" => "32% left, 68% right", "5" => "40% left, 60% right", "6" => "50% left, 50% right", "7" => "60% left, 40% right", "8" => "68% left, 32% right", "9" => "76% left, 24% right", "10" => "84% left, 16% right", "11" => "92% left, 8% right"]) ?>
</div>