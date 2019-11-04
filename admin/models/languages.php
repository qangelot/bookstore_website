<?php

require_once('../utils/db.php');

/**
 * @param bool $withInactive
 * @return array[]
 */
function getLanguages($withInactive = false): array
{
  $db = dbConnect();
  $stmt = $db->prepare('SELECT * FROM languages ' . (!$withInactive ? 'WHERE active = true' : '') . ' ORDER BY name');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param int $id Language id
 * @throws Exception
 * @return array
 */
function getLanguage(int $id): array
{
  $db = dbConnect();

  $stmt = $db->prepare('SELECT * FROM languages WHERE id = :id');

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  return $stmt->fetch();
}

/**
 * @param array $data
 * @return int
 */
function addLanguage(array $data): int
{
    $db = dbConnect();

    $stmt = $db->prepare('INSERT INTO languages (name) VALUES (:name)');

    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

    $stmt->execute();

    return $db->lastInsertId();
}

/**
 * @param int $id Language id
 * @param array $data
 * @return int
 */
function setLanguage(int $id, array $data): int
{
    $db = dbConnect();

    $stmt = $db->prepare('UPDATE languages SET name = :name WHERE id = :id');

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

    return $stmt->execute();
}

/**
 * @param int $id Language id
 * @param bool $active
 * @return int
 */
function disableLanguage(int $id, bool $active): int
{
  $db = dbConnect();

  $stmt = $db->prepare('UPDATE languages SET active = :active WHERE id = :id');

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);

  $stmt->execute();

  return $stmt->rowCount();
}
