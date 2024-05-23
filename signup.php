<?php
include (__DIR__ . "/templates/header.php");
?>

<main id="login" class="font-inter d-flex align-items-center justify-content-center">
  <div class="container-fluid" style="height: 100vh;">
    <div class="row align-items-center" style="height: 100%;">
      <div class="col-lg-6 d-flex align-items-center justify-content-center">
        <div class="container">
          <h4 class="font-raleway fw-bold" style="padding-left: 125px">Let's go to the Home of Knowledge</h4>
          <h4 class="font-raleway fw-bold" style="padding-left: 125px">Sign up now</h4>
          <p style="padding-left: 125px">Already have an account? <a href="login.php" id="lp-link">Log in here</a>
          </p>
          <form id="loginForm" class="login-form-container float-end">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="email" class="input form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="input form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="input form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="links-bg btn btn-primary w-100">Submit</button>
          </form>
        </div>
      </div>
      <div class="col-lg-6 p-0">
        <img src="assets/signup.png" alt="Sign up img" id="signup-img" class="float-end object-fit-cover h-100">
      </div>
    </div>
  </div>
</main>

<?php
include (__DIR__ . "/templates/footer.php");
?>