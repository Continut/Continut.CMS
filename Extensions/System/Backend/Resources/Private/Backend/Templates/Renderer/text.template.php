<?php

$text = $this->getRecord()->fetchFromField($this->getField()->getName());

if (isset($this->getParameters()['crop'])) {
    $cropLength = $this->getParameters()['crop'];
    $cropAppend = '';
    if ($this->getParameters()['cropAppend']) {
        $cropAppend = $this->getParameters()['cropAppend'];
    }
    $text = \Continut\Core\Utility::helper('Text')->truncate(\Continut\Core\Utility::helper('Text')->stripTags($text), $cropLength, $cropAppend);
}

if (isset($this->getParameters()['fromValues']) && $this->getParameters()['fromField']) {
    $values = $this->getParameters()['fromValues'];
    $currentValue = $text;
    foreach ($values as $value) {
        if ($value->getId() == $currentValue) {
            $text = $value->fetchFromField($this->getParameters()['fromField']);
        }
    }
}
?>
<?= $text ?>