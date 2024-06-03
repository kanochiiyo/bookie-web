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

$errorMessage = getFlash('error');
$successMessage = getFlash('success');

if ($errorMessage) {
  echo "<script>
        alert('$errorMessage');
    </script>";
}

if ($successMessage) {
  echo "<script>
        alert('$successMessage');
    </script>";
}

include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
require_once (__DIR__ . "/functions/functions.php");
$loggedInUserId = $_SESSION['id'];
$data = query("SELECT t.id AS transaction_id, td.id AS trxdetail_id, t.transaction_date, b.img, u.id AS user_id, b.id AS book_id, b.title, a.id AS author_id, a.name AS author, td.type, b.price, td.qty, r.id AS review_id, r.content, r.rate FROM transaction t INNER JOIN transaction_detail td ON t.id = td.transaction_id INNER JOIN user u ON t.user_id = u.id INNER JOIN books b ON td.book_id = b.id INNER JOIN author a ON b.author_id = a.id LEFT JOIN review r ON td.review_id = r.id WHERE t.user_id = $loggedInUserId ORDER BY t.id ASC");
$grand_total = 0;
$previous_transaction_id = null; // Set dulu prev trx id = null
$rowspans = []; // untuk nyimpen jumlah baris yg mau di rowspan
foreach ($data as $row) {
  $qty = intval($row["qty"]);
  $price = intval($row["price"]);
  $total = $qty * $price;
  $grand_total += $total;

  // Hitung rowspan tiap trx
  if ($row["transaction_id"] !== $previous_transaction_id) { // Kalo id saat ini != id sebelumnya, brrti trx nya beda maka gak ada rowspan
    $rowspans[$row["transaction_id"]] = 0;
  }
  // Kalau id saat ini = id sebelumnya, rowspan id ke-n tambah 1
  $rowspans[$row["transaction_id"]]++;
  $previous_transaction_id = $row["transaction_id"]; // Simpan id saat ini sebagai id sebelumnya
}
?>

<main class="font-poppins">
  <section id="transaction">
    <div class="container py-5">
      <h4 class="font-inter">My Transaction</h4>
      <p class="text-muted my-1 p-0">You've spent</p>
      <h2><?= "Rp " . number_format($grand_total, 0, ',', '.') ?></h2>

      <!-- modal add review -->
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
              <form action="functions/handle_review.php" method="post" id="bookReviewForm">
                <input type="hidden" name="book_id">
                <input type="hidden" name="trxDetail_id">
                <input type="hidden" name="review_id">
                <div class="mb-3">
                  <label for="rating" class="form-label">Rating</label><br>
                  <div class="d-flex align-items-center">
                    <span class="first font-inter me-2"></span>
                    <input type="range" class="rating me-2" name="reviewRating" min="0" max="5" id="rating">
                    <span class="last font-inter"></span>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="review" class="form-label">Review</label>
                  <textarea class="form-control" id="review" rows="3" name="reviewContent"></textarea>
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

      <div class="card d-flex justify-content-center align-items-center p-2 my-5">
        <table class="table borderless">
          <thead>
            <tr>
              <th class="text-center">IDs</th>
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
            <?php
            $previous_transaction_id = null;
            foreach ($data as $row) {
              $total = intval($row["qty"]) * intval($row["price"]);
              ?>
              <tr>
                <?php if ($row["transaction_id"] !== $previous_transaction_id) { // Ketika ada id trx yang sama ?>
                  <td rowspan="<?= $rowspans[$row["transaction_id"]] ?>"><?= $row["transaction_id"] ?></td>
                  <td rowspan="<?= $rowspans[$row["transaction_id"]] ?>"><?= $row["transaction_date"] ?></td>
                <?php } ?>
                <td><img src="assets/books/<?= $row["img"] ?>" alt="" class="book-cover img-fluid border-2"
                    style="width: 80px; height: 110px; border-radius:2px;" </td>
                <td><?= $row["title"] ?></td>
                <td><?= $row["author"] ?></td>
                <td><?= $row["type"] ?></td>
                <td>Rp <?= number_format($row["price"], 0, ',', '.') ?></td>
                <td><?= $row["qty"] ?></td>
                <td>Rp <?= number_format($total, 0, ',', '.') ?></td>
                <td>
                  <a href="#" class="fs-6 mt-1 mb-3 reviewBtn" data-bs-toggle="modal" data-bs-target="#bookReviewModal"
                    data-book-title="<?= $row["title"] ?>" data-author="<?= $row["author"] ?>"
                    data-book-id="<?= $row["book_id"] ?>" data-trx-id="<?= $row["trxdetail_id"] ?>"
                    data-review-id="<?= $row["review_id"] ?>"
                    data-review-content="<?= htmlspecialchars($row["content"], ENT_QUOTES) ?>"
                    data-review-rating="<?= $row["rate"] ?>">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                </td>
              </tr>
              <?php
              $previous_transaction_id = $row["transaction_id"];
            }
            ?>
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