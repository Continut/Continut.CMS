<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 31.05.2015 @ 22:28
 * Project: Conţinut CMS
 */
namespace Extensions\Local\News\Classes\Controllers {
	use Core\Mvc\Controller\BackendController;
	use Core\Utility;

	class NewsBackendController extends BackendController{

		public function __construct() {
			parent::__construct();
			$this->setLayoutTemplate(Utility::getResource("Default", "Backend", "Backend", "Layout"));
		}

		public function indexAction() {
			$grid = Utility::createInstance("\\Extensions\\System\\Backend\\Classes\\View\\GridView");

			$newsCollection = Utility::createInstance("\\Extensions\\Local\\News\\Classes\\Domain\\Collection\\NewsCollection");

			$grid
				->setFormAction(Utility::helper("Url")->linkToAction("News", "NewsBackend", "index"))
				->setTemplate(Utility::getResource("Grid/gridView", "News", "Backend", "Template"))
				->setCollection($newsCollection)
				->setPager(10, 0)
				->setFields(
					[
						"photo" => [
							"label"    => "Photo",
							"renderer" => []
						],
						"title" => [
							"label"    => "Title",
							"css"      => "col-sm-3",
							"renderer" => [
								"parameters" => ["crop" => 200, "cropAppend" => "...", "removeHtml" => TRUE]
							],
							"filter"   => [
								"class" => "\\Extensions\\System\\Backend\\Classes\\View\\Filter\\TextFilter"
							]
						],
						"description" => [
							"label"    => "Description",
							"css"      => "col-sm-3",
							"renderer" => [
								"parameters" => ["crop" => 400, "cropAppend" => "...", "removeHtml" => TRUE]
							],
							"filter"   => [
								"class" => "\\Extensions\\System\\Backend\\Classes\\View\\Filter\\TextFilter"
							]
						],
						"is_visible" => [
							"label"    => "Is visible",
							"css"      => "col-sm-1",
							"renderer" => [],
							"filter"   => [
								"class"  => "\\Extensions\\System\\Backend\\Classes\\View\\Filter\\SelectFilter",
								"values" => ["" => "", "0" => "Hidden", "1" => "Is visible"]
							]
						]
					]
			);

			$this->getView()->assign("grid", $grid);
		}
	}

}
