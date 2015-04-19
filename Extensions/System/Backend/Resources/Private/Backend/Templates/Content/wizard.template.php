<div role="tabpanel">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#wizard_tab_general" aria-controls="general" role="tab" data-toggle="tab">Element general de conţinut</a>
		</li>
		<li role="presentation"><a href="#wizard_tab_container" aria-controls="container" role="tab" data-toggle="tab">Container</a></li>
		<li role="presentation"><a href="#wizard_tab_plugin" aria-controls="plugin" role="tab" data-toggle="tab">Plugin</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="wizard_tab_general">
			<ul class="nav tab-elements">
				<li>
					<a href="">
						<img src="<?= $this->publicAsset("Images/Wizard/content_generic.png", "Backend") ?>" width="64" height="64" class="media-object" alt="">
						<p class="title">Conţinut text şi/sau imagini</p>
						<p>Permite crearea unui element de conţinut format din mai multe paragrafe de text ce pot de asemenea conţine şi imagini</p>
					</a>
				</li>
				<li>
					<a href="">
						<img src="<?= $this->publicAsset("Images/Wizard/content_generic.png", "Backend") ?>" width="64" height="64" class="media-object" alt="">
						<p class="title">Formular simplu de contact</p>
						<p>Permite crearea unui formular de contact simplu ce poate fi trimis prin email</p>
					</a>
				</li>
				<li>
					<a href="">
						<img src="<?= $this->publicAsset("Images/Wizard/content_generic.png", "Backend") ?>" width="64" height="64" class="media-object" alt="">
						<p class="title">Meniu spre pagini din arborescenţă</p>
						<p>Permite crearea unui meniu spre paginile si subpaginile selecţionate din arborescenţă</p>
					</a>
				</li>
			</ul>
		</div>
		<div role="tabpanel" class="tab-pane" id="wizard_tab_container">
			<ul class="nav tab-elements">
				<li>
					<a href="">
						<img src="<?= $this->publicAsset("Images/Wizard/container_2columns.png", "Backend") ?>" width="64" height="64" class="media-object" alt="">
						<p class="title">Container cu 2 coloane</p>
						<p>Acest container vă permite să adăugaţi elemente de conţinut în 2 coloane</p>
					</a>
				</li>
				<li>
					<a href="">
						<img src="<?= $this->publicAsset("Images/Wizard/container_3columns.png", "Backend") ?>" width="64" height="64" class="media-object" alt="">
						<p class="title">Container cu 3 coloane</p>
						<p>Acest container vă permite să adăugaţi elemente de conţinut în 3 coloane</p>
					</a>
				</li>
			</ul>
		</div>
		<div role="tabpanel" class="tab-pane" id="wizard_tab_plugin">
			<ul class="nav tab-elements">
				<li>
					<a href="">
						<img src="<?= $this->publicAsset("Images/Wizard/plugin_news.png", "Backend") ?>" width="64" height="64" class="media-object" alt="">
						<p class="title">Ştiri / Articole</p>
						<p>Permite afişarea ştirilor sau articolelor şi configurarea diferitelor setări legate de acestea.</p>
					</a>
				</li>
			</ul>
		</div>
	</div>

</div>