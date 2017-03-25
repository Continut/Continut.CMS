<div class="form-group">
    <?= $fieldLabel ?>
    <div class="rte-toolbar" id="rte_toolbar_<?= $name ?>">
        <div class="btn-group">
            <a class="btn btn-default" data-wysihtml-command="bold"><i class="fa fa-fw fa-bold"></i></a>
            <a class="btn btn-default" data-wysihtml-command="italic"><i class="fa fa-fw fa-italic"></i></a>
            <a class="btn btn-default" data-wysihtml-command="underline"><i class="fa fa-fw fa-underline"></i></a>
        </div>
        <div class="btn-group">
            <a class="btn btn-default" data-wysihtml-command="justifyLeft"><i class="fa fa-fw fa-align-left"></i></a>
            <a class="btn btn-default" data-wysihtml-command="justifyCenter"><i class="fa fa-fw fa-align-center"></i></a>
            <a class="btn btn-default" data-wysihtml-command="justifyRight"><i class="fa fa-fw fa-align-right"></i></a>
        </div>
        <div class="btn-group">
            <a class="btn btn-default" data-wysihtml-command="insertUnorderedList"><i class="fa fa-fw fa-list"></i></a>
            <a class="btn btn-default" data-wysihtml-command="insertOrderedList"><i class="fa fa-fw fa-list-ol"></i></a>
        </div>
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Format
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a data-wysihtml-command="formatBlock" data-wysihtml-command-value="p" data-icon="fa fa-fw fa-paragraph">Paragraph</a></li>
                    <li><a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h1" data-icon="fa fa-fw fa-header">Heading 1</a></li>
                    <li><a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h2" data-icon="fa fa-fw fa-header">Heading 2</a></li>
                    <li><a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h3" data-icon="fa fa-fw fa-header">Heading 3</a></li>
                    <li><a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h4" data-icon="fa fa-fw fa-header">Heading 4</a></li>
                    <li><a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h5" data-icon="fa fa-fw fa-header">Heading 5</a></li>
                </ul>
            </div>
        </div>
        <a class="btn btn-default" data-wysihtml-action="change_view"><i class="fa fa-fw fa-code"></i></a>
    </div>
    <textarea id="<?= $fieldId ?>" name="<?= $fieldName ?>" class="form-control rte"><?= $value ?></textarea>
</div>
<script type="text/javascript">
    rteEditor['<?= $name ?>'] = new wysihtml.Editor('field_<?= $name ?>', {
        toolbar: 'rte_toolbar_<?= $name ?>',
        parserRules: wysihtmlParserRules,
        useLineBreaks: false
    });
    //$('.selectpicker').selectpicker();
</script>