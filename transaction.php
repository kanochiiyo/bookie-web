<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");

if (!isLogged()) {
  header("Location:login.php");
}

include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
?>

<!-- isi disini -->

<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>