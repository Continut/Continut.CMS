<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 19:12
 * Project: Conţinut CMS
 */
namespace Core\Mvc\View {
	use Core\Utility;

	class PageView {
		/**
		 * @var \Core\Mvc\View\BaseLayout Layout used by this page
		 */
		protected $_layout;

		/**
		 * @var array List of Css/JavaScript assets to include
		 */
		protected $_assets;

		/**
		 * @var string Page title
		 */
		protected $_title;

		/**
		 * @param \Core\Mvc\View\BaseLayout $layout Set page layout
		 *
		 * @return $this
		 */
		public function setLayout($layout) {
			$this->_layout = $layout;
			$this->_layout->setPage($this);

			return $this;
		}

		public function setLayoutFromTemplate($template) {
			$this->_layout = Utility::createInstance("\\Core\\System\\View\\FrontendLayout");
			$this->_layout
				->setPage($this)
				->setTemplate($template);
		}

		public function getLayout() {
			return $this->_layout;
		}

		public function render() {
			Utility::debugData("layout_rendering", "start", "Layout rendering");
			Utility::debugData("Layout used: " . str_replace(__ROOTCMS__, "", $this->_layout->getTemplate()), "message");
			$pageContent = $this->_layout->render();
			Utility::debugData("layout_rendering", "stop");
			$pageHeader  = $this->renderHeader();
			$pageTitle   = $this->getTitle();

			// if the debuger is enabled, show debug data
			if (Utility::getConfiguration("System/Debug/Enabled")) {
				$pageContent .= Utility::debug()
					->getJavascriptRenderer()
					->setBaseUrl('Extensions/System/Debug/DebugBar/Resources')
					->setEnableJqueryNoConflict(TRUE)
					->render();
				$pageHeader .= Utility::debug()
					->getJavascriptRenderer()
					->renderHead();
			}

			$main = <<<HER
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<base href="http://cms.local/">
		<title>$pageTitle</title>
		$pageHeader
	</head>
	<body>
		$pageContent
	</body>
</html>
HER;

			return $main;
		}

		public function renderHeader() {
			$header = "";

			if ($this->_assets) {
				foreach ($this->_assets as $assetType => $assetValues) {
					foreach ($assetValues as $asset) {
						$header .= $asset . "\n";
					}
				}
			}

			return $header;
		}

		public function getAssets() {
			return $this->_assets;
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
				$this->_assets[$type][$id] = '<link rel="stylesheet" type="text/css" href="' . $filePath . '" />';
			}
			if ($type == "JavaScript") {
				$this->_assets[$type][$id] = '<script type="text/javascript" src="' . $filePath . '"></script>';
			}

			if (isset($configuration["before"])) {
				$this->_assets[$type] = Utility::arrayInsertBefore(
					$this->_assets[$type],
					$configuration["before"],
					$id,
					$this->_assets[$type][$id]
				);
			}
		}

		/**
		 * @return string
		 */
		public function getTitle() {
			return $this->_title;
		}

		/**
		 * @param string $title Set page title
		 */
		public function setTitle($title) {
			$this->_title = $title;
		}
	}

}
