<?php

namespace Extensions\Local\News\Classes\Controllers {
	use \Core\Mvc\Controller\FrontendController;

	class IndexController extends FrontendController {
		protected $test;

		public function __construct() {
			parent::__construct();
			$this->setExtension('News', 'Local');
		}

		public function indexAction() {
			$this->templateStorage = "Index";
			include "/var/www/cms/code/Extensions/Local/News/Resources/Private/Templates/".$this->templateStorage."/Index.template.php";
			$this->test = ob_get_contents();
		}

		public function showAction() {
			$page = new \Extensions\Local\News\Classes\Domain\Model\Page();
			$page = $page->findByUid(2);
			var_dump($page); die();
		}

		public function render() {
			echo $this->test;
		}
	}
}