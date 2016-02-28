<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 19:12
 * Project: Conţinut CMS
 */
namespace Continut\Core\Mvc\View {

	use Continut\Core\Utility;

	class PageView extends BaseView {
		/**
		 * @var \Continut\Core\Mvc\View\BaseLayout Layout used by this page
		 */
		protected $layout;

		/**
		 * @var array List of Css/JavaScript assets to include
		 */
		protected $assets;

		/**
		 * @var string Page title
		 */
		protected $title;

		/**
		 * @var \Continut\Core\System\Domain\Model\Page
		 */
		protected $pageModel;

		/**
		 * @var string Wrapper template to use for the page (doctype, etc)
		 */
		protected $wrapperTemplate = 'Extensions/System/Frontend/Resources/Private/Frontend/Wrappers/Html5';

		/**
		 * @param \Continut\Core\Mvc\View\BaseLayout $layout Set page layout
		 *
		 * @return $this
		 */
		public function setLayout($layout) {
			$this->layout = $layout;
			$this->layout->setPage($this);

			return $this;
		}

		/**
		 * @param string $template
		 *
		 * @return $this
		 *
		 * @throws \Continut\Core\Tools\Exception
		 */
		public function setLayoutFromTemplate($template) {
			$this->layout = Utility::createInstance('Continut\Core\System\View\FrontendLayout');
			$this->layout
				->setPage($this)
				->setTemplate($template);

			return $this;
		}

		/**
		 * @return BaseLayout
		 */
		public function getLayout() {
			return $this->layout;
		}

		/**
		 * @return \Continut\Core\System\Domain\Model\Page
		 */
		public function getPageModel()
		{
			return $this->pageModel;
		}

		/**
		 * @param \Continut\Core\System\Domain\Model\Page $pageModel
		 *
		 * @return $this
		 */
		public function setPageModel($pageModel)
		{
			$this->pageModel = $pageModel;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getWrapperTemplate()
		{
			return $this->wrapperTemplate;
		}

		/**
		 * @param string $wrapperTemplate
		 *
		 * return $this
		 */
		public function setWrapperTemplate($wrapperTemplate)
		{
			$this->wrapperTemplate = $wrapperTemplate;

			return $this;
		}

		/**
		 * Generates the final output of the page
		 *
		 * @return string
		 *
		 * @throws \Continut\Core\Tools\ErrorException
		 */
		public function render() {
			$debugPath = str_replace(__ROOTCMS__, "", $this->layout->getTemplate());
			Utility::debugData("Layout rendered " . $debugPath, "start");
			Utility::debugData("Layout used: " . $debugPath, "message");
			$pageContent = $this->getLayout()->render();
			Utility::debugData("Layout rendered " . $debugPath, "stop");

			$pageHeader  = $this->renderHeader();
			$pageTitle   = $this->getTitle();
			$url         = $_SERVER["HTTP_HOST"];
			if (Utility::getApplicationScope() == Utility::SCOPE_FRONTEND) {
				$url = Utility::getSite()->getUrl();
			}

			// if the debuger is enabled, show debug data
			if (Utility::getConfiguration("System/Debug/Enabled")) {
				$pageContent .= Utility::debug()
					->getJavascriptRenderer()
					->setBaseUrl("Lib/DebugBar/Resources")
					->setEnableJqueryNoConflict(TRUE)
					->render();
				$pageHeader .= Utility::debug()
					->getJavascriptRenderer()
					->renderHead();
			}

			$this->setTemplate(__ROOTCMS__ . DS . $this->wrapperTemplate . '.wrapper.php')
				->assignMultiple(
				[
					"pageTitle"   => $pageTitle,
					"pageHeader"  => $pageHeader,
					"url"         => $url,
					"pageContent" => $pageContent,
					"pageModel"   => $this->getPageModel()
				]
			);

			return parent::render();
		}

		/**
		 * Renders the header assets (javascript and css files to include)
		 *
		 * @return string
		 */
		public function renderHeader() {
			$header = "";

			if ($this->assets) {
				foreach ($this->assets as $assetType => $assetValues) {
					foreach ($assetValues as $asset) {
						$header .= "\t" . $asset . "\n";
					}
				}
			}

			return $header;
		}

		/**
		 * @return array
		 */
		public function getAssets() {
			return $this->assets;
		}

		/**
		 * Add Javascript asset
		 *
		 * @param $configuration
		 *
		 * @return $this
		 */
		public function addJsAsset($configuration) {
			$this->addAsset($configuration, "JavaScript");

			return $this;
		}

		/**
		 * Add Css asset
		 *
		 * @param array $configuration Configuration array with asset details
		 *
		 * @return $this
		 */
		public function addCssAsset($configuration) {
			$this->addAsset($configuration, "Css");

			return $this;
		}

		/**
		 * Add an asset by type. Currently only supports Css and Javascript files
		 *
		 * @param $configuration
		 * @param $type
		 *
		 */
		protected function addAsset($configuration, $type) {
			if (isset($configuration["external"]) && $configuration["external"] == TRUE) {
				$filePath = $configuration["file"];
			} else {
				$filePath = Utility::getAssetPath($type . "/" . $configuration["file"], $configuration["extension"]);
			}

			$id = $configuration["identifier"];

			if ($type == "Css") {
				$this->assets[$type][$id] = '<link rel="stylesheet" type="text/css" href="' . $filePath . '" />';
			}
			if ($type == "JavaScript") {
				$this->assets[$type][$id] = '<script type="text/javascript" src="' . $filePath . '"></script>';
			}

			if (isset($configuration["before"])) {
				$this->assets[$type] = Utility::arrayInsertBefore(
					$this->assets[$type],
					$configuration["before"],
					$id,
					$this->assets[$type][$id]
				);
			}
		}

		/**
		 * @return string
		 */
		public function getTitle() {
			return $this->title;
		}

		/**
		 * @param string $title Set page title
		 *
		 * @return $this
		 */
		public function setTitle($title) {
			$this->title = $title;

			return $this;
		}
	}

}
