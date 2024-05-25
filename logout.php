<?php

session_start();

require_once (__DIR__ . "/functions/authentication.php");

if (isLogged()) {
  logout();
}

header("Location:login.php");

