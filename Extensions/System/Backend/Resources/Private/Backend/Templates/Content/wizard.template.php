<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist">
		<?php $counter = 0; ?>
		<?php foreach ($types as $type => $elements): ?>
			<li role="presentation" <?= ($counter == 0) ? 'class="active"' : ''; ?>><a href="#wizard_tab_<?= $type ?>" aria-controls="<?= $type ?>" role="tab" data-toggle="tab"><?= $this->__("backend.content.wizard.type.$type") ?></a></li>
			<?php $counter++; ?>
		<?php endforeach ?>
	</ul>

	<div class="tab-content">
		<?php $counter = 0; ?>
		<?php foreach ($types as $type => $elements): ?>
			<div role="tabpanel" class="tab-pane <?= ($counter == 0) ? 'active' : ''; ?>" id="wizard_tab_<?= $type ?>">
				<ul class="nav tab-elements">
					<?php foreach ($elements as $element): ?>
						<?php foreach ($element["configuration"] as $identifier => $value): ?>
							<li>
								<a href="<?= $this->helper("Url")->linkToAction("Backend", "Content", "add", ["settings" => ["extension" => $element["extension"], "identifier" => $identifier, "type" => $type, "template" => $value["template"]]]) ?>" class="content-wizard-element">
									<?php if (isset($value["icon"])): ?>
										<img src="<?= $this->publicAsset($value["icon"], $element["extension"]); ?>" width="64" height="64" class="media-object" alt="" />
									<?php endif ?>
									<p class="title"><?= $this->__($value["label"]) ?></p>
									<p><?= $this->__($value["description"]) ?></p>
								</a>
							</li>
						<?php endforeach ?>
					<?php endforeach ?>
				</ul>
			</div>
			<?php $counter++; ?>
		<?php endforeach ?>
	</div>

</div>

<script>
	$('.content-wizard-element').on('click', function() {
		$.getJSON($(this).attr('href'), function (data) {
			if (data.operation == "add") {
				$('#content').html(data.html);
				$.each(BootstrapDialog.dialogs, function(id, dialog){
					dialog.close();
				});
			}
		});
		return false;
	});
</script>