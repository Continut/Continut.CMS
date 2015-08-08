<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb">
				<li><a href="<?= $this->helper("Url")->linkToHome() ?>"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
				<?php foreach ($breadcrumbs as $breadcrumb): ?>
					<li><a href="<?= $this->helper("Url")->linkToPage($breadcrumb->getUid()) ?>"><?= $breadcrumb->getTitle(); ?></a><i class="icon-angle-right"></i></li>
				<?php endforeach ?>
				<li class="active"><?= $page->getTitle() ?></li>
			</ul>
		</div>
	</div>
</div>