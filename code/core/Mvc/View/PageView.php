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

		public function getLayout() {
			return $this->_layout;
		}

		public function render() {
			$pageContent = $this->_layout->render();
			$pageHeader  = $this->_renderHeader();
			$pageTitle   = $this->getTitle();

			$main = <<<HER
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

		protected function _renderHeader() {
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
			$id = $configuration["identifier"];
			$assetPath = '<script type="text/javascript" src="' . Utility::getAssetPath($configuration["file"], $configuration["extension"], "JavaScript") . '"></script>';

			if (isset($configuration["before"])) {
				$this->_assets["js"] = Utility::arrayInsertBefore($this->_assets["js"], $configuration["before"], $id, $assetPath);
			} else {
				$this->_assets["js"][$id] = $assetPath;
			}

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
			$this->_assets["css"][$configuration["identifier"]] = '<link rel="stylesheet" type="text/css" href="' . Utility::getAssetPath($configuration["file"], $configuration["extension"], "Css") . '" />';

			return $this;
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
