<?php
// mengambil fungsi koneksi dari connection
require_once (__DIR__ . "/connection.php");
require_once (__DIR__ . "/functions.php");

function register($formData)
{
  $connection = getConnection();

  $name = $formData["name"];
  $username = strtolower(stripslashes($formData["username"]));
  $email = strtolower($formData["email"]);
  $password = mysqli_real_escape_string($connection, $formData["password"]);
  $confirmpassword = mysqli_real_escape_string($connection, $formData["confirmpassword"]);

  // cek udah ada yg make belom usernamenya
  $result = $connection->query("SELECT username FROM user WHERE username = '$username'");
  if ($result->fetch_assoc()) {
    setFlash('error', 'Login gagal. Username sudah terdaftar.');
    return false;
  }

  // kalo password & confirm nggak sama
  if ($password != $confirmpassword) {
    setFlash('error', 'Login gagal. Password salah.');
    return false;
  }

  // enkripsi password pake password hash
  $password = password_hash($password, PASSWORD_DEFAULT);

  $connection->query("INSERT INTO user VALUES (null, '$username', '$name', '$email', '$password', 0)");

  return ($connection->affected_rows) ? true : false;
}

function loginAttempt($formData)
{
  $connection = getConnection();

  $username = strtolower($formData["username"]);
  $password = $formData["password"];

  $result = $connection->query("SELECT * FROM user WHERE username='$username'");

  // kalo username gk ditemuin gaiso login
  if ($result->num_rows !== 1) {
    setFlash('error', 'Login gagal. Username tidak ditemukan.');
    return false;
  }

  $userData = $result->fetch_object();

  // password salah gaiso login juga
  if (!password_verify($password, $userData->password)) {
    setFlash('error', 'Login gagal. Password salah');
    return false;
  }

  $_SESSION['id'] = $userData->id;
  $_SESSION['username'] = $userData->username;
  $_SESSION['login'] = true;

  return true;
}


function isLogged()
{
  if (isset($_SESSION['login'])) {
    return true;
  }
  return false;
}

function isAdmin()
{
  $connection = getConnection();

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $result = $connection->query("SELECT * FROM user WHERE username = '$username'");

    $userData = $result->fetch_object();

    if ($userData->isAdmin === "1") {
      return true;
    }
  }
  return false;
}

function logout(): void
{
  session_destroy();
}
?>