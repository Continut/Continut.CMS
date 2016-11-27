<div class="row">
    <div class="col-sm-12 <?= $class ?>">
        <?= $this->helper('Text')->truncate($this->helper('Text')->stripTags($content), 300) ?>
    </div>
</div>