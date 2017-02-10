$(function() {
  // toggle fieldsets
  $('.expand').on('click', function(e) {
    e.preventDefault();
    $(this).find('.fa').toggleClass('fa-chevron-down fa-chevron-up');
    $(this).parent().next('.fields-list').toggle();
  });

  // toggle left block
  $('#button_toggle_nav_block_left').on('click', function(e) {
    e.preventDefault();
    $('#nav_block_left').toggle();
    $(this).find('.fa').toggleClass('fa-chevron-left fa-chevron-right');
    $('#continut_cms_page').toggleClass('fullpage nav-left')
  });

  // toggle right block
  $('#button_toggle_nav_block_right').on('click', function(e) {
    e.preventDefault();
    $('#nav_block_right').toggle();
    $(this).find('.fa').toggleClass('fa-chevron-right fa-chevron-left');
    $('#continut_cms_page').toggleClass('fullpage nav-right')
  });

  // dialog window test
  $('[data-open-dialog]').on('click', function(e) {
    e.preventDefault();
    var dialog = $('#' + $(this).attr('data-open-dialog'));
    $('#overlay').show();
    dialog.addClass('show');
    dialog.find('[data-dialog-close]').on('click', function() {
      $('#overlay').hide();
      dialog.removeClass('show');
    });
  });

  // mobile test
  $('#button_mobile_test').on('click', function(e) {
    e.preventDefault();
    $('#continut_cms_page').toggleClass('mobile-view nexus-5');
  });
});
