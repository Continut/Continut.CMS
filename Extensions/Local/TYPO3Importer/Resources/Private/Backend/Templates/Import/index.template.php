<div class="row">
    <div class="col-xs-12 col-sm-6">
        <h3>Import data from TYPO3 website</h3>
        <form method="post" action="<?= $this->helper('Url')->linkToPath('admin_backend', ['_extension' => 'TYPO3Importer', '_controller' => 'Import', '_action' => 'import']) ?>">
            <input type="text" name="import[domain_url_id]" placeholder="Domain URL id" />
            <input type="text" name="import[dsn]" placeholder="DSN connection" />
            <input type="submit" value="Import" />
        </form>
    </div>
</div>