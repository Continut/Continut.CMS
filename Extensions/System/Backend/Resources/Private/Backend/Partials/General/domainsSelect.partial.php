<select name="configuration_site" class="selectpicker" data-width="100%" id="configuration_site">
    <option <?= ($data['configurationSite'] === '0') ? 'selected': ''; ?> value="0"><?= $this->__('backend.select.allDomains') ?></option>
    <?php foreach ($data['domains']->getAll() as $domain): ?>
        <optgroup label="<?= $domain->getTitle() ?>">
            <option <?= ($data['configurationSite'] === 'domain_' . $domain->getId()) ? 'selected': ''; ?> value="domain_<?= $domain->getId() ?>" data-icon="flag-icon flag-icon-eu"><?= $this->__('backend.select.allLanguages') ?></option>
            <?php foreach ($domain->getDomainUrls() as $url): ?>
                <option <?= ($data['configurationSite'] === 'url_' . $url->getId()) ? 'selected': ''; ?> data-icon="flag-icon flag-icon-<?= $url->getFlag(); ?>" value="url_<?= $url->getId(); ?>"><?= $url->getTitle() ?></option>
            <?php endforeach; ?>
        </optgroup>
    <?php endforeach; ?>
</select>