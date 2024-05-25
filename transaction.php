<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");

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
include (__DIR__ . "/templates/modal.php");
?>
</style>
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