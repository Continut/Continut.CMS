<div class="<?= $align ?>">
	<?php if ($icon): ?>
		<h3 style="font-size: 40px"><i class="fa <?= $icon ?>"></i></h3>
	<?php endif ?>
	<?php if ($title): ?>
		<h3><?= $title ?></h3>
	<?php endif ?>
	<?php if ($subtitle): ?>
		<p><?= $this->helper('String')->truncate($this->helper('String')->stripTags($subtitle), 200) ?></p>
	<?php endif ?>
</div>