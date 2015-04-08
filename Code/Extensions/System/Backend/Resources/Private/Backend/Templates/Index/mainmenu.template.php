<ul class="nav navbar-nav">
<?php foreach ($mainMenu as $menuItem): ?>
	<?php if (isset($menuItem["items"])): ?>
		<li class="dropdown">
			<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
				<?php if (isset($menuItem["icon"])): ?>
					<i class="<?= $menuItem["icon"] ?>"></i>
				<?php endif ?>
				<?= $menuItem["label"] ?>
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu">
			<?php foreach ($menuItem["items"] as $identifier => $submenuItem): ?>
				<?php if ($identifier == "divider"): ?>
				<li class="divider"></li>
				<?php else: ?>
				<li>
					<a href="<?= $this->link(["_controller" => $submenuItem["controller"], "_action" => $submenuItem["action"], "_extension" => $submenuItem["extension"] ]) ?>">
						<?php if (isset($submenuItem["icon"])): ?>
							<i class="<?= $submenuItem["icon"] ?>"></i>
						<?php endif ?>
						<?= $submenuItem["label"] ?>
					</a>
				</li>
				<?php endif ?>
			<?php endforeach ?>
			</ul>
		</li>
	<?php else: ?>
		<li>
			<a href="#">
				<?php if (isset($menuItem["icon"])): ?>
					<i class="<?= $menuItem["icon"] ?>"></i>
				<?php endif ?>
				<?= $menuItem["label"] ?>
			</a>
		</li>
	<?php endif ?>
<?php endforeach; ?>
</ul>

<ul class="nav navbar-nav navbar-right">
<?php foreach ($secondaryMenu as $menuItem): ?>
	<?php if (isset($menuItem["items"])): ?>
		<li class="dropdown">
			<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
				<?php if (isset($menuItem["icon"])): ?>
					<i class="<?= $menuItem["icon"] ?>"></i>
				<?php endif ?>
				<?= $menuItem["label"] ?>
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu">
				<?php foreach ($menuItem["items"] as $identifier => $submenuItem): ?>
					<?php if ($identifier == "divider"): ?>
						<li class="divider"></li>
					<?php else: ?>
						<li>
							<a href="#">
								<?php if (isset($submenuItem["icon"])): ?>
									<i class="<?= $submenuItem["icon"] ?>"></i>
								<?php endif ?>
								<?= $submenuItem["label"] ?>
							</a>
						</li>
					<?php endif ?>
				<?php endforeach ?>
			</ul>
		</li>
	<?php else: ?>
		<li>
			<a href="#">
				<?php if (isset($menuItem["icon"])): ?>
					<i class="<?= $menuItem["icon"] ?>"></i>
				<?php endif ?>
				<?= $menuItem["label"] ?>
			</a>
		</li>
	<?php endif ?>
<?php endforeach; ?>
</ul>