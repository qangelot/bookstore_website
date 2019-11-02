<?php
$action = isset($_GET['action']) ? (string) $_GET['action'] : 'books';

switch ($action) {
  case 'books':
    require('controllers/books.php');
    if (isset($_GET['id'])) {
      showBook($_GET['id']);
    } else {
      $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
      listBooks($page);
    }
    break;
  default:
    require('views/404.php');
}
