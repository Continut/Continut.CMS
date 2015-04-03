<?php $this->renderPartial('Header/Nav'); ?>

<div style="background: gray; border: 2px solid red;">
	<?php $this->showContainerId(1); ?>
</div>
<div style="overflow: hidden">
	<div style="width: 46%; float: left; margin: 0 1%; border: 1px solid green">
		<?php $this->showContainerId(2); ?>
	</div>
	<div style="width: 46%; float: left; margin: 0 1%; border: 1px solid blue">
		<?php $this->showContainerId(3); ?>
	</div>
</div>
