<?= $this->valueOrDefault('content', '') ?>
<?php if ($image): ?>
<img class="img-responsive img-centered" src="<?= $this->helper('Image')->resize($image, $this->valueOrDefault('width', 800), $this->valueOrDefault('height', null), 'backend') ?>" alt=""/>
<?php endif; ?>