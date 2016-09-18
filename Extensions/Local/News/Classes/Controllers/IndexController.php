<?php

namespace Continut\Extensions\Local\News\Classes\Controllers {

	use Continut\Core\Mvc\Controller\FrontendController;
	use Continut\Core\Utility;

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
			$newsCollection = Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Collection\NewsCollection');

			$limit = (isset($this->data["limit"])) ? $this->data["limit"] : 1;
			$ordering = "";
			if (isset($this->data["order"])) {
				$order = $this->data["order"];
			}
			if (isset($this->data["direction"])) {
				$direction = $this->data["direction"];
			}
			if ($order && $direction) {
				$ordering = " ORDER BY $order $direction";
			}
			$newsCollection->where("1=1 $ordering LIMIT $limit");

			if (isset($this->data["template"])) {
				$this->getView()->setTemplate($this->data["template"]);
			}

			$this->getView()->assign('news', $newsCollection);
			$this->getView()->assign('data', $this->data);
		}

	}
}