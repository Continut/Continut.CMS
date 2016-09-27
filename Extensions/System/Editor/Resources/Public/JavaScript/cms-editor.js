$(function() {
    // outline elements
    /*$('[data-continut-cms-id]').each(function() {
     var contentType = $(this).attr('data-continut-cms-type');
     switch (contentType) {
     case 'container': $(this).css('outline', '2px dotted black'); $(this).css('outline-offset', '4px'); break;
     default: $(this).css('outline', '2px dotted red'); $(this).css('outline-offset', '4px');
     }
     });*/
    $('[data-continut-cms-id]').hover(function(e) {
        //e.stopPropagation();
        var borderSize = 4;
        var $t         = $(this);
        var width      = $t.outerWidth();
        var height     = $t.outerHeight();
        var left       = $t.offset().left;
        var top        = $t.offset().top;

        //$('#continut_hover_selector').width(width - borderSize).height(height - borderSize).css('left', left).css('top', top).show();
        $(this).css('outline', '2px solid gray');
        $(this).css('outline-offset', '4px');
        /*iframe.find('#continut_hover_selector1').width(borderSize).height(height).css('left', topX).css('top', topY).show();
         iframe.find('#continut_hover_selector2').width(borderSize).height(height).css('left', topX + width - borderSize).css('top', topY).show();
         iframe.find('#continut_hover_selector3').width(width).height(borderSize).css('left', topX).css('top', topY).show();
         iframe.find('#continut_hover_selector4').width(width).height(borderSize).css('left', topX).css('top', topY + height - borderSize).show();*/
    },function() {
        $(this).css('outline', '');
        //$(this).css('outline', '2px dotted gray');
        //$(this).css('outline-offset', '4px');
        //$('#continut_hover_selector').hide();
        /*iframe.find('#continut_hover_selector2').hide();
         iframe.find('#continut_hover_selector3').hide();
         iframe.find('#continut_hover_selector4').hide();*/
        //$('#continut_hover_panel').hide();
    });
    $('[data-continut-cms-id]').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('[data-continut-cms-id]').each(function() {
            $(this).removeClass('continut-cms-element-selected');
        });
        $(this).toggleClass('continut-cms-element-selected');
        $('#continut_hover_panel').css('left', $(this).offset().left).css('top', $(this).offset().top).show();
    });
});