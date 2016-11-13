<nav class="mainmenu navbar navbar-fixed-top" data-spy="affix" data-offset-top="30">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $this->helper("Url")->linkToHome() ?>"><i class="icon-logo"></i> <strong>Conținut</strong>CMS</a>
        </div>
        <div class="collapse navbar-collapse" id="collapse-navbar">
            <?php if ($leftMenuPages): ?>
                <ul class="nav navbar-nav">
                    <?php foreach ($leftMenuPages->getAll() as $page): ?>
                        <li <?php echo ($page->getId() == $this->getRequest()->getArgument('id')) ? 'class="active"': ''; ?>>
                            <a href="<?= $this->helper("Url")->linkToSlug($page->getSlug()) ?>"><?= $page->getTitle() ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            <?php if ($rightMenuPages): ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php foreach ($rightMenuPages->getAll() as $page): ?>
                        <li <?php echo ($page->getId() == $this->getRequest()->getArgument('id')) ? 'class="active"': ''; ?>>
                            <a href="<?= $this->helper("Url")->linkToSlug($page->getSlug()) ?>"><?= $page->getTitle() ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </div>
    </div>
</nav>