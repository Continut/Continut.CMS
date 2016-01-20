<ul>
	<?php foreach ($news->getAll() as $newsItem): ?>
		<div class="media">
			<div class="media-left">
				<?php if ($newsItem->getImages()->count() > 0): ?>
					<img src="<?= $this->helper('Image')->resize($newsItem->getImages()->getFirst()->getRelativePath(), 100, 100, 'news') ?>" alt="" />
				<?php endif ?>
			</div>
			<div class="media-body">
				<p><strong><?= $this->helper("String")->truncate($this->helper("String")->stripTags($newsItem->getTitle()), 100) ?></strong></p>
				<p><?= $this->helper("String")->truncate($this->helper("String")->stripTags($newsItem->getDescription()), 100) ?></p>
			</div>
		</div>
	<?php endforeach ?>
</ul>