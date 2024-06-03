<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");
require_once (__DIR__ . "/functions/functions.php");
$connection = getConnection();

if (isset($_GET["detail"])) {
  $id = $_GET["detail"];
} else {
  setFlash('select', "Please select an item!");
  $selectMessage = getFlash('select');
  // var_dump($selectMessage);

  if ($selectMessage) {
    echo "<script>
        alert('$selectMessage');
        window.location.href = './product.php'; 
    </script>";
  }

}

$bookData = $connection->query("SELECT b.*, a.name AS author, g.name AS genre, p.name AS publisher, 
CASE WHEN (r.rate IS NULL) THEN 0 ELSE round(r.rate, 1) END AS rate
FROM books b LEFT JOIN author a ON b.author_id = a.id 
LEFT JOIN genre g ON b.genre_id = g.id 
LEFT JOIN publisher p ON b.publisher_id = p.id 
LEFT JOIN (SELECT AVG(r.rate) rate, b.id
FROM books b,
transaction_detail tr LEFT JOIN review r ON tr.review_id = r.id
WHERE b.id = tr.book_id 
AND b.id = $id
GROUP BY b.id) r ON b.id = r.id
WHERE b.id = $id ");
$book = $bookData->fetch_object();

include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
include (__DIR__ . "/templates/modal.php");
?>
<section class="sec-detail max-vw-100 min-vh-100 font-inter" id="detail">
  <div class="container mt-5 pt-5">
    <div class="row ">
      <!-- foto buku disini -->
      <div class="col-6 p-5 d-flex justify-content-center">
        <div class="position-absolute d-flex justify-content-center">
          <img class="detail-img d-block object-fit-cover" src="assets/books/<?= $book->img ?>"
            alt="<?= $book->title ?>">
        </div>
      </div>
      <!-- judul buku disini -->
      <div class="col-6 pt-5">
        <h1 class="mt-5 mb-3 fw-bold">
          <?= $book->title ?>
        </h1>
        <h2 class="mb-3"><?= $book->author ?></h2>
        <p class="">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit
          dolorem maxime, esse quod molestias nam ut laborum quos
        </p>
        <p class="dark-brown fw-bold" style="font-size:12px">
          <i class="fa-solid fa-star"></i>
          <?= $book->rate ?>
        </p>

        <p class="fw-bold mb-0" style="font-size:28px">$<?= $book->price ?></p>
      </div>
    </div>

    <!-- content bg putih -->
    <div class="container bg-white min-vh-100">
      <div class="row mt-5 pt-4">
        <div class="col-6">
        </div>
        <div class="col-6">
          <div>
            <a href="#" class="links-bg mt-1 mb-3 submit-buy" data-bs-toggle="modal" data-bs-target="#buyModal"
              type="button" data-buy-id="<?= $book->id ?>">Buy
              now</a>
            <a href="#" class="links-bg-white mt-1 mb-3 submitcart" data-bs-toggle="modal" data-bs-target="#cartModal"
              type="button" data-id="<?= $book->id ?>"> Add to cart</a>
          </div>
          <div class="me-5">
            <div class="d-flex justify-content-end">
              <a href="#synopsis" class="mx-3 mini-nav" type="submit">Synopsis</a>
              <a href="#details" class="mx-3 mini-nav" type="submit">Book's Details</a>
              <a href="#reviews" class="ms-3 mini-nav" type="submit">Reviews</a>
            </div>
            <hr>
          </div>
        </div>
      </div>
      <!-- start synopsis -->
      <div class="m-5" id="synopsis">
        <h2 class="mb-3 fw-bold">Synopsis</h2>
        <p> <?= $book->synopsis ?></p>
      </div>
      <!-- end synopsis -->
      <!-- start details -->
      <div class="mx-5 mb-5 card p-3 shadow" id="details">
        <h2 class="mb-3 fw-bold">Book's Details</h2>
        <div class="row">
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              number of pages
            </p>
            <p>
              <?= $book->totalpage ?>
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Publication date
            </p>
            <p>
              <?= $book->publication_date ?>
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Genre
            </p>
            <p>
              <?= $book->genre ?>
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Publisher
            </p>
            <p>
              <?= $book->publisher ?>
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Language
            </p>
            <p>
              <?= $book->language ?>
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Weight
            </p>
            <p>
              <?= $book->weight ?> kg
            </p>
          </div>
        </div>
      </div>
      <!-- end details -->

      <?php
      $reviews = $connection->query("SELECT r.*, t.name
FROM books b,
transaction_detail tr LEFT JOIN review r ON tr.review_id = r.id,
(SELECT t.id, u.name 
FROM transaction t, user u
WHERE t.user_id = u.id ) t
WHERE b.id = tr.book_id 
AND t.id = tr.transaction_id 
AND b.id = $id
LIMIT 3")
        ?>
      <!-- start reviews -->
      <div class="mx-5" id="reviews">
        <h2 class="mb-0 fw-bold">Reviews</h2>
        <div class="d-flex justify-content-end">
          <p class="dark-brown fw-bold" style="font-size: 22px;">
            <i class="fa-solid fa-star"></i>
            <?= $book->rate ?>
          </p>
        </div>
        <hr class="mt-0">
        <?php while ($review = $reviews->fetch_object()) { ?>
          <div class="card p-2 m-3">
            <div class="row">
              <div class="col-1 d-flex mx-0 justify-content-center">
                <img class="user-review" src="assets/user/user.png" alt="user">
              </div>
              <div class="col-11 mx-0">
                <p class="fw-bold medium-brown mb-0"> <?= $review->name ?></p>
                <p class=" fw-bold mb-0 dark-brown" style="font-size:12px">
                  <i class="fa-solid fa-star"></i>
                  <?= $review->rate ?>
                </p>
                <p class="mb-0"><?= $review->content ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="d-flex justify-content-end pb-5">
          <a href="#" class="dark-brown fw-bold" data-bs-toggle="modal" data-bs-target="#reviewModal"
            type="button"><u>More reviews..</u></a>
        </div>
      </div>
      <!-- end reviews -->

      <?php
      $fullreview = $connection->query("SELECT r.*, t.name
FROM books b,
transaction_detail tr LEFT JOIN review r ON tr.review_id = r.id,
(SELECT t.id, u.name 
FROM transaction t, user u
WHERE t.user_id = u.id ) t
WHERE b.id = tr.book_id 
AND t.id = tr.transaction_id 
AND b.id = $id")
        ?>
      <!-- modal reviews -->
      <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
          <div class="modal-content modal-bg">
            <div class="modal-header">
              <div>
                <h1 class="modal-title fs-5" id="reviewModalLabel">Reviews</h1>
                <p class="modal-description text-muted mb-0">Lihat apa pendapat mereka</p>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php while ($reviewData = $fullreview->fetch_object()) { ?>
                <div class="card p-2 m-3">
                  <div class="row">
                    <div class="col-1 d-flex mx-0 justify-content-center">
                      <img class="user-review" src="assets/user/user.png" alt="user">
                    </div>
                    <div class="col-11 mx-0">
                      <p class="fw-bold medium-brown mb-0"> <?= $reviewData->name ?></p>
                      <p class=" fw-bold mb-0 dark-brown" style="font-size:12px">
                        <i class="fa-solid fa-star"></i>
                        <?= $reviewData->rate ?>
                      </p>
                      <p class="mb-0"><?= $reviewData->content ?></p>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="links-bg" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end modal reviews -->
    </div>
  </div>
</section>
<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>