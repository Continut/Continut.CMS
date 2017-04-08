<form action="<?= $this->helper('Url')->linkToPath('admin', ['_extension' => 'News', '_controller' => 'NewsBackend', '_action' => 'saveNews']) ?>" method="post">
    <div class="row">
        <div class="col-sm-12 col-md-9 col-lg-8">
            <h2>Create new article</h2>
                <?php if ($news->getId()): ?>
                    <?= $this->helper('FormObject')->hiddenField($news, 'id') ?>
                <?php endif; ?>
                <?= $this->helper('FormObject')->rteField($news, 'title', 'Title', $news->getTitle(), '60px'); ?>
                <?= $this->helper('FormObject')->selectField($news, 'author', 'Author', $authors->toSelect('id', 'username')); ?>
                <div class="form-group">
                    <label for="description" class="control-label">Content</label>
                    <div class="panel page-panel">
                        <div class="panel-heading">
                            News content
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-4">
            <h3>Additional fields</h3>
            <p>@TODO: Images, etc...</p>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary"
               value="<?= $this->__('general.save') ?>"/>
        <a href="<?= $this->helper('Url')->linkToPath('admin', ['_extension' => 'News', '_controller' => 'NewsBackend', '_action' => 'index']) ?>"
           class="close-button btn btn-danger pull-right"><?= $this->__('general.cancel') ?></a>
    </div>
</form>