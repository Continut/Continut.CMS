<p class="text-center">
    <?php if ($this->getRecord()->getImages()->count() > 0): ?>
        <img
            src="<?= $this->helper('Image')->resize($this->getRecord()->getImages()->getFirst()->getRelativePath(), 100, 100, 'news') ?>"
            alt=""/>
    <?php endif ?>
</p>