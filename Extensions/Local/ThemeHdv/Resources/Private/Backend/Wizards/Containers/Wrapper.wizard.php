<blockquote>
    <p><i class="fa fa-fw fa-info"></i> <?= $this->__('backend.wizard.containers.info', ['count' => '1']) ?></p>
    <footer><?= $this->__('backend.wizard.containers.info.footer') ?></footer>
</blockquote>
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <?= $this->helper('Form')->textField('title', $this->__('backend.themeHdv.type.container.wrapper.title'), $this->valueOrDefault('title', '')) ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="form-group">
            <?= $this->helper('Form')->textField('subtitle', $this->__('backend.themeHdv.type.container.wrapper.subtitle'), $this->valueOrDefault('subtitle', '')) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-3">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'offsetLeft',
                $this->__('backend.themeHdv.type.container.wrapper.offsetLeft'),
                [
                    '0' => $this->__('backend.themeHdv.type.container.wrapper.offset.none'),
                    '1' => $this->__('backend.themeHdv.type.container.wrapper.offset.1column'),
                    '2' => $this->__('backend.themeHdv.type.container.wrapper.offset.2columns'),
                ],
                $this->valueOrDefault('offsetLeft', 0)
            )
            ?>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'offsetRight',
                $this->__('backend.themeHdv.type.container.wrapper.offsetRight'),
                [
                    '0' => $this->__('backend.themeHdv.type.container.wrapper.offset.none'),
                    '1' => $this->__('backend.themeHdv.type.container.wrapper.offset.1column'),
                    '2' => $this->__('backend.themeHdv.type.container.wrapper.offset.2columns'),
                ],
                $this->valueOrDefault('offsetRight', 0)
            )
            ?>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3">
        <div class="form-group">
            <?= $this->helper('Form')->selectField(
                'theme',
                $this->__('backend.themeHdv.type.container.wrapper.theme'),
                [
                    'white' => $this->__('backend.themeHdv.type.container.wrapper.theme.white'),
                    'gray' => $this->__('backend.themeHdv.type.container.wrapper.theme.gray'),
                ],
                $this->valueOrDefault('offsetRight', 0)
            )
            ?>
        </div>
    </div>
</div>