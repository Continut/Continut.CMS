<blockquote>
    <p><i class="fa fa-fw fa-info"></i> <?= $this->__('backend.wizard.containers.info', ['count' => '4']) ?></p>
    <footer><?= $this->__('backend.wizard.containers.info.footer') ?></footer>
</blockquote>
<div class="form-group">
    <?= $this->helper('Form')->textField(
            'title',
            $this->__('backend.wizard.title'),
            $this->valueOrDefault('title', '')
        ) ?>
</div>
<div class="form-group">
    <?= $this->helper('Form')->selectField(
            'formatColumns',
            $this->__('backend.wizard.containers.spaceUsage'),
            [
                '1' => $this->__('backend.wizard.containers.usage.4_1')
            ],
            $this->valueOrDefault('formatColumns', 1)
        ) ?>
</div>