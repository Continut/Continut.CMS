<?php
$templates = \Continut\Core\Utility::getExtensionSettings('News')['elements']['plugin']['news']['templates'];
?>
<blockquote>
    <p><i class="fa fa-fw fa-newspaper-o"></i> <?= $this->__('backend.news.pluginInfo') ?></p>
    <footer><a href=""><?= $this->__('backend.news.pluginManual') ?></a></footer>
</blockquote>
<div class="form-group">
    <?= $this->helper('Form')->textField('title', $this->__('backend.wizard.title'), $this->valueOrDefault('title', '')) ?>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?= $this->helper('Form')->textField('limit', $this->__('backend.news.wizard.show.limit'), $this->valueOrDefault('limit', 3)) ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'order',
                $this->__('backend.news.wizard.show.order'),
                [
                    'title'      => $this->__('backend.news.wizard.show.order.title'),
                    'created_at' => $this->__('backend.news.wizard.show.order.createdAt'),
                ],
                $this->valueOrDefault('order', 'created_at')
            )
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'direction',
                $this->__('backend.news.wizard.show.direction'),
                [
                    'asc'  => $this->__('general.ascending'),
                    'desc' => $this->__('general.descending'),
                ],
                $this->valueOrDefault('direction', 'desc')
            )
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'template',
                $this->__('backend.news.wizard.show.template'),
                $templates,
                $this->valueOrDefault('template', '')
            )
            ?>
        </div>
    </div>
</div>