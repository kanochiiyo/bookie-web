<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top shadow-sm p-3 mb-5 bg-body rounded">
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
          <a class="nav-link" href="#popular-books">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product.php">Product</a>
        </li>
        <?php
        if (isLogged()) {
          if (!isAdmin()) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="transaction.php">Transaction</a>
            </li>
            <?php
          } else { ?>
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
      if (!isLogged()) {
        ?>
        <span>
          <a href="login.php" class="links">Login</a>
          <a href="signup.php" class="links-bg">Sign up</a>
        </span>
        <?php
      } else { ?>
        <span>
          <?php
          if (!isAdmin()) {
            ?>
            <a href="cart.php" style="font-size:18px"> <i class="fa-solid fa-shopping-cart me-2 dark-brown"></i></a>
            <?php
          }
          ?>

          <a href="logout.php" class="links-bg">Logout</a>
        </span>
        <?php
      }
      ?>

    </div>
  </div>
</nav>
<!-- End Navbar -->