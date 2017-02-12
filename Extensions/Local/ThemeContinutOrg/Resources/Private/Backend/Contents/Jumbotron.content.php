<div class="row">
    <div class="col-sm-12 <?= $this->valueOrDefault('class', '') ?>">
        <?= $this->helper('Text')->truncate($this->helper('Text')->stripTags($this->valueOrDefault('content', '')), 300) ?>
    </div>
</div>