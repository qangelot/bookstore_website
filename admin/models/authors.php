<?php

require_once('../utils/db.php');

/**
 * @param bool $withInactive
 * @return array[]
 */
function getAuthors($withInactive = false): array
{
  $db = dbConnect();
  $stmt = $db->prepare('SELECT * FROM authors ' . (!$withInactive ? 'WHERE active = true' : '') . ' ORDER BY name');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param int $id Author id
 * @throws Exception
 * @return array
 */
function getAuthor(int $id): array
{
  $db = dbConnect();

  $stmt = $db->prepare('SELECT * FROM authors WHERE id = :id');

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  return $stmt->fetch();
}

/**
 * @param array $data
 * @return int
 */
function addAuthor(array $data): int
{
    $db = dbConnect();

    $stmt = $db->prepare('INSERT INTO authors (name) VALUES (:name)');

    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

    $stmt->execute();

    return $db->lastInsertId();
}

/**
 * @param int $id Author id
 * @param array $data
 * @return int
 */
function setAuthor(int $id, array $data): int
{
    $db = dbConnect();

    $stmt = $db->prepare('UPDATE authors SET name = :name WHERE id = :id');

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

    return $stmt->execute();
}

/**
 * @param int $id Author id
 * @param bool $active
 * @return int
 */
function disableAuthor(int $id, bool $active): int
{
  $db = dbConnect();

  $stmt = $db->prepare('UPDATE authors SET active = :active WHERE id = :id');

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);

  $stmt->execute();

  return $stmt->rowCount();
}
