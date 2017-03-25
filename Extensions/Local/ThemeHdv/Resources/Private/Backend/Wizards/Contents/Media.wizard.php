<?= $this->helper('Form')->rteField('content', $this->__('backend.wizard.media.content'), $this->valueOrDefault('content', '')) ?>
<?= $this->helper('Form')->mediaField('image', $this->__('backend.wizard.image'), $this->valueOrDefault('image', null)) ?>
