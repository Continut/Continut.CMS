<div id="container" class="container-fluid">
	<div class="row">
		<div id="content" class="col-sm-12">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<p><?= $this->__("copyright.text", ["file" => "LICENSE.TXT"]); ?></p>
					<div class="panel panel-cms page-panel">
						<div class="panel-heading"><?= $this->__("login.header") ?></div>
						<div class="panel-body">
							<?= $this->helper("Session")->showFlashMessages(\Continut\Core\System\Session\UserSession::FLASH_ERROR); ?>
							<form method="post" action="<?= $this->helper("Url")->linkToAction("Backend", "Login", "checkLogin") ?>">
								<div class="form-group">
									<label for="cms_username"><span class="fa fa-fw fa-user-secret"></span> <?= $this->__("login.username") ?></label>
									<input name="cms_username" id="cms_username" type="text" class="form-control" placeholder="<?= $this->__("login.username") ?>" />
								</div>
								<div class="form-group">
									<label for="cms_password"><span class="fa fa-fw fa-key"></span> <?= $this->__("login.password") ?></label>
									<input name="cms_password" id="cms_password" type="password" class="form-control" placeholder="<?= $this->__("login.password") ?>" />
								</div>
								<button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-plug"></span> <?= $this->__("login.connect") ?></button>
							</form>
						</div>
					</div>
					<p><small><?= $this->__("copyright.footer", ["link" => '<a href="http://www.pixelplant.ch" target="_blank" title="www.pixelplant.ch">Radu Mogoș</a>']) ?></small></p>
				</div>
			</div>
		</div>
	</div>
</div>