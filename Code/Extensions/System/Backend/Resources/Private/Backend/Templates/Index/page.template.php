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
		<p><small><strong>Currently browsing:</strong> www.twannberg.ch</small></p>
		<div id="cms_tree"></div>
	</div>
	<div id="content" class="col-md-9"></div>
</div>