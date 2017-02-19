<div class="panel-heading">
    <strong>Step 4</strong> - Importing data
</div>
<div class="panel panel-body">
    <form method="post" class="form login" action="install.php?step=6">
        <input type="hidden" name="params[db_user]" value="<?= $params['db_user'] ?>" />
        <input type="hidden" name="params[db_pass]" value="<?= $params['db_pass'] ?>" />
        <input type="hidden" name="params[db_host]" value="<?= $params['db_host'] ?>" />
        <input type="hidden" name="params[db_driver]" value="<?= $params['db_driver'] ?>" />
        <p>
            Use an existing database <br/>
            <strong>Please note:</strong> All existing data will be removed from this databases!
        </p>
        <?php if (sizeof($databases) > 0): ?>
        <fieldset>
            <div class="field">
                <select name="db_name" id="db_name" class="text">
                    <?php foreach ($databases as $database): ?>
                        <option <?= (isset($params['db']) && $params['db'] == $database) ? 'selected="selected"' : ''; ?> value="<?= $database ?>"><?= $database ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
        <?php else: ?>
            <p class="text-danger">No existing database has been found! Try to create a new one.</p>
        <?php endif; ?>
        <p>Or create a new database</p>
        <fieldset>
            <div class="field">
                <input name="db_name_new" id="db_name_new" type="text" class="text" value="<?= isset($params['db_new']) ? $params['db_new'] : ''; ?>" placeholder="New database name"/>
            </div>
        </fieldset>
        <?php if (isset($params['error'])): ?>
            <p class="text-danger"><?= $params['error'] ?></p>
        <?php endif; ?>
        <p><input type="submit" class="button submit" value="Next" /></p>
        <!--<p><input type="submit" class="button error" data-action="install.php?step=5" value="Recheck requirements" /></p>-->
    </form>
</div>