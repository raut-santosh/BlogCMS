// This is the code to check all checkboxes when user cliks on it by jquery.
$(document).ready(function () {
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });

  // loading screen
  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);
  $("#load-screen")
    .delay(700) //default values for delay 700 and fadeout 600
    .fadeOut(600, function () {
      $(this).remove();
    });
});
