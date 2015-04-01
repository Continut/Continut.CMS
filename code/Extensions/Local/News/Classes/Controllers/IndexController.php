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
			$page = new \Extensions\Local\News\Classes\Domain\Model\Page();
			$page = $page->findByUid(3);
			var_dump($page); die();
			/*$sth = \Core\Bootstrap::getInstance()->getDatabaseHandler()->query("SELECT * FROM sys_pages");
			$sth->setFetchMode(\PDO::FETCH_CLASS, '\\Extensions\\Local\\News\\Classes\\Domain\\Model\\Page');
			while($page = $sth->fetch()) {
				echo 'parent: ';var_dump($page->getParent());
				var_dump($page);
			}
			die();*/
		}

		public function render() {
			echo $this->test;
		}
	}
}