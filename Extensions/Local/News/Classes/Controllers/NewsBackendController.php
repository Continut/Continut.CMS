<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 31.05.2015 @ 22:28
 * Project: Conţinut CMS
 */
namespace Continut\Extensions\Local\News\Classes\Controllers {

	use Continut\Core\Mvc\Controller\BackendController;
	use Continut\Core\Utility;

	class NewsBackendController extends BackendController{

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
		}

		public function indexAction() {
			$grid = Utility::createInstance('Continut\Extensions\System\Backend\Classes\View\GridView');

			$grid
				->setFormAction(Utility::helper("Url")->linkToAction("News", "NewsBackend", "index"))
				->setTemplate(Utility::getResource("Grid/gridView", "Backend", "Backend", "Template"))
				->setCollection(Utility::createInstance('Continut\Extensions\Local\News\Classes\Domain\Collection\NewsCollection'))
				->setPager(10, Utility::getRequest()->getArgument("page", 1))
				->setFields(
					[
						"photo" => [
							"label"    => "backend.news.grid.field.photo",
							"renderer" => [
								"class" => "Continut\\Extensions\\Local\\News\\Classes\\View\\Renderer\\PhotoRenderer"
							]
						],
						"title" => [
							"label"    => "backend.news.grid.field.title",
							"css"      => "col-sm-3",
							"renderer" => [
								"parameters" => ["crop" => 200, "cropAppend" => "...", "removeHtml" => TRUE]
							],
							"filter"   => [
								"class" => "Continut\\Extensions\\System\\Backend\\Classes\\View\\Filter\\TextFilter"
							]
						],
						"description" => [
							"label"    => "backend.news.grid.field.description",
							"css"      => "col-sm-3",
							"renderer" => [
								"parameters" => ["crop" => 300, "cropAppend" => "...", "removeHtml" => TRUE]
							],
							"filter"   => [
								"class" => "Continut\\Extensions\\System\\Backend\\Classes\\View\\Filter\\TextFilter"
							]
						],
						"is_visible" => [
							"label"    => "backend.news.grid.field.isVisible",
							"css"      => "col-sm-1",
							"renderer" => [
								"class" => "Continut\\Extensions\\Local\\News\\Classes\\View\\Renderer\\IsVisibleRenderer"
							],
							"filter"   => [
								"class"  => "Continut\\Extensions\\System\\Backend\\Classes\\View\\Filter\\SelectFilter",
								"values" => ["" => "", "0" => "Hidden", "1" => "Is visible"]
							]
						]
					]
				)
				->initialize();

			$this->getView()->assign("grid", $grid);
		}
	}

}
