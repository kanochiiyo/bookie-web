<?php
require_once 'connection.php';
$connection = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $book_id = $_POST["book_id"];
  $qty = $_POST["qty"];
  $type = $_POST["type"];
  $date = new DateTime();




}
?>