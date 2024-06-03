<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");

$connection = getConnection();

if (isset($_GET['message'])) {
  if ($_GET['message'] == "not_admin") {
    ?>
    <script>
      alert('This page is limited to admin!')
    </script>
    <?php
  }
}

include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
include (__DIR__ . "/templates/modal.php");
?>

<main class="font-inter">
  <!-- Hero -->
  <section class="hero" id="hero">
    <div class="container pt-3 pb-0 px-0 p-0">
      <div class="row">
        <div class="col-8 my-5">
          <p class="d-inline-block disclaimer bg-white mb-3">
            ● Your next good reading is waiting
          </p>
          <h1 class="fw-bold mt-3 mb-3" style="letter-spacing: 2px">
            Discover Worlds Between Pages
          </h1>
          <p class="mt-3 mb-3">
            Dive into a vast collection of books across various genres. Whether you're looking for the latest bestseller
            or a hidden gem, our bookstore has something for every reader.
          </p>
          <form class="d-inline-block my-3" role="search" action="product.php" method="get">
            <span class="my-3">
              <button class="links-bg my-3" type="submit">Browse books</button>
            </span>
          </form>
        </div>

        <div class="col-4" style="height: 480px; margin-top: 40px">
          <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade " data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/hero.jpg" alt="Bookstore image" class="hero-img rounded d-block object-fit-cover">
              </div>
              <div class="carousel-item">
                <img src="assets/hero2.jpg" alt="Bookstore image" class="hero-img rounded d-block object-fit-cover">
              </div>
              <div class="carousel-item">
                <img src="assets/hero3.jpg" alt="Bookstore image" class="hero-img rounded d-block object-fit-cover">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero -->

  <!-- Section 2 -->
  <section class="desc" id="desc" data-aos="fade-up">
    <div class="container pt-3 pb-0 px-0">
      <p class="d-inline-block disclaimer mb-2 my-5">
        ● Why choose bookie
      </p>
      <h1 class="mt-1 mb-3">
        Best way to manage your <br> reading life
      </h1>
      <p class="mt-3 mb-3">
        Explore, discover, and enjoy a curated selection of books. Find your next favorite read and immerse yourself in
        the world of literature with Bookie.
      </p>
      <div class="row text-center my-5">
        <div class="col-4 p-5">
          <i class="fa-solid fa-magnifying-glass mb-3"></i>
          <h2>Book Discovery</h2>
          <p class="mt-2 mb-3">
            Easily find books that match your interests with our powerful search and recommendation engine.
          </p>
        </div>
        <div class="col-4 p-5">
          <i class="fa-solid fa-users mb-3"></i>
          <h2>Friends and Community</h2>
          <p class="mt-2 mb-3">
            Connect with other book lovers, share your reviews, and join discussions.
          </p>
        </div>
        <div class="col-4 p-5">
          <i class="fa-solid fa-star mb-3"></i>
          <h2>Book Review</h2>
          <p class="mt-2 mb-3">
            Read reviews from other readers to help you decide on your next book.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- End Section 2 -->

  <!-- Section 3 -->
  <section data-aos="fade-up">
    <div class="container pt-3 pb-0 px-0">
      <div class="row">
        <div class="col-4" style="height: 480px; margin-top: 40px">
          <img class="hero-img rounded d-block object-fit-cover" src="assets/desc.jpg" alt="Bookstore image" />
        </div>
        <div class="col-8 p-5">
          <p class="d-inline-block disclaimer mb-2 my-5">
            ● Why choose bookie
          </p>
          <h1 class="mt-1 mb-3">
            Best way to discover, track, and share your reading life
          </h1>
          <p class="mt-3 mb-2">
            Bookie is your ultimate companion for discovering new books, tracking your reading progress, and sharing
            your favorite reads with friends.
          </p>
          <?php if (!isLogged()) { ?>
            <span>
              <a href="signup.php" class="links-bg my-3" type="submit">Join for free</a>
            </span>
          <?php } ?>
        </div>
      </div>

  </section>
  <!-- End Section 3 -->

  <!-- Popular Books Section -->
  <?php
  $populars = $connection->query("SELECT b.id as book_id, b.title, b.img, a.id, a.name as author, b.price, c.shopping_cart, CASE WHEN (r.rate IS NULL) THEN 0 ELSE ROUND(r.rate, 1) END AS rate 
FROM books b INNER JOIN author a ON b.author_id = a.id 
LEFT JOIN (SELECT AVG(r.rate) AS rate, b.id FROM books b, transaction_detail tr LEFT JOIN review r ON tr.review_id = r.id WHERE b.id = tr.book_id GROUP BY b.id) r ON b.id = r.id
INNER JOIN (SELECT count(sc.book_id) shopping_cart, sc.book_id FROM shopping_cart sc GROUP BY sc.book_id) c ON b.id = c.book_id
ORDER BY c.shopping_cart DESC 
LIMIT 10");

  $popularsArray = [];
  while ($popular = $populars->fetch_object()) {
    $popularsArray[] = $popular;
  }
  $chunkedPopulars = array_chunk($popularsArray, ceil(count($popularsArray) / 2)); ?>
  <section class="popular-books pb-5" id="popular-books" data-aos="fade-right">
    <div class="container pt-4 px-0">
      <div class="row">
        <div class="col-6">
          <h1 class="mt-1 mb-3">Popular Books</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center text-end p-0">
          <div class="col-6">
            <a href="#">Featured Products</a>
          </div>
          <div class="col-3">
            <a href="#">New Arrivals</a>
          </div>
          <div class="col-3">
            <a href="#">Most Viewed</a>
          </div>
        </div>
      </div>
      <div class="row justify-content-between mx-1">
        <div class="col-12 pb-5">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class=" carousel-inner">
              <?php for ($j = 0; $j < count($chunkedPopulars); $j++) { ?>
                <div class="carousel-item <?php echo ($j == 0) ? 'active' : ''; ?>">
                  <div class="row justify-content-between mx-1">
                    <?php foreach ($chunkedPopulars[$j] as $popular) { ?>
                      <div class="custom-card col-2 mx-1 mb-5" style="height: 380px">
                        <a href="detail.php?detail=<?= $popular->book_id ?>" class="text-decoration-none">
                          <img src="assets/books/<?= $popular->img ?>"
                            alt="<?= $popular->title ?> by <?= $popular->author ?>" class="rounded-end-1 object-fit-fill"
                            style="width: 100%; height: auto; max-height: 250px;" />
                          <div class="card-body">
                            <h5 class="m-1 fw-bold text-truncate" style="font-size: 17px; color:#000"><?= $popular->title ?>
                            </h5>
                            <p class="m-1"><?= $popular->author ?></p>
                            <p class="m-1 fw-bold" style="font-size: 13px; margin-bottom: 0;"><i
                                class="fa-solid fa-star"></i>
                              <?= $popular->rate ?></p>
                            <div class="d-flex justify-content-between align-items-center m-1">
                              <p class="fw-bold mb-0" style="font-size: 17px; margin-bottom: 0;">Rp
                                <?= number_format($popular->price, 0, ',', '.') ?>
                              </p>
                              <a href="#" class="submitcart links-bg-white mt-1 mb-3" data-bs-toggle="modal"
                                data-bs-target="#cartModal" type="button" data-id="<?= $popular->book_id ?>">Add to cart</a>
                            </div>
                          </div>
                        </a>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Popular Books Section -->

  <!-- Best Seller Section -->
  <?php
  $best_sellers = $connection->query("SELECT b.id as book_id, b.title, b.img, a.id, a.name as author, b.price, t.qty, CASE WHEN (r.rate IS NULL) THEN 0 ELSE ROUND(r.rate, 1) END AS rate
FROM books b INNER JOIN author a ON b.author_id = a.id 
LEFT JOIN (SELECT AVG(r.rate) AS rate, b.id FROM books b, transaction_detail tr LEFT JOIN review r ON tr.review_id = r.id WHERE b.id = tr.book_id GROUP BY b.id) r ON b.id = r.id
INNER JOIN (SELECT SUM(td.qty) qty, td.book_id  FROM transaction_detail td GROUP BY td.book_id) t ON b.id = t.book_id
ORDER BY t.qty DESC 
LIMIT 5");
  ?>
  <section class="best-seller pb-5" id="best-seller" data-aos="fade-right">
    <div class="container pt-4 px-0">
      <div class="row">
        <div class="col-6">
          <h1 class="mt-1 mb-3">
            Best Seller
          </h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center text-end p-0">
          <a href="product.php">View All <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>

      <div class="row justify-content-between mx-1">
        <?php while ($best_seller = $best_sellers->fetch_object()) { ?>
          <div class="custom-card col-2 mx-1 mb-5">
            <a href="detail.php?detail=<?= $best_seller->book_id ?>" class="text-decoration-none">
              <img src="assets/books/<?= $best_seller->img ?>" alt="<?= $popular->title ?> by <?= $popular->author ?>"
                class="rounded-end-1 object-fit-fill" style="width: 100%; height: auto; max-height: 250px;" />
              <div class="card-body">
                <h5 class="m-1 fw-bold text-truncate" style="font-size: 17px; color:#000">
                  <?= $best_seller->title ?>
                </h5>
                <p class="m-1"><?= $best_seller->author ?></p>
                <p class="m-1 fw-bold" style="font-size: 13px; margin-bottom: 0;"><i class="fa-solid fa-star"></i>
                  <?= $best_seller->rate ?></p>
                <div class="d-flex justify-content-between align-items-center m-1">
                  <p class="fw-bold mb-0" style="font-size: 17px; margin-bottom: 0;">Rp
                    <?= number_format($best_seller->price, 0, ',', '.') ?>
                  </p>
                  <a href="#" class="submitcart links-bg-white mt-1 mb-3" data-bs-toggle="modal"
                    data-bs-target="#cartModal" type="button" data-id="<?= $best_seller->book_id ?>">Add to cart</a>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <!-- End Best Seller Section -->

  <!-- Review Section -->
  <section class=" review" id="review" data-aos="fade-up">
    <div class="container pt-5 pb-1">
      <div class="row">
        <div class="col-12 d-flex justify-content-center">
          <p class="disclaimer m-2">● Join Bookie Now</p>
        </div>
      </div>
      <div class="row">
        <h1 class="text-center">See What Our Members Have to Say</h1>
      </div>
      <div class="row justify-content-center pt-5">
        <div class="card col mx-2 py-4 px-3" style="width: 350px; border-color: #f1f1f1">
          <p>"I found so many amazing books through Bookie! It's my go-to place for discovering new reads and sharing
            reviews. The vibes is great!"</p>
          <h6 class="fw-bold">Kiyotaka Ayanokouji</h6>
          <p style="color: grey">Avid Reader</p>
        </div>
        <div class="card col mx-2 py-4 px-3" style="width: 350px; border-color: #f1f1f1">
          <p>"The community on Bookie is fantastic. I've connected with so many fellow book lovers and gotten great
            recommendations. I would love to share with others."</p>
          <h6 class="fw-bold">Shima Rin</h6>
          <p style="color: grey">Highschool Student</p>
        </div>
        <div class="card col mx-2 py-4 px-3" style="width: 350px; border-color: #f1f1f1">
          <p>"Bookie has made it so easy to track my reading progress and keep my library organized. Highly recommend it
            to all readers!"</p>
          <h6 class="fw-bold">Midoriya Izuku</h6>
          <p style="color: grey">Book Enthusiast</p>
        </div>
      </div>
    </div>
  </section>
  <!-- End Review Section -->

  <!-- Join Section -->
  <section class="join" id="join" data-aos="fade-up">
    <div class="container justify-content-center" style="padding: 100px 150px;">
      <div class="row">
        <div class="col-12 d-flex justify-content-center">
          <p class="disclaimer m-2">● Join Bookie Now</p>
        </div>
      </div>
      <div class="row">
        <div class="custom-card border-0 p-5 rounded-2" style=" background-color: #f4f1ea; height: 100%;">
          <h5 class="p-2 m-0 text-center">Join our community of book lovers!</h5>
          <p class="p-2 m-0 text-center" style="font-size: 14px;">Become a member of Bookie to discover new books,
            connect with fellow readers, and track your reading journey. Our platform offers personalized
            recommendations, book reviews, and a vibrant community. Join now for free and start your reading adventure
            today!</p>
          <?php if (!isLogged()) { ?>
            <div class="d-flex justify-content-center">
              <a href="signup.php" class="links-bg" type="submit">Join for free</a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End Join Section -->
</main>

<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>