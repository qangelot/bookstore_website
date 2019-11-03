$(function () {

  var searchForm = $('#search'),
      searchField = searchForm.find('[type="search"]');

  searchForm.submit(function (e) {
    e.preventDefault();
    if (searchField.val()) {
      search();
    }
  });

  searchField.on('search', search);

  function search () {
    window.location = '?q=' + searchField.val();
  }

  $('#sortBooks').change(function () {
    window.location = $(this).closest('form').attr('action') + '&sort=' + $(this).val();
  });
});
