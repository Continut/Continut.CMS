<?php
switch($lineType) {
	case 'dashed' : $type = 'dashed'; break;
	case 'dotted' : $type = 'dotted'; break;
	default       : $type = 'solid'; break;
}
?>
<div class="row">
	<div class="col-lg-12">
		<div style="border-top: 1px <?= $type ?> gray"></div>
	</div>
</div>