<?php

require('models/languages.php');

$breadcrumb = array(array(
  'name' => "Langues",
  'link' => '?path=languages'
));

function listLanguages(): void
{
  global $breadcrumb;
  $breadcrumb[0]['active'] = true;
  $languages = getLanguages(true);
  require('views/languages.php');
}

/**
 * @param int $id Language id
 */
function editLanguage (int $id): void
{
  global $breadcrumb;

  if (isset($_POST['id'])) {
    setLanguage((int) $_POST['id'], $_POST);
  }

  $language = getLanguage($id);

  $breadcrumb[] = array(
    'active' => true,
    'name' => "Editer une langue : " . $language['name'],
  );

  require('views/language.php');
}

function newLanguage(): void
{
  global $breadcrumb;
  $breadcrumb[] = array(
    'active' => true,
    'name' => "Ajouter une langue",
  );

  if (isset($_POST['language'])) {
    if ($id = addLanguage($_POST)) {
      header('Location: ./?path=languages&action=edit&id=' . $id);
    }
  }

  require('views/language.php');
}

/**
 * @param int $id Book id
 */
function unactiveLanguage (int $id): void
{
  if (disableLanguage($id, $_GET['active'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    require('views/500.php');
  }
}
