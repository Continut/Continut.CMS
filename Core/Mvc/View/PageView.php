<?php
/**
 * This file is part of the Conţinut CMS project.
 * Distributed under the GNU General Public License.
 * For more details, consult the LICENSE.txt file supplied with the project
 * Author: Radu Mogoş <radu.mogos@pixelplant.ch>
 * Date: 03.04.2015 @ 19:12
 * Project: Conţinut CMS
 */

namespace Continut\Core\Mvc\View;

use Continut\Core\Utility;

class PageView extends BaseView
{
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
     * @var string Class or classes to be applied to the body tag
     */
    protected $bodyClass;

    /**
     * @var string Wrapper template to use for the page (doctype, etc)
     */
    protected $wrapperTemplate = 'Extensions/System/Frontend/Resources/Private/Frontend/Wrappers/Html5';

    /**
     * @param \Continut\Core\Mvc\View\BaseLayout $layout Set page layout
     *
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        $this->layout->setPageView($this);

        return $this;
    }

    /**
     * @param string $template
     *
     * @return $this
     *
     * @throws \Continut\Core\Tools\Exception
     */
    public function setLayoutFromTemplate($template)
    {
        $this->layout = Utility::createInstance('Continut\Core\System\View\FrontendLayout');
        $this->layout
            ->setPageView($this)
            ->setTemplate($template);

        return $this;
    }

