<div>
	<?php if ($icon): ?>
		<p><i class="<?= $icon ?>"></i></p>
	<?php endif ?>
	<div class="text-center">
		<?= $this->helper('String')->truncate($this->helper('String')->stripTags($content), 100) ?>
	</div>
</div>