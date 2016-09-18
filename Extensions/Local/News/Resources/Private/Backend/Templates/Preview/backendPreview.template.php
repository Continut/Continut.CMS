<?php if (isset($data["limit"])): ?>
	<p><?= $this->__("backend.news.preview.lastXArticles", ["limit" => $data["limit"]]) ?></p>
<?php endif ?>
<?php foreach ($news->getAll() as $newsItem): ?>
<div class="media">
	<div class="media-left">
		<a href="#">
			<?php if ($newsItem->getImages()->count() > 0): ?>
				<img src="<?= $this->helper('Image')->resize($newsItem->getImages()->getFirst()->getRelativePath(), 50, 50, 'news') ?>" alt="" />
			<?php endif ?>
		</a>
	</div>
	<div class="media-body">
		<p><strong><?= $this->helper("Text")->truncate($this->helper("Text")->stripTags($newsItem->getTitle()), 100) ?></strong></p>
		<p><?= $this->helper("Text")->truncate($this->helper("Text")->stripTags($newsItem->getDescription()), 100) ?></p>
	</div>
</div>
<?php endforeach ?>