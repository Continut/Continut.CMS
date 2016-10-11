<?php
$this->getPageView()
    ->addCssAsset(["identifier" => "fontawesome", "extension" => "Backend", "file" => "fontawesome/font-awesome.css"])
    ->addCssAsset(["identifier" => "jstree", "extension" => "Editor", "file" => "jstree/themes/continutfe/style.css"])
    ->addCssAsset(["identifier" => "selectize", "extension" => "Editor", "file" => "selectize/selectize.continut.css"])
    ->addCssAsset(["identifier" => "local", "extension" => "Editor", "file" => "continutfe.css"])
    ->addJsAsset(["identifier" => "jquery", "extension" => "Editor", "file" => "jquery-3.1.0.min.js"])
    ->addJsAsset(["identifier" => "selectize", "extension" => "Editor", "file" => "selectize-0.12.3.js"])
    ->addJsAsset(["identifier" => "angular", "extension" => "Editor", "file" => "angular/modules/angular.js"])
    ->addJsAsset(["identifier" => "angular-route", "extension" => "Editor", "file" => "angular/modules/angular-route.js"])
    ->addJsAsset(["identifier" => "jstree", "extension" => "Editor", "file" => "jstree.js"])
    ->addJsAsset(["identifier" => "ngJsTree", "extension" => "Editor", "file" => "angular/modules/ngJsTree.js"])
    ->addJsAsset(["identifier" => "angular.app", "extension" => "Editor", "file" => "angular/app.js"])
    ->addJsAsset(["identifier" => "angular.cms.editor", "extension" => "Editor", "file" => "angular/cms/editor.js"]);
    //->addJsAsset(["identifier" => "local", "extension" => "Editor", "file" => "main.js"]);
?>
<div ng-app="continut.app">
    <div ng-view></div>
</div>