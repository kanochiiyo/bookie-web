<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");
$connection = getConnection();

if (!isLogged()) {
  header("Location:login.php");
}
if (isAdmin()) {
  echo "<script>
    alert('Admin cant access users transaction history');
    document.location.href = 'index.php';
    </script>";
}

include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
require_once (__DIR__ . "/functions/functions.php");
$loggedInUserId = $_SESSION['id'];
$data = query("SELECT t.id AS transaction_id, t.transaction_date, b.img, u.id AS user_id, b.id AS book_id, b.title, a.id AS author_id, a.name AS author, td.type, b.price, td.qty, r.id AS review_id, r.content, r.rate FROM transaction t INNER JOIN transaction_detail td ON t.id = td.transaction_id INNER JOIN user u ON t.user_id = u.id INNER JOIN books b ON td.book_id = b.id INNER JOIN author a ON b.author_id = a.id INNER JOIN review r ON td.review_id = r.id WHERE t.user_id = $loggedInUserId");
$grand_total = 0;
foreach ($data as $row) {
  $qty = intval($row["qty"]);
  $price = intval($row["price"]);
  $total = $qty * $price;
  $grand_total += $total;
}
?>

<!-- Modal Book Review -->
<div class="modal fade font-inter" id="bookReviewModal" tabindex="-1" aria-labelledby="bookReviewModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="bookReviewModalLabel">Add Review</h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="bookReviewForm">
          <div class="mb-3">
            <p>Review for <?= $data["book_id"] ?> by <?= $data["book_id"] ?> </p>
          </div>
          <div class="mb-3">
            <label for="rating" class="form-label">Rating</label><br>
            <div class="d-flex align-items-center">
              <span class="first font-inter me-2"></span>
              <input type="range" class="rating me-2" name="rating" min="0" max="5" id="rating">
              <span class="last font-inter"></span>
            </div>
          </div>
          <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea class="form-control" id="review" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="bookReviewForm">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Book Review -->

<main class="font-poppins">
  <section id="transaction">
    <div class="container py-5">
      <h4 class="font-inter ">My Transaction</h4>
      <p class="text-muted my-1 p-0">You've spent</p>
      <h2><?= "Rp " . number_format($grand_total, 0, ',', '.') ?></h2>

      <div class="card d-flex justify-content-center align-items-center p-2 my-5">
        <table class="table borderless">
          <thead>
            <tr>
              <th class="text-center">Transaction Date</th>
              <th colspan="2" class="text-center">Book</th>
              <th class="text-center">Author</th>
              <th class="text-center">Book Type</th>
              <th class="text-center">Price</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Subtotal</th>
              <th class="text-center">Review</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $row) { ?>
              <tr>
                <td><?= $row["transaction_date"] ?></td>
                <td><img src="assets/books/<?= $row["img"] ?>" alt="" class="book-cover img-fluid"> </td>
                <td><?= $row["title"] ?></td>
                <td><?= $row["author"] ?></td>
                <td><?= $row["type"] ?></td>
                <td>Rp <?= number_format($row["price"], 0, ',', '.') ?></td>
                <td><?= $row["qty"] ?></td>
                <td><?= $total ?></td>
                <td> <a href="#" class=" fs-6 mt-1 mb-3" data-bs-toggle="modal" data-bs-target="#bookReviewModal"><i
                      class="fa-solid fa-pen"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  </section>
</main>

<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>