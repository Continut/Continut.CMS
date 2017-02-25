<?php
$title = (!isset($title)) ? "" : $title;
$template = (!isset($template)) ? "" : $template;
$limit = (!isset($limit)) ? 3 : $limit;
$order = (!isset($order)) ? "crdate" : $order;
$direction = (!isset($direction)) ? "desc" : $direction;
$templates = \Continut\Core\Utility::getExtensionSettings('News')['elements']['plugin']['news']['templates'];
?>
<blockquote>
    <p><i class="fa fa-fw fa-newspaper-o"></i> <?= $this->__('backend.news.pluginInfo') ?></p>
    <footer><a href=""><?= $this->__('backend.news.pluginManual') ?></a></footer>
</blockquote>
<div class="form-group">
    <?= $this->helper('Form')->textField('title', $this->__('backend.wizard.title'), $title) ?>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <?= $this->helper('Form')->textField('limit', 'How many news to show', $limit) ?>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'order',
                'Order by',
                [
                    'title' => 'Title',
                    'created_at' => 'Creation date',
                ],
                $order
            )
            ?>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'direction',
                'Order direction',
                [
                    'asc'  => 'Ascending',
                    'desc' => 'Descending',
                ],
                $direction
            )
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'template',
                'Template',
                $templates,
                $template
            )
            ?>
        </div>
    </div>
</div>