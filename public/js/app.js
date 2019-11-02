$(function () {
  $('#sortBooks').change(function () {
    window.location = $(this).closest('form').attr('action') + '&sort=' + $(this).val();
  });
});
