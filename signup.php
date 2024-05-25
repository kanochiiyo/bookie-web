<?php
require_once (__DIR__ . "/functions/authentication.php");


if (isset($_POST["register"])) {
  $result = register($_POST);
  if ($result) {
    echo "<script>
    alert('Sign up berhasil.');
    document.location.href = 'login.php';
    </script>";
  }
}

if (isLogged()) {
  header("Location:index.php");
}

include (__DIR__ . "/templates/header.php");
?>

<main id="login" class="font-inter d-flex align-items-center justify-content-center">
  <div class="container-fluid m-0" style="height: 100vh;">
    <div class="row align-items-center" style="height: 100%;">
      <div class="col-lg-6 d-flex align-items-center justify-content-center">
        <div class="container">
          <h4 class="font-raleway fw-bold" style="padding-left: 125px">Let's go to the Home of Knowledge</h4>
          <h4 class="font-raleway fw-bold" style="padding-left: 125px">Sign up now</h4>
          <p style="padding-left: 125px">Already have an account? <a href="login.php" id="lp-link">Log in here</a>
          </p>
          <form id="loginForm" class="login-form-container float-end" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="input form-control" id="name" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="input form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="input form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="input form-control" id="password" name="password">
            </div>
            <div class="mb-3">
              <label for="confirmpassword" class="form-label">Confirm Password</label>
              <input type="password" class="input form-control" id="confirmpassword" name="confirmpassword">
            </div>
            <button type="submit" name="register" id="register" class="links-bg btn btn-primary w-100">Sign Up</button>
          </form>
        </div>
      </div>
      <div class="col-lg-6 p-0">
        <img src="assets/signup.png" alt="Sign up img" id="signup-img" class="float-end object-fit-cover min-vh-100">
      </div>
    </div>
  </div>
</main>

<?php
include (__DIR__ . "/templates/footer.php");
?>