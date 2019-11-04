<?php
if (!isset($_GET['path']) || !$_GET['path']) {
  require('controllers/books.php');
  if (!isset($_GET['action']) || !$_GET['action']) {
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $sort = isset($_GET['sort']) ? (string) $_GET['sort'] : 'title';
    $query = isset($_GET['q']) ? (string) $_GET['q'] : null;
    listBooks($page, $sort, $query);
  } else if ($_GET['action'] === 'edit' && isset($_GET['id'])) {
    editBook((int) $_GET['id']);
  } else if ($_GET['action'] === 'add') {
    newBook();
  } else if ($_GET['action'] === 'delete' && isset($_GET['id'])) {
    deleteBook((int) $_GET['id']);
  } else {
    header('Location: ./');
  }
} else {
  switch ((string) $_GET['path']) {
    default:
      require('views/404.php');
  }
}
