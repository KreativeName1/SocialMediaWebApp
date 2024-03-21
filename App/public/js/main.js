let inDialog = false;
$(document).ready(function() {
  $('#profile-img').click(function() {
    inDialog = true;
    if ($(window).width() <= 1500 + 200) {
      $('aside').animate({
        right: '0px'
      }, 350);
    }
  });
  $('#aside-close').click(function() {
    inDialog = false;
    $('aside').animate({
      right: '-300px'
    }, 350);
  });
});