    /**
     * @return BaseLayout
     */
    public function getLayout()
    {
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
     * @return $this
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
    public function render()
    {
        $debugPath = str_replace(__ROOTCMS__, "", $this->layout->getTemplate());
        Utility::debugData('Layout rendered ' . $debugPath, 'start');
        Utility::debugData('Layout used: ' . $debugPath, 'message');
        $pageContent = $this->getLayout()->render();
        Utility::debugData('Layout rendered ' . $debugPath, 'stop');

        $pageHead  = $this->renderHead();
        $bodyClass = $this->getBodyClass();
        $pageTitle = $this->getTitle();
        $url = $_SERVER['HTTP_HOST'];
        if (Utility::getApplicationScope() == Utility::SCOPE_FRONTEND) {
            $url = Utility::getSite()->getUrl();
        }

        // if the debuger is enabled, show debug data
        if (Utility::getConfiguration('System/Debug/Enabled')) {
            $pageContent .= Utility::debug()
                ->getJavascriptRenderer()
                ->setBaseUrl('Lib/DebugBar/Resources')
                ->setEnableJqueryNoConflict(TRUE)
                ->render();
            $pageHead .= Utility::debug()
                ->getJavascriptRenderer()
                ->renderHead();
        }

        $this->setTemplate(__ROOTCMS__ . DS . $this->wrapperTemplate . '.wrapper.php')
            ->assignMultiple(
                [
                    'url'         => $url,
                    'pageTitle'   => $pageTitle,
                    'pageHead'    => $pageHead,
                    'bodyClass'   => $bodyClass,
                    'pageContent' => $pageContent,
                    'pageModel'   => $this->getPageModel()
                ]
            );

        return parent::render();
    }

    /**
     * Renders the header assets (javascript and css files to include)
     *
     * @return string
     */
    public function renderHead()
    {
        $header = '';

        if ($this->assets) {
            foreach ($this->assets as $assetType => $assets) {
                foreach ($assets as $identifier => $configuration) {

                    if (isset($configuration['before'])) {
                        $this->assets[$assetType] = Utility::arrayMoveBefore(
                            $this->assets[$assetType],
                            $configuration['before'],
                            $identifier,
                            $this->assets[$assetType][$identifier]
                        );
                    }

                    if (isset($configuration['after'])) {
                        $this->assets[$assetType] = Utility::arrayMoveAfter(
                            $this->assets[$assetType],
                            $configuration['after'],
                            $identifier,
                            $this->assets[$assetType][$identifier]
                        );
                    }
                }
            }
            // if in Production and Frontend, merge all css/js files
            // for the Backend we do not merge them, even in production
            // @TODO : needs improvement and refactoring
            if (Utility::getApplicationEnvironment() == 'Production' && Utility::getApplicationScope() == 'Frontend') {
                $cssFile = '';
                $jsFile  = '';
                foreach ($this->assets as $assetType => $assets) {
                    foreach ($assets as $identifier => $configuration) {
                        if ($assetType == 'Css') {
                            $cssFile .= '_' . $identifier;
                        }
                        if ($assetType == 'JavaScript') {
                            $jsFile .= '_' . $identifier;
                        }
                    }
                }

                if ($cssFile) {
                    $cssFile = md5($cssFile) . '.css';
                    $cachedCssFile = __ROOTCMS__ . DS . 'Cache' . DS . 'Assets' . DS . 'Css' . DS . $cssFile;
                    if (!file_exists($cachedCssFile)) {
                        $mergedCssCode = '';
                        foreach ($this->assets['Css'] as $identifier => $configuration) {
                            if (isset($configuration['external']) && $configuration['external'] == true) {
                                $header .= "\t" . '<link rel="stylesheet" type="text/css" href="' . $configuration['file'] . '" />' . "\n";
                            } else {
                                $absoluteFilePath = __ROOTCMS__ . DS . Utility::getAssetPath('Css' . DS . $configuration['file'], $configuration['extension']);
                                if (file_exists($absoluteFilePath)) {
                                    $localCode =  file_get_contents($absoluteFilePath);
                                    // check if any relative assets are used, get their absolute paths and then copy them
                                    // to the Cache folder
                                    if (preg_match_all('/url\s*\(\s*[\'"]([^\'"]+)[\'"]\s*\)/', $localCode, $matches)) {
                                        $cssAssets = $matches[1];
                                        foreach ($cssAssets as $cssAsset) {
                                            $relativeCssAsset = str_replace('../', '', $cssAsset);
                                            /*if (strpos($cssAsset, '?')) {
                                                $cssAsset = substr($cssAsset, 0, strpos($cssAsset, '?'));
                                            }*/
                                            /*if (strpos($cssAsset, '?#')) {
                                                $cssAsset = substr($cssAsset, 0, strpos($cssAsset, '?#'));
                                            }*/
                                            $localCode = str_replace($cssAsset, DS . Utility::getAssetPath($relativeCssAsset, $configuration['extension']), $localCode);
                                        }
                                    }
                                    $mergedCssCode .= $localCode;
                                }
                            }
                        }
                        $f = fopen($cachedCssFile, 'w');
                        fwrite($f, $mergedCssCode);
                        fclose($f);
                    }
                    if (!file_exists(__ROOTCMS__ . DS . 'Cache' . DS . 'Assets' . DS . 'Css')){
                        mkdir(__ROOTCMS__ . DS . 'Cache' . DS . 'Assets' . DS . 'Css');
                    }
                    $header .= '<link rel="stylesheet" type="text/css" href="Cache/Assets/Css/' . $cssFile . '" />' . "\n";
                }

                if ($jsFile) {
                    $jsFile = md5($jsFile) . '.js';
                    $cachedJsFile = __ROOTCMS__ . DS . 'Cache' . DS . 'Assets' . DS . 'JavaScript' . DS .  $jsFile;
                    if (!file_exists($cachedJsFile)) {
                        $mergedJsCode = '';
                        foreach ($this->assets['JavaScript'] as $identifier => $configuration) {
                            $absoluteFilePath = __ROOTCMS__ . DS . Utility::getAssetPath('JavaScript' . DS . $configuration['file'], $configuration['extension']);
                            if (file_exists($absoluteFilePath)) {
                                $mergedJsCode .= file_get_contents($absoluteFilePath);
                            }
                        }
                        $f = fopen($cachedJsFile, 'w');
                        fwrite($f, $mergedJsCode);
                        fclose($f);
                    }
                    if (!file_exists(__ROOTCMS__ . DS . 'Cache' . DS . 'Assets' . DS . 'JavaScript')){
                        mkdir(__ROOTCMS__ . DS . 'Cache' . DS . 'Assets' . DS . 'JavaScript');
                    }
                    $header .= "\t" . '<script type="text/javascript" src="Cache/Assets/JavaScript/' . $jsFile . '"></script>' . "\n";
                }
            // if in dev, test or other custom environment, include css/js of them separately
            } else {
                foreach ($this->assets as $assetType => $assets) {
                    foreach ($assets as $identifier => $configuration) {
                        // if it's an external css/js, just link it directly
                        if (isset($configuration['external']) && $configuration['external'] == true) {
                            $filePath = $configuration['file'];
                        } else {
                            $filePath = Utility::getAssetPath($assetType . '/' . $configuration['file'], $configuration['extension']);
                        }

                        if ($assetType == 'Css') {
                            $header .= "\t" . '<link rel="stylesheet" type="text/css" href="' . $filePath . '" />' . "\n";
                        }
                        if ($assetType == 'JavaScript') {
                            $header .= "\t" . '<script type="text/javascript" src="' . $filePath . '"></script>' . "\n";
                        }
                    }
                }
            }
        }

        return $header;
    }

    /**
     * @return array
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Add Javascript asset
     *
     * @param $configuration
     *
     * @return $this
     */
    public function addJsAsset($configuration)
    {
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
    public function addCssAsset($configuration)
    {
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
    protected function addAsset($configuration, $type)
    {
        $this->assets[$type][$configuration['identifier']] = $configuration;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title Set page title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getBodyClass()
    {
        return $this->bodyClass;
    }

    /**
     * @param string $bodyClass
     *
     * @return $this
     */
    public function setBodyClass($bodyClass)
    {
        $this->bodyClass = $bodyClass;

        return $this;
    }
}
