<p><?= $this->helper('Text')->truncate($this->helper('Text')->stripTags($this->valueOrDefault('content', '')), 500) ?></p>
<?php if ($image): ?>
    <img class="img-responsive img-centered" src="<?= $this->helper('Image')->resize($image, $this->valueOrDefault('width', 800), $this->valueOrDefault('height', null), 'backend') ?>" alt=""/>
<?php endif; ?>