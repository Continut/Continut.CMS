<div class="row">
	<div class="col-sm-12">
		<ol class="breadcrumb breadcrumb-page-tree">
			<li class="active"><?= $this->__("backend.content.type." . $element->getType()) ?></li>
			<li>
				<?php if (!$element->getTitle()): ?>
					<?= $this->__("backend.content.noTitle") ?>
				<?php else: ?>
					<?= $element->getTitle() ?>
				<?php endif ?>
				(<?= $element->getUid() ?>)
			</li>
		</ol>
	</div>
</div>
<?= $this->partial("Backend", "Backend", "Content/editArea") ?>
<div class="row">
	<div class="col-sm-12">
		<form method="post" id="form_content" class="form-content" action="<?= $this->helper("Url")->linkToAction("Backend", "Content", "update", ["uid" => $element->getUid()]) ?>">
			<?= $content ?>
		</form>
	</div>
</div>
<?= $this->partial("Backend", "Backend", "Content/editArea") ?>

<script>
	// Post form using FormData, if supported
	$('#form_content').on('submit', function() {
		var form = $(this);
		var formdata = false;
		if (window.FormData) {
			formdata = new FormData(form[0]);
		}
		var formAction = form.attr('action');
		$.ajax({
			url         : formAction,
			data        : formdata ? formdata : form.serialize(),
			cache       : false,
			contentType : false,
			processData : false,
			type        : 'POST',
			dataType    : 'json',
			success     : function(data, textStatus, jqXHR){
				$('.ajax-loader').hide();
				if (data.status) {
					$('.ajax-saved').show();
				} else {
					$('.ajax-not-saved').show();
				}
			}
		});

		return false;
	});
	// Submit form on click
	$('.wizard-save').on('click', function() {
		$('.ajax-loader').show();
		$('.ajax-saved').hide();
		$('.ajax-not-saved').hide();
		$('#form_content').submit();
	});
</script>