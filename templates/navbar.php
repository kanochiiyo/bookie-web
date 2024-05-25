<?php session_start(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top shadow-sm p-3 mb-5 bg-body rounded font-poppins">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Bookie</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product.php">Books</a>
        </li>
        <?php
        if (isLogged()) { // Kalau login
          if (!isAdmin()) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="transaction.php">Transaction</a>
            </li>
            <?php
          } else { ?> <!--Kalau gak login -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admin page
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="admin/book_crud.php">Add & edit books</a></li>
                <li><a class="dropdown-item" href="admin/transaction_admin.php">User's Transaction</a></li>
              </ul>
            </li>
          <?php }
        }
        ?>
      </ul>
      <?php
      if (!isLogged()) { // Kalau gak login
        ?>
        <span>
          <a href="login.php" class="links">Login</a>
          <a href="signup.php" class="links-bg">Sign up</a>
        </span>
        <?php
      } else { ?> <!--Kalau login -->
        <span class="navbar-user-info d-flex align-items-center">
          <?php if (!isAdmin()) { ?>
            <a href="cart.php" style="font-size:18px">
              <i class="fa-solid fa-shopping-cart me-2 dark-brown"></i>
            </a>
          <?php } ?>
          <p class="nav-link m-0"><?= $_SESSION['username'] ?></p>
          <a href="logout.php" class="links-bg ms-3">Logout</a>
        </span>
        <?php
      }
      ?>
    </div>
  </div>
</nav>
<!-- End Navbar -->