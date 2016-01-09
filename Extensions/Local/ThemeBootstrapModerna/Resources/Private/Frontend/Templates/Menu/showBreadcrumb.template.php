<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb">
				<li><a href="<?= $this->helper("Url")->linkToHome() ?>"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
				<?php if ($breadcrumbs): ?>
					<?php foreach ($breadcrumbs as $breadcrumb): ?>
						<li><a href="<?= $this->helper("Url")->linkToPage($breadcrumb->getId()) ?>"><?= $breadcrumb->getTitle(); ?></a><i class="icon-angle-right"></i></li>
					<?php endforeach ?>
				<?php endif ?>
				<li class="active"><?= $page->getTitle() ?></li>
			</ul>
		</div>
	</div>
</div>