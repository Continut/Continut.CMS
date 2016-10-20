<?php if ($this->getParameter('showEdit')): ?>
<a class="btn btn-warning"><i class="fa fa-icon fa-pencil"></i> <?= $this->__('general.edit') ?></a>
<?php endif; ?>
<?php if ($this->getParameter('showDelete')): ?>
<a class="btn btn-danger"><i class="fa fa-icon fa-pencil"></i> <?= $this->__('general.delete') ?></a>
<?php endif; ?>