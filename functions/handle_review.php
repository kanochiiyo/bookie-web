<?php
require_once 'authentication.php';
$connection = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $content = htmlspecialchars($_POST["reviewContent"]);
  $rating = $_POST["reviewRating"];


}
?>