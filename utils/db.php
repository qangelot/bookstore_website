<?php

function dbConnect()
{
  try {
    $db = new PDO('mysql:host=localhost;dbname=books', 'root', '');
    return $db;
  } catch(Exception $e) {
    $message = $e->getMessage();
    require('views/500.php');
    die;
  }
}
