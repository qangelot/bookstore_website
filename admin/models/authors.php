<?php

require_once('../utils/db.php');

/**
 * @return array[]
 */
function getAuthors(): array
{
  $db = dbConnect();
  $stmt = $db->prepare('SELECT * FROM authors ORDER BY name');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
