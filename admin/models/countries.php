<?php

require_once('../utils/db.php');

/**
 * @return array[]
 */
function getCountries(): array
{
  $db = dbConnect();
  $stmt = $db->prepare('SELECT * FROM countries ORDER BY name');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
