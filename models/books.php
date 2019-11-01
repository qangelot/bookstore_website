<?php
/**
 * @return array
 */
function getBooks()
{
  $file = file_get_contents('json/books.json');
  return json_decode($file, true);
}
