<div class="panel-heading">
    <strong>Phase 2</strong> - Checking requirements
</div>
<div class="panel panel-body">
    <form method="post" class="form login" action="install.php?step=step3">
        <p>Your PHP version: <?= $phpVersion; ?></p>
        <p>Missing extensions: <?= var_dump($missingExtensions); ?></p>
        <p><input type="submit" class="button submit" value="Next" /></p>
    </form>
</div>