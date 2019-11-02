<?php
$file = file_get_contents('json/books.json');
$books = json_decode($file, true);

/**
 * @return array[]
 */
function getBooks(): array
{
  global $books;
  return $books;
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
