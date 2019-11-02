<?php

require('models/books.php');

$breadcrumb = array(array(
  'name' => "Livres",
  'link' => '?action=books'
));

function listBooks(): void
{
  global $breadcrumb;
  $breadcrumb[0]['active'] = true;
  $books = getBooks();
  require ('views/books.php');
}

/**
 * @param string $id Book id
 */
function showBook (string $id): void
{
  try {
    $book = getBook($id);
    global $breadcrumb;
    $breadcrumb[] = array(
      'active' => true,
      'name' => $book['title'],
      'link' => '?action=books&id=' . $id
    );
    require ('views/book.php');
  } catch (Exception $e) {
    require('views/404.php');
  }
}
