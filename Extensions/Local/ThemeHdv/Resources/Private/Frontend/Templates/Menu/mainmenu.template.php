<div class="container-fluid menu" id="menu">
    <div class="container">
        <div class="row middle-xs">
            <div class="col-xs-8 menu-title">
                <a class="less" href="#" style="display:none"><span class="icon-arrow2-left"></span> <span id="menu_title">Menu</span></a>
                <span id="default_menu_title">Menu</span>
            </div>
            <div class="col-xs-8 col-sm-1 col-md-2 col-lg-2 logo">
                <a href="<?= $this->helper('Url')->linkToHome() ?>">
                    <img src="<?= $this->helper('Image')->getPath('Images/logo.svg', 'ThemeHdv') ?>" class="normal" alt="Logo HVS" />
                    <img src="<?= $this->helper('Image')->getPath('Images/logo_simple.svg', 'ThemeHdv') ?>" class="simple" alt="Logo HVS mobile" />
                </a>
            </div>
            <div class="col-xs-4 mobile-menu-shortcut">
                <ul>
                    <li><a class="show-search" data-for=".search-text.mobile" href="#"><span class="icon-3x icon-search"></span></a></li>
                    <li>
                        <a class="toggleMobile" href="#">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-11 col-md-10 col-lg-10 mobile-menu">
                <div class="row">
                    <div class="col-xs-12 first-sm">
                        <ul class="top-menu">
                            <li class="bold"><a class="increase-font" href="">A+</a></li>
                            <li class="bold"><a class="decrease-font" href="">A-</a></li>
                            <li class="mobile-languages"><a href="" class="active">Français</a><a href="">Deutsch</a><a href="">English</a></li>
                            <li><a href="">Annuaire</a></li>
                            <li><a href="">Canditats</a></li>
                            <li><a href="">Presse</a></li>
                            <li><a href="">Contact</a></li>
                            <li class="special"><a href=""><span class="icon icon-account"></span> Me connecter</a></li>
                            <li class="has-dropdown languages special"><a href="">Français</a>
                                <ul>
                                    <li><a href="">Deutsch</a></li>
                                    <li><a href="">English</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 first-xs">
                        <div class="search-text desktop">
                            <form method="post" action="">
                                <div class="row middle-xs">
                                    <div class="col-xs-1 col-sm-2 col-md-1">
                                        <a class="btn btn-wide btn-disabled text-center close" href="#"><span class="icon-cross"></span></a>
                                    </div>
                                    <div class="col-xs-9 col-sm-7 col-md-7">
                                        <input type="text" class="search-box" placeholder="Recherche" />
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-4">
                                        <button type="submit" class="btn btn-default btn-search btn-full">Chercher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php if ($pageTree): ?>
                            <ul class="main-menu level-1">
                                <?php foreach ($pageTree as $leaf): ?>
                                    <li class="menu-item <?php echo ($leaf->getId() == $this->getRequest()->getArgument('id')) ? 'active': ''; ?>">
                                        <a href="<?= $this->helper('Url')->linkToSlug($leaf->getSlug()) ?>" data-target="pid-<?= $leaf->getId() ?>"><?= $leaf->getTitle() ?></a>
                                        <a href="#" class="more"><span class="icon-arrow2-right"></span></a>
                                    </li>
                                <?php endforeach ?>
                                <li class="search">
                                    <a href="" class="show-search" data-for=".search-text.desktop"><span class="icon-search"></span></a>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="search-text mobile">
                <div class="row">
                    <div class="col-xs-8">
                        <input type="text" class="search-box" style="width: 100%" placeholder="Recherche" />
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-default btn-search btn-full">Chercher</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-wrapper">
            <div class="menu-row">
                <?php $level2Pages = []; ?>
                <?php $level3Pages = []; ?>
                <?php $level4Pages = []; ?>
                <?php $level5Pages = []; ?>
                <div class="menu-col">
                    <?php foreach ($pageTree as $leaf): ?>
                        <ul id="pid-<?= $leaf->getId() ?>" data-level="2" class="levels level-2">
                            <?php if ($leaf->children): ?>
                                <li class="main-title"><a href="<?= $this->helper('Url')->linkToSlug($leaf->getSlug()) ?>"><?= $leaf->getTitle() ?></a></li>
                                <?php foreach ($leaf->children as $level2): ?>
                                    <?php if ($level2->children) { $level2Pages[] = $level2; } ?>
                                    <li>
                                        <a href="<?= $this->helper('Url')->linkToSlug($level2->getSlug()) ?>" <?= ($level2->children) ? 'data-target="pid-'.$level2->getId().'"': ''; ?>><?= $level2->getTitle(); ?></a>
                                        <?php if ($level2->children): ?>
                                            <a href="#" class="more"><span class="icon-arrow2-right"></span></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ul>
                     <?php endforeach ?>
                </div>
                <div class="menu-col">
                    <?php if ($level2Pages): ?>
                        <?php foreach ($level2Pages as $leaf): ?>
                            <ul id="pid-<?= $leaf->getId() ?>" data-level="3" class="levels level-3">
                                <?php if ($leaf->children): ?>
                                    <li class="main-title"><a href="<?= $this->helper('Url')->linkToSlug($leaf->getSlug()) ?>"><?= $leaf->getTitle() ?></a></li>
                                    <?php foreach ($leaf->children as $level3): ?>
                                        <?php if ($level3->children) { $level3Pages[] = $level3; } ?>
                                        <li>
                                            <a href="<?= $this->helper('Url')->linkToSlug($level3->getSlug()) ?>" <?= ($level3->children) ? 'data-target="pid-'.$level3->getId().'"': ''; ?>><?= $level3->getTitle(); ?></a>
                                            <?php if ($level3->children): ?>
                                                <a href="#" class="more"><span class="icon-arrow2-right"></span></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
                <div class="menu-col">
                    <?php if ($level3Pages): ?>
                        <?php foreach ($level3Pages as $leaf): ?>
                            <ul id="pid-<?= $leaf->getId() ?>" data-level="4" class="levels level-4">
                                <?php if ($leaf->children): ?>
                                    <li class="main-title"><a href="<?= $this->helper('Url')->linkToSlug($leaf->getSlug()) ?>"><?= $leaf->getTitle() ?></a></li>
                                    <?php foreach ($leaf->children as $level4): ?>
                                        <?php if ($level4->children) { $level4Pages[] = $level4; } ?>
                                        <li>
                                            <a href="<?= $this->helper('Url')->linkToSlug($level4->getSlug()) ?>" <?= ($level4->children) ? 'data-target="pid-'.$level4->getId().'"': ''; ?>><?= $level4->getTitle(); ?></a>
                                            <?php if ($level4->children): ?>
                                                <a href="#" class="more"><span class="icon-arrow2-right"></span></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
                <div class="menu-col summary">
                    <div class="summaries">
                        <div id="summary-pid-7">
                            <ul>
                                <li class="direct-access">Accés directs</li>
                                <li><a href="">Boite à bebe</a></li>
                                <li><a href="">Secteur medical en images</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php if ($level4Pages): ?>
                        <?php foreach ($level4Pages as $leaf): ?>
                            <ul id="pid-<?= $leaf->getId() ?>" data-level="5" class="levels level-5">
                                <?php if ($leaf->children): ?>
                                    <li class="main-title"><a href="<?= $this->helper('Url')->linkToSlug($leaf->getSlug()) ?>"><?= $leaf->getTitle() ?></a></li>
                                    <?php foreach ($leaf->children as $level5): ?>
                                        <?php if ($level5->children) { $level5Pages[] = $level5; } ?>
                                        <li>
                                            <a href="<?= $this->helper('Url')->linkToSlug($level5->getSlug()) ?>" <?= ($level5->children) ? 'data-target="pid-'.$level5->getId().'"': ''; ?>><?= $level5->getTitle(); ?></a>
                                            <?php if ($level5->children): ?>
                                                <a href="#" class="more"><span class="icon-arrow2-right"></span></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
                <div class="menu-col">
                    <?php if ($level5Pages): ?>
                        <?php foreach ($level5Pages as $leaf): ?>
                            <ul id="pid-<?= $leaf->getId() ?>" data-level="6" class="levels level-6">
                                <?php if ($leaf->children): ?>
                                    <li class="main-title"><a href="<?= $this->helper('Url')->linkToSlug($leaf->getSlug()) ?>"><?= $leaf->getTitle() ?></a></li>
                                    <?php foreach ($leaf->children as $level6): ?>
                                        <li>
                                            <a href="<?= $this->helper('Url')->linkToSlug($level6->getSlug()) ?>"><?= $level6->getTitle(); ?></a>
                                        </li>
                                    <?php endforeach ?>
                                    <li><a href="" class="return-button"><span class="icon-arrow2-left"></span> Retour</a></li>
                                <?php endif ?>
                            </ul>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="overlay-mainmenu">
    <a href="" title="Close" class="close"><span class="icon-2x icon-arrow2-up"></span></a>
</div>
