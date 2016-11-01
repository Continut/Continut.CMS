<ul class="nav navbar-nav">
    <?php foreach ($mainMenu as $menuItem): ?>
        <?php if (isset($menuItem["items"])): ?>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
                    <?php if (isset($menuItem["icon"])): ?>
                        <i class="<?= $menuItem["icon"] ?>"></i>
                    <?php endif ?>
                    <?= $this->__($menuItem["label"]) ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach ($menuItem["items"] as $identifier => $submenuItem): ?>
                        <?php if (isset($submenuItem["type"]) && ($submenuItem["type"] == "divider")): ?>
                            <li class="divider"></li>
                        <?php elseif (isset($submenuItem["type"]) && ($submenuItem["type"] == "header")): ?>
                            <li class="dropdown-header" role="presentation"><?= $this->__($submenuItem["label"]) ?></li>
                        <?php else: ?>
                            <li>
                                <a href="<?= $this->helper("Url")->linkToMenu($submenuItem) ?>">
                                    <?php if (isset($submenuItem["icon"])): ?>
                                        <i class="<?= $submenuItem["icon"] ?>"></i>
                                    <?php endif ?>
                                    <?= $this->__($submenuItem["label"]) ?>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </li>
        <?php else: ?>
            <li>
                <a href="<?= $this->helper("Url")->linkToMenu($menuItem) ?>">
                    <?php if (isset($menuItem["icon"])): ?>
                        <i class="<?= $menuItem["icon"] ?>"></i>
                    <?php endif ?>
                    <?= $this->__($menuItem["label"]) ?>
                </a>
            </li>
        <?php endif ?>
    <?php endforeach; ?>
</ul>

<ul class="nav navbar-nav navbar-right">
    <?php foreach ($secondaryMenu as $menuItem): ?>
        <?php if (isset($menuItem["items"])): ?>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
                    <?php if (isset($menuItem["icon"])): ?>
                        <i class="<?= $menuItem["icon"] ?>"></i>
                    <?php endif ?>
                    <?= $this->__($menuItem["label"]) ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach ($menuItem["items"] as $identifier => $submenuItem): ?>
                        <?php if (isset($submenuItem["type"]) && $submenuItem["type"] == "divider"): ?>
                            <li class="divider"></li>
                        <?php else: ?>
                            <li>
                                <a href="#">
                                    <?php if (isset($submenuItem["icon"])): ?>
                                        <i class="<?= $submenuItem["icon"] ?>"></i>
                                    <?php endif ?>
                                    <?= $this->__($submenuItem["label"]) ?>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </li>
        <?php else: ?>
            <li>
                <a href="#">
                    <?php if (isset($menuItem["icon"])): ?>
                        <i class="<?= $menuItem["icon"] ?>"></i>
                    <?php endif ?>
                    <?= $this->__($menuItem["label"]) ?>
                </a>
            </li>
        <?php endif ?>
    <?php endforeach; ?>
</ul>