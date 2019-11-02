<?php
if (!isset($_GET['action'])) {
  header('Location: ?action=books');
}
$action = (string) $_GET['action'];

switch ($action) {
  case 'books':
    require('controllers/books.php');
    if (isset($_GET['id'])) {
      showBook($_GET['id']);
    } else {
      $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
      $sort = isset($_GET['sort']) ? (string) $_GET['sort'] : null;
      listBooks($page, $sort);
    }
    break;
  default:
    require('views/404.php');
}
