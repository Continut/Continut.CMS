<?php
switch($lineType) {
	case 'dashed' : $class = 'dashedline'; break;
	case 'dotted' : $class = 'dottedline'; break;
	default       : $class = 'solidline'; break;
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="<?= $class ?>">
		</div>
	</div>
</div>