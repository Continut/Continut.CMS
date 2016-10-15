<form method="post" class="form login"
      action="<?= $this->helper("Url")->linkToAction("Backend", "Login", "checkLogin") ?>">
    <p><?= $this->__("login.header") ?></p>
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
<footer>
    <p><?= $this->__("copyright.text", ["file" => "LICENSE.TXT"]); ?></p>
    <p><?= $this->__("copyright.footer", ["link" => '<a href="http://www.pixelplant.ch" target="_blank" title="www.pixelplant.ch">Radu Mogoș</a>']) ?></p>
</footer>
