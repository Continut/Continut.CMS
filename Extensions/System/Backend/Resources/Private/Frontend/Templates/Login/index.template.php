<div class="lines clear">
    <div class="line theme1"></div>
    <div class="line theme2"></div>
    <div class="line theme3"></div>
    <div class="line theme4"></div>
    <div class="line theme5"></div>
</div>
<div class="panel-wrapper">
    <p class="text-center title">
        <img src="<?= $this->helper('Image')->getPath('Images/logo_negru.svg', 'Backend'); ?>" height="60" alt="Continut CMS" />
        <br/><?= $this->__("product.name") ?>
    </p>
    <div class="panel panel-login">
        <div class="panel-heading">
            <?= $this->__("login.header") ?>
        </div>
        <div class="panel panel-body">
            <form method="post" class="form login"
                  action="<?= $this->helper("Url")->linkToPath('admin_backend', ['_controller' => 'Login', '_action' => 'checkLogin']) ?>">
                <?= $this->helper("Session")->showFlashMessages(\Continut\Core\System\Domain\Model\UserSession::FLASH_ERROR); ?>
                <fieldset>
                    <div class="field">
                        <input name="cms_username" id="cms_username" type="text" class="text"
                               placeholder="<?= $this->__("login.username") ?>"/>
                    </div>
                    <div class="field">
                        <input name="cms_password" id="cms_password" type="password" class="password"
                               placeholder="<?= $this->__("login.password") ?>"/>
                    </div>
                    <div class="field">
                        <input type="submit" class="button submit" value="<?= $this->__("login.connect") ?>">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<footer>
    <p><?= $this->__("copyright.text", ["file" => "LICENSE.TXT"]); ?></p>
    <p><?= $this->__("copyright.footer", ["link" => '<a href="http://www.continut.org" target="_blank" title="www.continut.org">Radu Mogoș</a>']) ?></p>
</footer>
