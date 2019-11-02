<?php
$file = file_get_contents('json/books.json');
$books = json_decode($file, true);
$limit = 20;

/**
 * @param int $page
 * @return array[]
 */
function getBooks(int $page = 1): array
{
  global $books;
  global $limit;
  $offset = ($page - 1) * $limit;
  return array_slice($books, $offset, $limit);
}

/**
 * @param string $id Book id
 * @throws Exception
 * @return array
 */
function getBook(string $id): array
{
  global $books;

  if (!isset($books[$id])) {
    throw new Exception("Invalid id:" . $id);
  }

  return $books[$id];
}

/**
 * @return int
 */
function countBooks (): int
{
  global $books;

  return count($books);
}
