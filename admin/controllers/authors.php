<?php

require('models/authors.php');

$breadcrumb = array(array(
  'name' => "Auteurs",
  'link' => '?path=authors'
));

function listAuthors(): void
{
  global $breadcrumb;
  $breadcrumb[0]['active'] = true;
  $authors = getAuthors(true);
  require('views/authors.php');
}

/**
 * @param int $id Author id
 */
function editAuthor (int $id): void
{
  global $breadcrumb;

  if (isset($_POST['id'])) {
    setAuthor((int) $_POST['id'], $_POST);
  }

  $author = getAuthor($id);

  $breadcrumb[] = array(
    'active' => true,
    'name' => "Editer un auteur : " . $author['name'],
  );

  require('views/author.php');
}

function newAuthor(): void
{
  global $breadcrumb;
  $breadcrumb[] = array(
    'active' => true,
    'name' => "Ajouter un auteur",
  );

  if (isset($_POST['author'])) {
    if ($id = addAuthor($_POST)) {
      header('Location: ./?path=authors&action=edit&id=' . $id);
    }
  }

  require('views/author.php');
}

/**
 * @param int $id Book id
 */
function unactiveAuthor (int $id): void
{
  if (disableAuthor($id, $_GET['active'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    require('views/500.php');
  }
}
