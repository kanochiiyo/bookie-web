<?php

session_start();

require_once (__DIR__ . "/functions/authentication.php");

if (isLogged()) {
  header("Location:index.php");
}


if (isset($_POST["login"])) {
  $result = loginAttempt($_POST);
  if ($result) {
    header("Location:index.php");
  } else {
    header("Location:login.php");
  }
}

if (isset($_GET['message'])) {
  if ($_GET['message'] == "not_admin") {
    ?>
    <script>
      alert('Hanya Admin yang bisa mengakses halaman admin!')
    </script>
    <?php
  } elseif ($_GET['message'] == "login_admin") {
    ?>
    <script>
      alert('Silahkan login untuk mengakses halaman admin!')
    </script>
    <?php
  }
}

include (__DIR__ . "/templates/header.php");
?>

<main id="login" class="font-inter d-flex align-items-center justify-content-center min-vh-100">
  <div class="container-fluid m-0" style="height: 100vh">
    <div class="row align-items-center">
      <div class="col-lg-6 p-0">
        <img src="assets/login.png" alt="Log in img" id="login-img" class="float-start object-fit-cover min-vh-100">
      </div>
      <div class="col-lg-6 d-flex align-items-center justify-content-center">
        <div class="container">
          <h4 class="font-raleway fw-bold" style="padding-right: 125px">You're entering the Bookie Shelter</h4>
          <h4 class="font-raleway fw-bold" style="padding-right: 125px">Log in now</h4>
          <p style="padding-right: 125px">New to Bookie? <a href="signup.php" id="lp-link">Sign up here</a>
          </p>
          <form id="loginForm" class="login-form-container float-start" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="input form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="input form-control" id="password" name="password">
            </div>
            <button type="submit" class="links-bg btn btn-primary w-100" name="login">Login</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</main>

<?php
include (__DIR__ . "/templates/footer.php");
?>