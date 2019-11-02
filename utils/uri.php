<?php
/**
 * @param string $queries Queries string url
 * @param array[] $params (optional) Queries string to add (key => value)
 * @param array $unset (optional) Queries string to remove
 * @return string Queries string url
 */
function getQueries(string $queries, ?array $params = array(), ?array $unset = array()): string
{
  parse_str($queries, $data);
  foreach ($unset as $value) {
    if (isset($data[$value])) {
      unset($data[$value]);
    }
  }
  $result = array_merge($data, $params);
  return '?' . http_build_query($result);
}
