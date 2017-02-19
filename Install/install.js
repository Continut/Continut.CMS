function submitForm(form) {
    $('.submit, .error').addClass('ajax');
    $.post(form.attr('action'), form.serialize(), function(data) {
        $('#steps_container').html(data);
    })
    .fail(function() {
        $('.submit, .error').removeClass('ajax');
    })
    .always(function() {
        $('.submit, .error').removeClass('ajax');
    });
}

$(function() {
    $(document).on('submit', '.form', function (event) {
        event.preventDefault();

        submitForm($(this));
    });

    $(document).on('click', '.error', function (event) {
        event.preventDefault();

        var $form = $('.form');

        $form.attr('action', $(this).data('action'));
        submitForm($form);
    });

    $(document).on('change', '#db_driver', function (event) {
        if ($(this).val() == 'sqlite') {
            $('#db_fields').hide();
        } else {
            $('#db_fields').show();
        }
    })
});