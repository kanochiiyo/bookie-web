<?php
// Koneksi ke database
require_once (__DIR__ . "/connection.php");
$connection = getConnection();

// Untuk read data
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

// Fungsi flash session
function setFlash($key, $message)
{
  if (!isset($_SESSION)) {
    session_start();
  }
  $_SESSION['flash'][$key] = $message;
}

function getFlash($key)
{
  if (!isset($_SESSION)) {
    session_start();
  }
  if (isset($_SESSION['flash'][$key])) {
    $message = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $message;
  }
  return null;
}

// Function add data
function addData($rows)
{
}

?>