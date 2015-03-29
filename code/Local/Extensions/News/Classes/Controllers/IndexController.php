<?php

namespace Local\Extensions\News\Classes\Controllers {
	use \Core\Controller\FrontendController;

	class IndexController extends FrontendController {
		protected $test;

		public function indexAction() {
			$this->templateStorage = "Index";
			include "/var/www/cms/code/Local/Extensions/News/Resources/Private/Templates/".$this->templateStorage."/Index.template.php";
			$this->test = ob_get_contents();
		}

		public function render() {
			echo $this->test;
		}
	}
}