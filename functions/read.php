<?php
// Koneksi ke database
require_once (__DIR__ . "/connection.php");
$connection = getConnection();

function query($query)
{
  global $connection;
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Error in query: " . mysqli_error($connection));
  }
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

?>