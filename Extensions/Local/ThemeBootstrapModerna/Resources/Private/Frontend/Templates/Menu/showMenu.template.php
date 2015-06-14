<header>
	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?= $this->helper("Url")->linkToPage(1) ?>"><span>M</span>oderna</a>
			</div>
			<div class="navbar-collapse collapse ">
				<?php if ($pageTree): ?>
					<ul class="nav navbar-nav">
					<?php foreach ($pageTree as $leaf): ?>
						<?php if ($leaf->children): ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false"><?= $leaf->getTitle() ?> <b class="icon-angle-down"></b></a>
								<ul class="dropdown-menu">
								<?php foreach ($leaf->children as $subleaf): ?>
									<li>
										<a href="<?= $this->helper("Url")->linkToSlug($subleaf->getSlug()) ?>"><?= $subleaf->getTitle() ?></a>
									</li>
								<?php endforeach ?>
								</ul>
							</li>
						<?php else: ?>
							<li><a href="<?= $this->helper("Url")->linkToSlug($leaf->getSlug()) ?>"><?= $leaf->getTitle() ?></a></li>
						<?php endif ?>
					<?php endforeach ?>
					</ul>
				<?php endif ?>
			</div>
		</div>
	</div>
</header>
