<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb breadcrumb-page-tree">
            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                <li><a class="page-link" href="#" data-page-id="<?= $breadcrumb->getId() ?>"><?= $breadcrumb->getTitle(); ?></a></li>
            <?php endforeach ?>
            <li class="active"><?= $page->getTitle() ?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning" id="page-edit">
                <i class="fa fa-fw fa-pencil"></i> <?= $this->__("backend.page.edit") ?>
            </button>
            <button type="button" class="btn btn-default" id="page-visibility-frontend">
                <span class="element-visible <?= $page->getIsVisible() ? "" : "hide" ?>"><i class="fa fa-fw fa-check"></i> <?= $this->__("backend.page.visibleInFrontend") ?></span>
                <span class="element-hide <?= $page->getIsVisible() ? "hide" : "" ?>"><i class="fa fa-fw fa-close text-danger"></i> <?= $this->__("backend.page.notVisibleInFrontend") ?></span>
            </button>
            <button type="button" class="btn btn-default" id="page-visibility-menu">
                <span class="element-visible <?= $page->getIsInMenu() ? "" : "hide" ?>"><i class="fa fa-fw fa-eye"></i> <?= $this->__("backend.page.visibleInMenu") ?></span>
                <span class="element-hide <?= $page->getIsInMenu() ? "hide" : "" ?>"><i class="fa fa-fw fa-eye-slash text-danger"></i> <?= $this->__("backend.page.notVisibleInMenu") ?></span>
            </button>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-danger" id="page-delete"><i class="fa fa-fw fa-trash"></i> <?= $this->__("backend.page.deletePage") ?></button>
        </div>
    </div>
</div>

<div class="progress-loader text-center loader-page-save-properties">
    <img src="<?= $this->helper("Image")->getPath("Images/spin.svg", "Backend") ?>" alt="" />
</div>

<div id="page_edit_block" class="row"></div>
<div class="panel panel-warning page-panel">
    <div class="panel-heading"><i class="fa fa-fw fa-file-o"></i> <span class="current-page-title"><?= $page->getTitle() ?></span></div>
    <div class="panel-body">
        <?= $pageContent ?>
    </div>
</div>
<script type="text/javascript">
    $('.page-link').on('click', function() {
        $.ajax({
            url: '<?= $this->helper("Url")->linkToAction("Backend", "Page", "show") ?>',
            data: { page_id: $(this).data('page-id') }
        })
        .done(function (data) {
            $('#content').html(data);
        });
    });
    $('#page-visibility-frontend').on('click', function() {
        $.ajax({
            url: '<?= $this->helper("Url")->linkToAction("Backend", "Page", "toggleVisibility") ?>',
            data: { page_id: <?= $page->getId() ?> },
            dataType: 'json'
        })
            .done(function (data) {
                var node = $('#cms_tree').tree('getNodeById', data.pid);
                if (data.visible) {
                    $('#page-visibility-frontend .element-visible').removeClass("hide");
                    $('#page-visibility-frontend .element-hide').addClass("hide");
                    $(node.element).find(".fa-lg").first().removeClass("fa-disabled");
                } else {
                    $('#page-visibility-frontend .element-visible').addClass("hide");
                    $('#page-visibility-frontend .element-hide').removeClass("hide");
                    $(node.element).find(".fa-lg").first().addClass("fa-disabled");
                }
            });
    });
    $('#page-visibility-menu').on('click', function() {
        $.ajax({
            url: '<?= $this->helper("Url")->linkToAction("Backend", "Page", "toggleMenu") ?>',
            data: { page_id: <?= $page->getId() ?> },
            dataType: 'json'
        })
            .done(function (data) {
                var node = $('#cms_tree').tree('getNodeById', data.pid);
                if (data.isInMenu) {
                    $('#page-visibility-menu .element-visible').removeClass("hide");
                    $('#page-visibility-menu .element-hide').addClass("hide");
                    $(node.element).find(".fa-stack-1x").first().removeClass("fa-eye-slash text-danger");
                } else {
                    $('#page-visibility-menu .element-visible').addClass("hide");
                    $('#page-visibility-menu .element-hide').removeClass("hide");
                    $(node.element).find(".fa-stack-1x").first().addClass("fa-eye-slash text-danger");
                }
            });
    });
    $('#page-edit').on('click', function() {
        if ($('#page_edit_block').is(':empty')) {
            $.ajax({
                url: '<?= $this->helper("Url")->linkToAction("Backend", "Page", "edit") ?>',
                data: {page_id: <?= $page->getId() ?> }
            }).done(function (data) {
                $('#page_edit_block').html(data);
            });
        }
    });
    $('#page-delete').on('click', function() {
        BootstrapDialog.confirm({
            message: <?= json_encode($this->__("backend.page.deletePage.confirm")) ?>,
            title: <?= json_encode($this->__("backend.page.deletePage")) ?>,
            type: BootstrapDialog.TYPE_DANGER,
            callback: function(result) {
                // if user confirms, send delete request
                if(result) {
                    $.getJSON({
                        url: '<?= $this->helper("Url")->linkToAction("Backend", "Page", "delete") ?>',
                        data: { page_id: <?= $page->getId() ?> }
                    }).done(function (data) {
                        console.log(data);
                    });
                }
            }
        });
    });

    $('.content-wizard').on('click', function (e) {
        e.preventDefault();
        BootstrapDialog.show({
            title: <?= json_encode($this->__("backend.content.wizard.create.title")) ?>,
            message: $('<div></div>').load($(this).attr('href') + '&column_id=' + $(this).closest('.container-receiver').data('id'))
        })
    });

    $('.content-operation-link').on('click', function(ev) {
        ev.preventDefault();

        var url = $(this).attr('href');

        $.getJSON(url, function (data) {
            if (data.operation == "delete") {
                console.log(data);
                $('#panel-backend-content-' + data.id).remove();
            }
            if (data.operation == "edit") {
                $('#content').html(data.html);
            }
        });
    });

    $('.content-drag-sender').pep({
        useCSSTranslation: true,
        droppable: '.content-drag-receiver',
        elementsWithInteraction: '.no-pep',
        place: false,
        revert: true,
        revertIf: function (ev, obj){
            return !this.activeDropRegions.length;
        },
        cssEaseDuration: 200,
        rest: function (ev, obj) {
            if ( this.activeDropRegions.length > 0 ) {
                // get first drop region and set the element as it's child
                var target = $(this.activeDropRegions[0]).closest('.container-receiver');
                var beforeId = target.prevObject.next(".panel-backend-content").data('id');
                if (target) {
                    $.getJSON('<?= $this->helper("Url")->linkToAction("Backend", "Content", "updateContainer") ?>',
                        { parent_id: target.data('parent'), column_id: target.data('id'), id: this.$el.data('id'), before_id: beforeId })
                        .done( function (data) {
                        if (data.success == 1) {

                        }
                    });
                    $(this.activeDropRegions[0]).after(this.$el);
                    obj.cssX = 0;
                    obj.cssY = 0;
                    this.$el.removeAttr('style');
                }
            }
            $('.content-drag-receiver').remove();
        },
        start: function (ev, obj) {
            $('.container-receiver').prepend($('<div class="content-drag-receiver receiver-on"></div>'));
            $('.panel-backend-content').each(function(index, item) {
                if (!$(item).is(obj.$el)) {
                    $(item).after($('<div class="content-drag-receiver receiver-on"></div>'));
                }
            });
        },
        stop: function (ev, obj) {
        }
    });
</script>