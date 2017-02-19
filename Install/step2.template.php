<div class="panel-heading">
    <strong>Step 2</strong> - Checking requirements
</div>
<div class="panel panel-body">
    <form method="post" class="form login" action="install.php?step=3">
        <?php if ($phpVersionOk): ?>
            <p class="text-success"><img src="Install/Images/check.svg" alt="" /> Hooray! Your PHP version (<?= $phpVersion; ?>) is supported.</p>
        <?php else: ?>
            <p class="text-danger"><img src="Install/Images/ban.svg" alt="" /> Unfortunatelly your PHP version is supported. You need to be running at least PHP v5.5.0. Please install it and retry the installation.</p>
        <?php endif; ?>
        <?php if (sizeof($missingExtensions) > 0): ?>
            <p>The following PHP extensions are missing and are required by Conținut CMS in order to work properly:</p>
            <ol>
                <?php foreach ($missingExtensions as $extension): ?>
                <li class="text-danger"><?= $extension; ?></li>
                <?php endforeach; ?>
            </ol>
        <?php else: ?>
            <p class="text-success"><img src="Install/Images/check.svg" alt="" /> All of the required PHP extensions seem to be installed.</p>
        <?php endif; ?>
        <?php if (sizeof($availablePdoDrivers) > 0): ?>
            <p class="text-success"><img src="Install/Images/check.svg" alt="" /> We have found the following PDO drivers installed: <?= implode(', ', $availablePdoDrivers); ?></p>
        <?php else: ?>
            <p class="text-danger"><img src="Install/Images/ban.svg" alt="" /> In order to use a database you need to have at least 1 PDO driver installed. None was found.</p>
        <?php endif; ?>
        <?php if ($canInstall): ?>
            <p><input type="submit" class="button submit" value="Next" /></p>
        <?php else: ?>
            <p>Before you can continue with the installation you need to install all of the missing requirements listed above. Once you have done that you can either restart the install, or just click on the <strong>"Recheck requirements"</strong> button.</p>
            <p><input type="submit" class="button error" data-action="install.php?step=2" value="Recheck requirements" /></p>
        <?php endif; ?>
    </form>
</div>