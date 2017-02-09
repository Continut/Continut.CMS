<?php if ($this->getParameter('showEdit')): ?>
<a title="<?= $this->__('general.edit') ?>" class="btn btn-warning"><i class="fa fa-icon fa-pencil"></i></a>
<?php endif; ?>
<?php if ($this->getParameter('showDelete')): ?>
<a title="<?= $this->__('general.delete') ?>" class="btn btn-danger"><i class="fa fa-icon fa-trash"></i></a>
<?php endif; ?>