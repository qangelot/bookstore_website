<?php

require('models/books.php');

$breadcrumb = array(array(
  'name' => "Livres",
  'link' => '?action=books'
));

function listBooks(int $page = 1): void
{
  global $breadcrumb;
  global $limit;
  $breadcrumb[0]['active'] = true;
  $pages = (int) ceil(countBooks() / $limit);
  $books = getBooks($page);
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
    if (isset($_SERVER['HTTP_REFERER'])) {
      parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $queries);
      if ($queries['action'] === 'books' && !isset($queries['id'])) {
        $searchResult = $_SERVER['HTTP_REFERER'];
      }
    }
    require ('views/book.php');
  } catch (Exception $e) {
    require('views/404.php');
  }
}
