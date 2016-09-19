<?php if ($this->getRecord()->fetchFromField($this->getField()->getName())): ?>
    <span class="fa fa-icon fa-check" style="color: green"></span> <?= $this->__("general.yes") ?>
<?php else: ?>
    <span class="fa fa-icon fa-close" style="color: red"></span> <?= $this->__("general.no") ?>
<?php endif ?>
