<div class="row">
	<div id="sidebar_tree" class="col-md-3">
		<!-- tree toolbar -->
		<div id="sidebar_toolbar">
			<div class="row">
				<form class="form">
					<div class="col-sm-7 col-md-12 col-lg-7">
						<label for="select_website"><a class="btn btn-sm btn-default" href=""><i class="fa fa-cog"></i></a> <span class="hidden-md">Website \ Domain</span></label>
						<?php if ($domains->count() > 0): ?>
						<div class="btn-group selectlist" data-initialize="selectlist" id="select_website">
							<button class="btn btn-backend dropdown-toggle" data-toggle="dropdown" type="button">
								<span class="selected-label"></span>
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<?php foreach ($domains->getAll() as $domain): ?>
									<li data-value="<?= $domain->getUid() ?>"><a href="#"><?= $domain->getTitle() ?></a></li>
								<?php endforeach ?>
							</ul>
							<input class="hidden hidden-field" name="mySelectlist" readonly="readonly" aria-hidden="true" type="text"/>
						</div>
							<script type="text/javascript">
								$('#select_website').on('changed.fu.selectlist', function (event, data) {
									$.ajax({
										url: '<?= $this->link(["_extension" => "Backend", "_controller" => "Index", "_action" => "pageTree"]) ?>',
										data: { domain_uid: data.value }
									})
									.done(function( data ) {
										console.log("apelat");
										$('#cms_tree').tree('loadData', $.parseJSON(data).pages);
									});
								});
								$('#select_website').selectlist(0);
							</script>
						<?php else: ?>
							<p>Using global domain <a href="" class="btn btn-sm btn-success"><i class="fa fa-fw fa-plus"></i> 	</a></p>
						<?php endif ?>
					</div>
					<div class="col-sm-5 col-md-12 col-lg-5">
						<label for="select_language"><a class="btn btn-sm btn-default" href=""><i class="fa fa-cog"></i></a> <span class="hidden-md">Language</span></label>
						<div class="btn-group selectlist" data-initialize="selectlist" id="select_language">
							<button class="btn btn-backend dropdown-toggle" data-toggle="dropdown" type="button">
								<span class="selected-label"></span>
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li data-value="1"><a href="#"><i class="flag-icon flag-icon-gb"></i> English</a></li>
								<li data-value="2"><a href="#"><i class="flag-icon flag-icon-ro"></i> Română</a></li>
								<li data-value="3"><a href="#"><i class="flag-icon flag-icon-fr"></i> Français</a></li>
								<li data-value="3"><a href="#"><i class="flag-icon flag-icon-ru"></i> русский</a></li>
							</ul>
							<input class="hidden hidden-field" name="mySelectlist" readonly="readonly" aria-hidden="true" type="text"/>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="cms_tree"></div>
		<script type="text/javascript">
			$.getJSON(
				'<?= $this->link(["_extension" => "Backend", "_controller" => "Index", "_action" => "pageTree"]) ?>',
				function(data) {
					$('#cms_tree').tree({
						data: data,
						dragAndDrop: true,
						allowDragEventPropagation: false,
						closedIcon: $('<i class="fa fa-fw fa-chevron-right"></i>'),
						openedIcon: $('<i class="fa fa-fw fa-chevron-down"></i>'),
						useContextMenu: false,
						slide: false,
						onCreateLi: function(node, $li) {
							// Add 'icon' span before title
							switch (node.type) {
								case "folder" : $li.find('.jqtree-title').before('<i class="fa tree-icon fa-fw fa-folder-o"></i> '); break;
								default: $li.find('.jqtree-title').before('<i class="fa tree-icon fa-fw fa-file-o"></i> ');
							}
						}

					});
					$('#cms_tree').bind(
						'tree.select',
						function (event) {
							// once a node is clicked, load the corresponding page in the right side
							if (event.node) {
								$.ajax({
									url: '<?= $this->link(["_extension" => "Backend", "_controller" => "Index", "_action" => "pageShow"]) ?>',
									data: {page_uid: event.node.id},
									beforeSend: function (xhr) {
										$(event.node.element).find('.jqtree-element').append('<span class="pull-right fa fa-spinner fa-pulse"></span>');
									}
								})
									.done(function (data) {
										$('#content').html(data);
										$(event.node.element).find('.fa-spinner').remove();
									});
							}
						}
					);
					$('#cms_tree').bind(
						'tree.move',
						function(event) {
							event.preventDefault();
							event.move_info.do_move();
							$.post(
								'<?= $this->link(["_extension" => "Backend", "_controller" => "Index", "_action" => "pageTreeMove"]) ?>',
								{
									movedId: event.move_info.moved_node.id,
									newParentId: event.move_info.target_node.id,
									position: event.move_info.position
								}
							);
						}
					);
				}
			);

		</script>
	</div>
	<div id="content" class="col-md-9"></div>
</div>