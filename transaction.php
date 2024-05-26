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
            <p>Review for Moby-Dick by Harper Lee</p>
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
      <h2>Rp 600.000</h2>
      <div class="card d-flex justify-content-center align-items-center p-2 my-5">
        <table class="table borderless">
          <thead>
            <tr>
              <th>Transaction Date</th>
              <th>Book Cover</th>
              <th>Book Title</th>
              <th>Author</th>
              <th>Book Type</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Subtotal</th>
              <th>Review</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i = 0; $i <= 5; $i++) { ?>
              <tr>
                <td>23-12-2020</td>
                <td>
                  <img src="assets/books/book1.jpg" class="book-cover img-fluid" alt="Book Cover">
                </td>
                <td>Moby-Dick</td>
                <td>Harper Lee</td>
                <td>E-book</td>
                <td>Rp 40.000</td>
                <td>3</td>
                <td>Rp 120.000</td>
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