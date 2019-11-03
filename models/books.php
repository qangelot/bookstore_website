<?php
require('utils/db.php');

$file = file_get_contents('json/books.json');
$books = json_decode($file, true);
$limit = 20;

/**
 * @param int $page
 * @param string $orderBy
 * @param string $query (optional)
 * @return array[]
 */
function getBooks(int $page = 1, string $orderBy, ?string $query): array
{
  global $limit;

  $db = dbConnect();

  $request = 'SELECT
    books.id,
    books.title,
    books.image,
    books.year,
    authors.name as author,
    countries.name as country,
    languages.name as language
    FROM books
    LEFT JOIN authors
    ON books.author_id = authors.id
    LEFT JOIN countries
    ON books.country_id = countries.id
    LEFT JOIN languages
    ON books.language_id = languages.id
  ';

  $params = array();

  if ($query) {
    $request .= ' WHERE books.title LIKE :query';
    $params[':query'] = '%' . $query . '%';
  }

  $offset = ($page - 1) * $limit;

  $stmt = $db->prepare($request . ' ORDER BY ' . $orderBy . ' LIMIT ' . $offset . ', ' . $limit);

  if (!empty($params)) {
    foreach ($params as $key => $value) {
      $stmt->bindParam($key, $value);
    }
  }

  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param string $query (optional)
 * @return int
 */
function countBooks(?string $query): int
{
  $db = dbConnect();

  $request = 'SELECT COUNT(*) FROM books';

  $params = array();

  if ($query) {
    $request .= ' WHERE title LIKE :query';
    $params[':query'] = '%' . $query . '%';
  }

  $stmt = $db->prepare($request);

  if (!empty($params)) {
    foreach ($params as $key => $value) {
      $stmt->bindParam($key, $value);
    }
  }

  $stmt->execute();

  return $stmt->fetchColumn();
}

/**
 * @param string $id Book id
 * @throws Exception
 * @return array
 */
function getBook(string $id): array
{
  $db = dbConnect();

  $stmt = $db->prepare('SELECT
    books.id,
    books.title,
    books.image,
    books.year,
    books.pages,
    books.wikipedia_link as wikipedia,
    authors.name as author,
    countries.name as country,
    languages.name as language
    FROM books
    LEFT JOIN authors
    ON books.author_id = authors.id
    LEFT JOIN countries
    ON books.country_id = countries.id
    LEFT JOIN languages
    ON books.language_id = languages.id
    WHERE books.id = :id
  ');

  $stmt->bindParam(':id', $id);

  $stmt->execute();

  return $stmt->fetch();
}
