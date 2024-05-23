<?php
include (__DIR__ . "/templates/header.php");
?>

<main id="login" class="font-inter d-flex align-items-center justify-content-center">
  <div class="container-fluid" style="height: 100vh;">
    <div class="row align-items-center" style="height: 100%;">
      <div class="col-lg-6 p-0">
        <img src="assets/login.png" alt="Log in img" id="login-img" class="float-start object-fit-cover h-100">
      </div>
      <div class="col-lg-6 d-flex align-items-center justify-content-center">
        <div class="container">
          <h4 class="font-raleway fw-bold" style="padding-right: 125px">You're entering the Bookie Shelter</h4>
          <h4 class="font-raleway fw-bold" style="padding-right: 125px">Log in now</h4>
          <p style="padding-right: 125px">New to Bookie? <a href="signup.php" id="lp-link">Sign up here</a>
          </p>
          <form id="loginForm" class="login-form-container float-start">
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

    </div>
  </div>
</main>

<?php
include (__DIR__ . "/templates/footer.php");
?>