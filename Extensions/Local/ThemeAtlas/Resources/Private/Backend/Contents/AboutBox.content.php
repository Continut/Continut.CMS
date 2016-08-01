<div class="<?= $align ?>">
	<?php if ($icon): ?>
		<h3 style="color: #f7c221; font-size: 40px"><i class="fa <?= $icon ?>"></i></h3>
	<?php endif ?>
	<?php if ($title): ?>
	<h3><?= $title ?></h3>
	<?php endif ?>
	<?php if ($subtitle): ?>
		<p><?= $this->helper('Text')->truncate($this->helper('Text')->stripTags($subtitle), 200) ?></p>
	<?php endif ?>
</div>