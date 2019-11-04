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

  $('[data-remove-book]').click(function (e) {
    e.preventDefault();
    var modal = $($(this).data('removeBook'));
    var title = $(this.closest('[data-book]')).find('[data-title]').text();
    var url = $(this).attr('href');
    modal.find('#removeBookTitle').text(title);
    modal.modal('show');
    modal.find('[data-success]').one('click', function () {
      $.ajax({
        type: 'POST',
        url: url,
        success: function () {
          document.location.reload(true);
        }
      });
    });
  });
});
