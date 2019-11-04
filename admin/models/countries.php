<?php

require_once('../utils/db.php');

/**
 * @param bool $withInactive
 * @return array[]
 */
function getCountries($withInactive = false): array
{
  $db = dbConnect();
  $stmt = $db->prepare('SELECT * FROM countries ' . (!$withInactive ? 'WHERE active = true' : '') . ' ORDER BY name');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param int $id Country id
 * @throws Exception
 * @return array
 */
function getCountry(int $id): array
{
  $db = dbConnect();

  $stmt = $db->prepare('SELECT * FROM countries WHERE id = :id');

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  return $stmt->fetch();
}

/**
 * @param array $data
 * @return int
 */
function addCountry(array $data): int
{
    $db = dbConnect();

    $stmt = $db->prepare('INSERT INTO countries (name) VALUES (:name)');

    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

    $stmt->execute();

    return $db->lastInsertId();
}

/**
 * @param int $id Country id
 * @param array $data
 * @return int
 */
function setCountry(int $id, array $data): int
{
    $db = dbConnect();

    $stmt = $db->prepare('UPDATE countries SET name = :name WHERE id = :id');

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

    return $stmt->execute();
}

/**
 * @param int $id Country id
 * @param bool $active
 * @return int
 */
function disableCountry(int $id, bool $active): int
{
  $db = dbConnect();

  $stmt = $db->prepare('UPDATE countries SET active = :active WHERE id = :id');

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);

  $stmt->execute();

  return $stmt->rowCount();
}
