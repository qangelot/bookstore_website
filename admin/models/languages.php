<?php

require_once('../utils/db.php');

/**
 * @return array[]
 */
function getLanguages(): array
{
  $db = dbConnect();
  $stmt = $db->prepare('SELECT * FROM languages ORDER BY name');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
