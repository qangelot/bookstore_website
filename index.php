<?php
if (!isset($_GET['action']) || !$_GET['action']) {
  require('controllers/books.php');
  if (isset($_GET['id'])) {
    showBook($_GET['id']);
  } else {
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $sort = isset($_GET['sort']) ? (string) $_GET['sort'] : 'title';
    $query = isset($_GET['q']) ? (string) $_GET['q'] : null;
    listBooks($page, $sort, $query);
  }
} else {
  switch ((string) $_GET['action']) {
    default:
      require('views/404.php');
  }
}
