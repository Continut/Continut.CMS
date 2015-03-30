<?php

namespace Extensions\Local\News\Classes\Controllers {
	use \Core\Mvc\Controller\FrontendController;

	class IndexController extends FrontendController {
		protected $test;

		public function indexAction() {
			$this->templateStorage = "Index";
			include "/var/www/cms/code/Extensions/Local/News/Resources/Private/Templates/".$this->templateStorage."/Index.template.php";
			$this->test = ob_get_contents();
		}

		public function showAction() {
			$this->test = "I am being called from somewhere else";
		}

		public function render() {
			echo $this->test;
		}
	}
}