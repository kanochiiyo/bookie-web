<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");

$connection = getConnection();

include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/modal.php");
include (__DIR__ . "/functions/functions.php");

$data = query("SELECT b.id as book_id, b.title, b.img, a.id, a.name as author, b.price FROM books b INNER JOIN author a ON b.author_id = a.id");
// var_dump($data);
?>

<main class="font-inter">
  <!-- Navbar -->
  <nav class="cus-nav navbar navbar-expand-lg fixed-top shadow-sm p-3 bg-body rounded" style="height: 70px">
    <div class="container-fluid align-items-center">
      <a class="navbar-brand" href="index.php">Bookie</a>
      <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDropdown">
        <form class="d-flex" role="search" style="width:70%">
          <input class="form-control me-2 border-1" style="border-color: black" type="search"
            placeholder="Search book title" aria-label="Search">
          <button class="btn border-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
      <?php
      if (!isLogged()) {
        ?>
        <span>
          <a href="login.php" class="links">Login</a>
          <a href="signup.php" class="links-bg">Sign up</a>
        </span>
        <?php
      } else { ?>
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
  </nav>
  <!-- End Navbar -->

  <!-- Catalogue -->
  <section class="catalogue" id="catalogue" style="padding-top: 70px;">
    <div class="container py-5 pb-0">
      <div class="row">
        <div class="col-3">
          <h5 class="fw-bold">Semua Kategori (123)</h5>

        </div>

        <div class="col-9">
          <div class="row mb-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                  aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                  aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                  aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="assets/product-carousel.png" class="product-carousel-img d-block rounded object-fit-cover"
                    alt="Carousel 1">
                </div>
                <div class="carousel-item">
                  <img src="assets/product-carousel2.png" class="product-carousel-img d-block rounded object-fit-cover"
                    alt="Carousel 2">
                </div>
                <div class="carousel-item">
                  <img src="assets/product-carousel.png" class="product-carousel-img d-block rounded object-fit-cover"
                    alt="Carousel 3">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <h4 class="fw-bold">Books</h4>
          </div>

          <div class="container pt-3 pb-5">
            <?php $chunks = array_chunk($data, 4); ?>
            <?php foreach ($chunks as $chunk) { ?>
              <div
                class="row <?php echo count($chunk) < 4 ? 'justify-content-start' : 'justify-content-between'; ?> mx-1 mb-5">
                <?php foreach ($chunk as $row) { ?>
                  <div class="custom-card col-3 mx-1 mb-5">
                    <a href="detail.php" class="text-decoration-none">
                      <img src="assets/books/<?= $row["img"] ?>" alt="<?= $row["title"] ?> by <?= $row["author"] ?>"
                        class="rounded-end-1 object-fit-fill" style="width: 100%; height: auto; max-height: 250px;" />
                      <div class="card-body">
                        <h5 class="m-1 fw-bold text-truncate" style="font-size: 17px; color:#000"><?= $row["title"] ?></h5>
                        <p class="m-1"><?= $row["author"] ?></p>
                        <p class="m-1 fw-bold" style="font-size: 13px; margin-bottom: 0;"><i class="fa-solid fa-star"></i>
                          4.5</p>
                        <div class="d-flex justify-content-between align-items-center m-1">
                          <p class="fw-bold mb-0" style="font-size: 17px; margin-bottom: 0;">Rp
                            <?= number_format($row["price"], 0, ',', '.') ?>
                          </p>
                          <a href="#" class="submitcart links-bg-white mt-1 mb-3" data-bs-toggle="modal"
                            data-bs-target="#cartModal" type="button" data-id="<?= $row["book_id"] ?>"
                            data-name="<?= $row["title"] ?>">Add to cart</a>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>
          </div>




        </div>
      </div>
    </div>
  </section>
  <!-- End Catalogue -->
</main>

<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>