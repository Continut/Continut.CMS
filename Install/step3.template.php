<div class="panel-heading">
    <strong>Step 3</strong> - Connect to a database
</div>
<div class="panel panel-body">
    <form method="post" class="form login" action="install.php?step=4">
        <p>Let us connect to your database first. Please specify the database driver, host, user and password.</p>
        <fieldset>
            <?php if (sizeof($availablePdoDrivers) > 0): ?>
            <div class="field">
                <select name="params[db_driver]" id="db_driver" class="text">
                    <?php foreach ($availablePdoDrivers as $driver): ?>
                    <option <?= (isset($params['db_driver']) && $params['db_driver'] == $driver) ? 'selected="selected"' : ''; ?> value="<?= $driver ?>"><?= $driver ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="db_fields">
                <div class="field">
                    <input name="params[db_host]" id="db_host" type="text" class="text" value="<?= isset($params['db_host']) ? $params['db_host'] : '127.0.0.1'; ?>" placeholder="Database host"/>
                </div>
                <div class="field">
                    <input name="params[db_user]" id="db_user" type="text" class="text" value="<?= isset($params['db_user']) ? $params['db_user'] : 'vagrant'; ?>" placeholder="Database user"/>
                </div>
                <div class="field">
                    <input name="params[db_pass]" id="db_pass" type="password" class="password" value="<?= isset($params['db_pass']) ? $params['db_pass'] : 'vagrant'; ?>" placeholder="Database password"/>
                </div>
                <?php if (isset($params['error'])): ?>
                    <p class="text-danger">Could not connect to the database: <strong><?= $params['error'] ?></strong></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="field">
                <?php if (sizeof($availablePdoDrivers) > 0): ?>
                    <input type="submit" class="button submit" value="Next" />
                <?php else: ?>
                    <p>You need to have at least 1 PDO driver installed in order to connect to a database. <a target="_blank" href="http://php.net/manual/en/pdo.drivers.php">List of PDO drivers</a>.</p>
                    <input type="submit" class="button error" data-action="install.php?step=3" value="Recheck requirements" />
                <?php endif; ?>
            </div>
        </fieldset>
    </form>
</div>