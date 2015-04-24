<div class="row">
	<div id="sidebar_tree" class="col-md-3">
		<!-- tree toolbar -->
		<div id="sidebar_toolbar" class="row">
			<form class="form">
				<div class="col-sm-7 col-md-12 col-lg-7">
					<label for="select_website"><a class="btn btn-sm btn-default" href=""><i class="fa fa-cog"></i></a> <span class="hidden-md"><?= $this->__("backend.pageTree.domain.label") ?></span></label>
					<?php if ($domains->count() > 0): ?>
						<select id="select_website" class="selectpicker" data-width="100%">
							<?php foreach ($domains->getAll() as $domain): ?>
								<option value="<?= $domain->getUid() ?>"><?= $domain->getTitle() ?></option>
							<?php endforeach ?>
						</select>
						<script type="text/javascript">
							$('#select_website').on('change', function (event) {
								$.ajax({
									url: '<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageTree") ?>',
									data: { domain_uid: this.value }
								})
									.done(function( data ) {
										var $languages = $('#select_language');
										$languages.empty();
										$.each($.parseJSON(data).languages, function (value, key) {
											$languages.append($("<option data-icon='flag-icon flag-icon-" + key.flag + "'></option>").attr("value", value).text(key.title));
										});
										$languages.selectpicker('refresh');
										$('#cms_tree').tree('loadData', $.parseJSON(data).pages);
										$('#content').empty();
									});
							});
						</script>
					<?php else: ?>
						<p>Using global domain <a href="" class="btn btn-sm btn-success"><i class="fa fa-fw fa-plus"></i> 	</a></p>
					<?php endif ?>
				</div>
				<div class="col-sm-5 col-md-12 col-lg-5">
					<label for="select_language"><a class="btn btn-sm btn-default" href=""><i class="fa fa-cog"></i></a> <span class="hidden-md"><?= $this->__("backend.pageTree.language.label") ?></span></label>
					<select id="select_language" class="selectpicker" data-width="100%">
						<?php foreach ($languages->getAll() as $language): ?>
							<option data-icon="flag-icon flag-icon-<?= $language->getFlag() ?>" value="<?= $language->getUid() ?>"><?= $language->getTitle() ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</form>
		</div>
		<div class="row tree-filter">
			<div class="col-xs-7">
				<form action="<?= $this->helper("Url")->linkToAction("Backend", "Index", "searchPageTree") ?>" class="form-inline" method="post">
					<div class="form-group entire-area">
						<div class="input-group entire-area">
							<div class="input-group-addon"><i id="search_page_progress" class="fa fa-fw fa-file"></i></div>
							<input type="text" class="form-control" name="search_page" id="search_page" placeholder="<?= $this->__("backend.pageTree.findPage") ?>" />
						</div>
					</div>
				</form>
			</div>
			<div class="col-xs-5">
				<a href="" class="btn btn-success col-xs-12"><i class="fa fa-fw fa-plus"></i> Pagină nouă</a>
			</div>
		</div>
		<div id="cms_tree"></div>
		<script type="text/javascript">
			var searchPageTreeThread = null;
			var searchPageSpinner = $('#search_page_progress');
			var oldSearch = null;

			function findPageByName(term) {
				oldSearch = term;
				searchPageSpinner.removeClass("fa-file").addClass("fa-spinner fa-pulse");
				$.ajax({
						url: '<?= $this->helper("Url")->linkToAction("Backend", "Index", "searchPageTree") ?>',
						data: {query: term, domain_uid: $('#select_website').val() }
					}
				).done(function (data) {
					searchPageSpinner.removeClass("fa-spinner fa-pulse").addClass("fa-file");
					$('#cms_tree').tree('loadData', $.parseJSON(data).pages);
				});
			}

			$('#search_page').keydown(function(e) {
				var $this = $(this);
				if ($this.val() == oldSearch) {
					return;
				}
				// ignore Enter or Tab
				if (e.which != 9 && e.which != 13) {
					clearTimeout(searchPageTreeThread);
					searchPageTreeThread = setTimeout(function() {
						findPageByName($this.val())
					}, 500);
				}
			});

			$.getJSON(
				'<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageTree") ?>',
				function(data) {
					$('#cms_tree').tree({
						data: data.pages,
						dragAndDrop: true,
						allowDragEventPropagation: false,
						closedIcon: $('<i class="fa fa-fw fa-chevron-right"></i>'),
						openedIcon: $('<i class="fa fa-fw fa-chevron-down"></i>'),
						useContextMenu: false,
						slide: false,
						onCreateLi: function(node, $li) {
							// Add 'icon' span before title
							var iconClass = 'fa-file';
							/*if (node.type == "folder") {
								iconClass = 'fa-folder';
							}*/
							var pageIcon = '';
							switch (node.state) {
								case "hidden-frontend": pageIcon = '<span class="fa-stack"><i class="fa fa-lg tree-icon fa-fw ' + iconClass + ' fa-disabled"></i><i class="fa fa-stack-1x"></i></span> '; break;
								case "hidden-both":     pageIcon = '<span class="fa-stack"><i class="fa fa-lg tree-icon fa-fw ' + iconClass + ' fa-disabled"></i><i class="fa fa-eye-slash fa-stack-1x text-danger"></i></span> '; break;
								case "hidden-menu":     pageIcon = '<span class="fa-stack"><i class="fa fa-lg tree-icon fa-fw ' + iconClass + '"></i><i class="fa fa-eye-slash fa-stack-1x text-danger"></i></span> '; break;
								default:                pageIcon = '<span class="fa-stack"><i class="fa fa-lg tree-icon fa-fw ' + iconClass + '"></i><i class="fa fa-stack-1x"></i></span> ';
							}
							$li.find('.jqtree-title').before(pageIcon);
						}

					});
					$('#cms_tree').bind(
						'tree.select',
						function (event) {
							// once a node is clicked, load the corresponding page in the right side
							if (event.node) {
								$.ajax({
									url: '<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageShow") ?>',
									data: {page_uid: event.node.id},
									beforeSend: function (xhr) {
										$(event.node.element).find('.jqtree-element').eq(0).append('<span class="pull-right fa fa-spinner fa-pulse"></span>');
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
								'<?= $this->helper("Url")->linkToAction("Backend", "Index", "pageTreeMove") ?>',
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