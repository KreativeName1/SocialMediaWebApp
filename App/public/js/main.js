let inDialog = false;
$(document).ready(function() {
  $('#profile-img').click(function() {
    inDialog = true;
    $('#profile-menu').remove();
    var div = $('<div id="profile-menu" class="menu"></div>');
    $.ajax({
      url: '/get/getLoggedUser.php',
      type: 'GET',
      success: function(data) {
        var user = JSON.parse(data);
        div.append("<h3>" + user.firstname + " " + user.lastname + "</h3>");
        div.append("<div>");
        div.append("<a href='?View=profile&id="+user.id+"'>Profile</a>");
        div.append("<a href='?View=settings'>Settings</a>");
        div.append("<a href='?View=following&id="+user.id+"'>Following</a>");
        div.append("<a href='?View=logout'>Logout</a>");
      }
    });
    $('#profile-img').after(div);
  });
  $(document).mouseup(function (e) {
    if ($(e.target).
        closest(".menu").
        length=== 0) {
        $(".menu").remove();
    }
});
});