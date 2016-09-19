<?php if ($pageTree): ?>
    <div class="btn-group" role="group" aria-label="mainmenu">
        <?php foreach ($pageTree as $leaf): ?>
            <?php if ($leaf->children): ?>
                <div class="btn-group">
                <a class="btn btn-default" href="<?= $this->helper("Url")->linkToPage($leaf->getId()) ?>"
                   role="button"><?= $leaf->getTitle() ?></a>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
            <?php else: ?>
                <a class="btn btn-default"
                   href="<?= $this->helper("Url")->linkToPage($leaf->getId()) ?>"><?= $leaf->getTitle() ?></a>
            <?php endif ?>
            <?php if ($leaf->children): ?>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach ($leaf->children as $subleaf): ?>
                        <li>
                            <a href="<?= $this->helper("Url")->linkToPage($subleaf->getId()) ?>"><?= $subleaf->getTitle() ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
<?php endif ?>