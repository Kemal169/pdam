(function ($) {
  "use strict";
  $(function () {
    $(".file-upload-browse").on("click", function () {
      var file = $(this)
        .parent()
        .parent()
        .parent()
        .find(".file-upload-default");
      file.trigger("click");
    });
    $(".file-upload-default").on("change", function () {
      $(this)
        .parent()
        .find(".form-control")
        .val(
          $(this)
            .val()
            .replace(/C:\\fakepath\\/i, "")
        );
    });
  });
})(jQuery);

$(document).on("click", ".file-upload-browse", function () {
  var file = $(this).closest(".form-group").find(".file-upload-default");
  file.trigger("click");
});

$(".file-upload-default").on("change", function () {
  $(this)
    .closest(".form-group")
    .find(".file-upload-info")
    .val(
      $(this)
        .val()
        .replace(/C:\\fakepath\\/i, "")
    );
});
