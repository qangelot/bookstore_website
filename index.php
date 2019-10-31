<?php
$action = (string) $_GET['action'];

switch ($action) {
  default:
    require('views/404.php');
}
