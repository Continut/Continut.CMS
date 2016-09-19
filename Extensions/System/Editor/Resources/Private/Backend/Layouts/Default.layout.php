<?php
$this->getPageView()
    ->addCssAsset(["identifier" => "fontawesome", "extension" => "Backend", "file" => "fontawesome/font-awesome.css"])
    ->addCssAsset(["identifier" => "jstree", "extension" => "Editor", "file" => "jstree/themes/continutfe/style.css"])
    ->addCssAsset(["identifier" => "selectize", "extension" => "Editor", "file" => "selectize/selectize.continut.css"])
    ->addCssAsset(["identifier" => "local", "extension" => "Editor", "file" => "continutfe.css"])
    ->addJsAsset(["identifier" => "jquery", "extension" => "Editor", "file" => "jquery-3.1.0.min.js"])
    ->addJsAsset(["identifier" => "jstree", "extension" => "Editor", "file" => "jstree.js"])
    ->addJsAsset(["identifier" => "selectize", "extension" => "Editor", "file" => "selectize-0.12.3.js"])
    ->addJsAsset(["identifier" => "local", "extension" => "Editor", "file" => "main.js"]);
?>
<div class="continut-cms-tools" id="continut_cms_tools">
    <header class="header" id="header">
        <div class="header-block right">
            <div class="panel">
                <div class="button inside">
                    <a href="#" id="button_toggle_nav_block_right" title="Toggle properties panel"><i class="fa fa-chevron-right cfe" aria-hidden="true"></i></a>
                </div>
                <div class="button with-text">
                    <a href=""><i class="fa fa-user cfe" aria-hidden="true"></i> Master Blaster</a>
                </div>
                <div class="button with-text">
                    <a href=""><i class="fa fa-cog cfe" aria-hidden="true"></i> Settings</a>
                </div>
            </div>
        </div>
        <div class="header-block left">
            <div class="panel">
                <div class="button inside">
                    <a href="#" id="button_toggle_nav_block_left" title="Toggle page panel"><i class="fa fa-chevron-left cfe" aria-hidden="true"></i></a>
                </div>
            </div>
            <i class="fa fa-cloud cfe" aria-hidden="true"></i> Conținut CMS <small>(1.0.0)</small>
        </div>
        <div class="header-block center">
            <div class="panel">
                <div class="button">
                    <a href="#" id="button_dialog_test" data-open-dialog="dialog_test" title="Toggle page panel"><i class="fa fa-mobile cfe" aria-hidden="true"></i></a>
                </div>
                <div class="button">
                    <a href="#" id="button_mobile_test" title="Toggle page panel"><i class="fa fa-laptop cfe" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </header>
    <div class="main" id="main">
        <div class="nav-block left"  id="nav_block_left">
            <div id="page_container">
                <div class="page-properties" id="page_properties">
                    <div class="panel" id="panel_page_properties">
                        <div class="button">
                            <a href=""><i class="fa fa-refresh cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="button">
                            <a href=""><i class="fa fa-trash cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="button disabled">
                            <a href=""><i class="fa fa-clipboard cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="button">
                            <a href=""><i class="fa fa-scissors cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="button">
                            <a href=""><i class="fa fa-files-o cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="button">
                            <a href=""><i class="fa fa-eye cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="button">
                            <a href=""><i class="fa fa-pencil cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="button">
                            <a href=""><i class="fa fa-plus cfe" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="panel" id="panel_page_tree">
                        <div class="select-box">
                            <select name="type" id="select_page_properties_type">
                                <option value="opt1">Pages</option>
                                <option value="opt2">Books</option>
                            </select>
                            <script type="text/javascript">
                                $('#select_page_properties_type').selectize({
                                    create: true
                                });
                            </script>
                        </div>
                        <div class="button inside">
                            <a href=""><i class="fa fa-sort-amount-asc cfe" aria-hidden="true"></i></a>
                        </div>
                        <div class="text-box with-icon">
                            <input class="text" type="text" placeholder="Search" />
                            <i class="fa fa-search cfe" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div id="page_tree" class="page-tree"></div>
                <script type="text/javascript">
                    $('#page_tree').jstree({
                        'core' : {
                            'multiple' : false,
                            'animation' : 0,
                            'themes' : {
                                'variant' : 'large',
                                'dots' : true
                            },
                            'data' : {
                                'url' : 'http://cms.dev/admin.php?_controller=Page&_extension=Editor&_action=tree',
                                'data' : function (node) {
                                    console.log(node);
                                    return { 'id' : node.id };
                                }
                            }
                        },
                        'plugins' : ['dnd', 'search', 'wholerow']
                        //'plugins' : ['dnd', 'search', 'wholerow', 'checkbox']
                    });
                </script>
            </div>
            <div id="content_container">
                <div class="panel" id="panel_page_properties">
                    <div class="button">
                        <a href=""><i class="fa fa-refresh cfe" aria-hidden="true"></i></a>
                    </div>
                    <div class="button">
                        <a href=""><i class="fa fa-trash cfe" aria-hidden="true"></i></a>
                    </div>
                    <div class="button disabled">
                        <a href=""><i class="fa fa-clipboard cfe" aria-hidden="true"></i></a>
                    </div>
                    <div class="button">
                        <a href=""><i class="fa fa-scissors cfe" aria-hidden="true"></i></a>
                    </div>
                    <div class="button">
                        <a href=""><i class="fa fa-files-o cfe" aria-hidden="true"></i></a>
                    </div>
                    <div class="button">
                        <a href=""><i class="fa fa-eye cfe" aria-hidden="true"></i></a>
                    </div>
                    <div class="button">
                        <a href=""><i class="fa fa-pencil cfe" aria-hidden="true"></i></a>
                    </div>
                    <div class="button">
                        <a href=""><i class="fa fa-plus cfe" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div id="page_content" class="page-content"></div>
                <script type="text/javascript">
                    $('#page_content').jstree({
                        'core' : {
                            'multiple' : false,
                            'animation' : 0,
                            'themes' : {
                                'variant' : 'large',
                                'dots' : true
                            },
                            'data' : {
                                'url' : 'temp/ajax_content.html',
                                'data' : function (node) {
                                    return { 'id' : node.id };
                                }
                            }
                        },
                        'plugins' : ['dnd', 'search', 'wholerow']
                        //'plugins' : ['dnd', 'search', 'wholerow', 'checkbox']
                    });
                </script>
            </div>
        </div>
        <div class="nav-block right" id="nav_block_right">
            <div class="fields-tab">
                <h3>
                    <a href="#" class="expand"><i class="fa fa-chevron-down expand" aria-hidden="true"></i></a>
                    <i class="fa fa-mouse-pointer" aria-hidden="true"></i> Selected item
                </h3>
                <div class="fields-list">
                    <div class="field">
                        <input type="text" name="selected_item" value="Contacter nous" class="text wide"/>
                    </div>
                    <div class="field">
                        <h4>Url path</h4>
                        <input type="text" name="selected_item" value="Contacter nous" class="text wide state-changed"/>
                    </div>
                    <div class="field">
                        <h4>Url path</h4>
                        <input type="text" name="selected_item" value="Contacter nous" class="text wide state-to-publish"/>
                    </div>
                </div>
            </div>
            <div class="fields-tab">
                <h3>
                    <a href="#" class="expand"><i class="fa fa-chevron-down expand" aria-hidden="true"></i></a>
                    <i class="fa fa-eye" aria-hidden="true"></i> Visibility
                </h3>
                <div class="fields-list">
                    <div class="field">
                        <h4>Hide before</h4>
                        <textarea class="textarea wide" rows="5" name="test_text"></textarea>
                    </div>
                    <div class="field">
                        <h4>Hide after</h4>
                        <div class="checkbox">
                            <input type="checkbox" name="test_checkbox" id="test_checkbox"/>
                            <label for="test_checkbox">This is my label. It's unstyled because fuck yeah</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fields-tab">
                <h3>
                    <a href="#" class="expand"><i class="fa fa-chevron-down expand" aria-hidden="true"></i></a>
                    <i class="fa fa-download" aria-hidden="true"></i> Another sample tab
                </h3>
                <div class="fields-list">
                    <div class="field">
                        <h4>Hide before</h4>
                        <select name="sample_dropdown" class="dropdown">
                            <option value="opt1">Pages</option>
                            <option value="opt2">Books</option>
                        </select>
                        <script type="text/javascript">
                            $('.dropdown').selectize({
                                create: true
                            });
                        </script>
                    </div>
                </div>
            </div>
            <!--
            <ul class="menu horizontal">
              <li><a href="" class="selected"><i class="material-icons cfe">add_circle</i></a></li>
              <li><a href=""><i class="material-icons cfe">favorite</i></a></li>
              <li><a href=""><i class="material-icons cfe">content_paste</i></a></li>
              <li><a href=""><i class="material-icons cfe">check_circle</i></a></li>
            </ul>
            <ul class="menu vertical">
              <li><a href=""><i class="material-icons cfe">text_format</i> Regular content elements</a></li>
              <li><a href=""><i class="material-icons cfe">extension</i> Plugins</a></li>
              <li><a href=""><i class="material-icons cfe">chrome_reader_mode</i> Form elements</a></li>
              <li><a href=""><i class="material-icons cfe">important_devices</i> Layouts</a></li>
              <li><a href=""><i class="material-icons cfe">stars</i> Special</a></li>
            </ul>-->
        </div>
    </div>
</div>

<div class="continut-cms-page nav-left nav-right" id="continut_cms_page">
    <div class="cms-dialog" id="dialog_test" data-animation="slide-down">
        <div class="cms-dialog-title">
            <div class="panel">
                <div class="button inside left">
                    <a href="#" title="Close dialog" data-dialog-close=""><i class="fa fa-times cfe" aria-hidden="true"></i></a>
                </div>
            </div>
            <h3>Dialog title</h3>
        </div>
        <div class="cms-dialog-content">
            <p>Dialog content goes here...</p>
        </div>
    </div>
    <iframe id="continut_iframe"
            name="continut_iframe"
            title="continut_iframe"
            width="100%"
            height="100%"
            frameborder="0"
            scrolling="yes"
            marginheight="0"
            marginwidth="0"
            src="http://cms.dev/comics-hac-bd">
    </iframe>
    <!--<cms-page-loader url="http://www.continutfe.local/temp/cms/tourism/home.html"></cms-page-loader>-->
    <!--<img src="temp/dummy_bg.png" alt="" style="width: 100%" />-->
</div>
<div id="overlay"></div>