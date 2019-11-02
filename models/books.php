<?php
$file = file_get_contents('json/books.json');
$books = json_decode($file, true);
$limit = 20;

/**
 * @param int $page
 * @param string $sort
 * @param string $query (optional)
 * @return array[]
 */
function getBooks(int $page = 1, string $sort, ?string $query): array
{
  global $limit;
  $data = _getBooks($query);
  usort($data, function ($a, $b) {
    global $sort;
    return $a[$sort] > $b[$sort];
  });
  $offset = ($page - 1) * $limit;
  return array_slice($data, $offset, $limit);
}

/**
 * @param string $query (optional)
 * @return array[]
 */
function _getBooks(?string $query)
{
  global $books;
  $data = array();
  if ($query) {
    $pattern = '/' . $query . '/i';
    foreach ($books as $book) {
      if (preg_match($pattern, $book['title'])) {
        $data[] = $book;
      }
    }
  } else {
    $data = $books;
  }
  return $data;
}

/**
 * @param string $query (optional)
 * @return int
 */
function countBooks(?string $query): int
{
  return count(_getBooks($query));
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
