<?php

require('models/authors.php');
require('models/books.php');
require('models/countries.php');
require('models/languages.php');

$breadcrumb = array(array(
  'name' => "Livres",
  'link' => './'
));

/**
 * @param int $page
 * @param string $sort
 * @param string (optional) $query
 */
function listBooks(int $page = 1, string $sort, ?string $query): void
{
  global $breadcrumb;
  global $limit;
  $sortValues = array(
    array('value' => 'title', 'name' => "Titre"),
    array('value' => 'author', 'name' => "Auteur"),
    array('value' => 'year', 'name' => "Date de parution"),
  );
  $breadcrumb[0]['active'] = true;
  $pages = (int) ceil(countBooks($query) / $limit);
  $books = getBooks($page, $sort, $query);
  require('views/books.php');
}

/**
 * @param string $id Book id
 */
function editBook (string $id): void
{
  if (isset($_POST['id'])) {
    setBook((int) $_POST['id'], $_POST);
  }
  $book = getBook($id);
  $authors = getAuthors();
  $countries = getCountries();
  $languages = getLanguages();

  require('views/book.php');
}

function newBook()
{
  if (isset($_POST['book'])) {
    if ($id = addBook($_POST)) {
      header('Location: ./?action=edit&id=' . $id);
    }
  }

  $authors = getAuthors();
  $countries = getCountries();
  $languages = getLanguages();

  require('views/book.php');
}
