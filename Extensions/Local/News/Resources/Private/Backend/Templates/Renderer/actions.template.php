<?php if ($this->getParameter('showEdit')): ?>
<a title="<?= $this->__('general.edit') ?>" class="btn btn-warning" href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_extension' => 'News', '_controller' => 'NewsBackend', '_action' => 'editNews', 'id' => $this->getRecord()->getId()]) ?>"><i class="fa fa-icon fa-pencil"></i></a>
<?php endif; ?>
<?php if ($this->getParameter('showDelete')): ?>
<a title="<?= $this->__('general.delete') ?>" class="btn btn-danger" href="<?= $this->helper('Url')->linkToPath('admin_backend', ['_extension' => 'News', '_controller' => 'NewsBackend', '_action' => 'deleteNews', 'id' => $this->getRecord()->getId()]) ?>"><i class="fa fa-icon fa-trash"></i></a>
<?php endif; ?>