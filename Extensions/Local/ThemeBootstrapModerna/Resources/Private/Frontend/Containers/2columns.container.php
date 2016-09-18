<?php
	$sizeLeft = $formatColumns;
	$sizeRight = 12 - $formatColumns;
?>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-<?= $sizeLeft ?>">
				<?= $this->showContainerColumn(4); ?>
			</div>
			<div class="col-lg-<?= $sizeRight ?>">
				<?= $this->showContainerColumn(5); ?>
			</div>
		</div>
	</div>
</div>