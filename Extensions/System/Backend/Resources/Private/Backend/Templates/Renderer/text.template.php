<?php
if ($this->getParameters()["crop"]) {
	$cropLength = $this->getParameters()["crop"];
	$cropAppend = "";
	if ($this->getParameters()["cropAppend"]) {
		$cropAppend = $this->getParameters()["cropAppend"];
	}
	$text = \Core\Utility::helper("String")->truncate(\Core\Utility::helper("String")->stripTags($this->getRecord()->fetchFromField($this->getField()->getName())), $cropLength, $cropAppend);
} else {
	$text = $this->getRecord()->fetchFromField($this->getField()->getName());
}
?>
<?= $text ?>