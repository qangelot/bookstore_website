<?php

require('models/countries.php');

$breadcrumb = array(array(
  'name' => "Pays",
  'link' => '?path=countries'
));

function listCountries(): void
{
  global $breadcrumb;
  $breadcrumb[0]['active'] = true;
  $countries = getCountries(true);
  require('views/countries.php');
}

/**
 * @param int $id Country id
 */
function editCountry (int $id): void
{
  global $breadcrumb;

  if (isset($_POST['id'])) {
    setCountry((int) $_POST['id'], $_POST);
  }

  $country = getCountry($id);

  $breadcrumb[] = array(
    'active' => true,
    'name' => "Editer un pays : " . $country['name'],
  );

  require('views/country.php');
}

function newCountry(): void
{
  global $breadcrumb;
  $breadcrumb[] = array(
    'active' => true,
    'name' => "Ajouter un pays",
  );

  if (isset($_POST['country'])) {
    if ($id = addCountry($_POST)) {
      header('Location: ./?path=countries&action=edit&id=' . $id);
    }
  }

  require('views/country.php');
}

/**
 * @param int $id Book id
 */
function unactiveCountry (int $id): void
{
  if (disableCountry($id, $_GET['active'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    require('views/500.php');
  }
}
