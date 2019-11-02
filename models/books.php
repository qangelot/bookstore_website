<?php
$file = file_get_contents('json/books.json');
$books = json_decode($file, true);
$limit = 20;

/**
 * @param int $page
 * @param string $sort (optional)
 * @return array[]
 */
function getBooks(int $page = 1, ?string $sort): array
{
  global $books;
  global $limit;
  $data = $books;
  if ($sort) {
    usort($data, function ($a, $b) {
      global $sort;
      return $a[$sort] > $b[$sort];
    });
  }
  $offset = ($page - 1) * $limit;
  return array_slice($data, $offset, $limit);
}

/**
 * @return int
 */
function countBooks (): int
{
  global $books;

  return count($books);
}

/**
 * @param string $id Book id
 * @throws Exception
 * @return array
 */
function getBook(string $id): array
{
  global $books;

  $book = null;

  foreach ($books as $value) {
    if ($value['id'] === $id) {
      $book = $value;
      break;
    }
  }

  if (!$book) {
    throw new Exception("Invalid id:" . $id);
  }

  return $book;
}
