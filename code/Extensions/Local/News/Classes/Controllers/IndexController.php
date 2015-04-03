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
			$this->getView()->assignMultiple(["firstname" => "Gringo", "lastname" => "Deluxe"]);
			$this->getView()->assign("country", "Romania");
			$this->templateStorage = "Resources/Private";
			$this->getView()->setTemplate(__ROOTCMS__ . DS . "Extensions" . DS . $this->getExtensionType() . DS . $this->getExtension() . DS . $this->templateStorage . DS ."Frontend/Templates/Index" . DS . "Index.template.php");
		}

		public function showAction() {
			$page = new \Extensions\Local\News\Classes\Domain\Model\Page();
			$page = $page->findByUid(2);
			var_dump($page); die();
		}
	}
}