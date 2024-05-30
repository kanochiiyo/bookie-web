<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");

$connection = getConnection();

if (!isLogged()) {
  header("Location:login.php");
}


if (isset($_GET['books'])) {
  $book_ids = $_GET['books']; // Array of selected book IDs

  // Create placeholders for the IN clause
  $placeholders = implode(',', $book_ids);

}

$loggedInUserId = $_SESSION['id'];
$books = $connection->query("SELECT b.id as book_id, b.img, b.title, b.price, c.id, c.user_id, c.book_id, c.type, c.qty FROM shopping_cart c INNER JOIN books b ON c.book_id = b.id WHERE c.user_id = $loggedInUserId AND c.id IN ($placeholders)");
$grand_total = 0;


include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
?>
<section class="d-flex justify-content-center font-inter align-items-center min-vh-100 max-vw-100"
  style="padding-top:80px">
  <div class="container">
    <div class="card shadow-lg mt-5 mb-5">
      <div class="row">
        <div class="col-7 p-3 bg-light-brown">
          <div class="card p-2 mb-2">
            <div class="row">
              <div class="col-6">
                <p class="mb-0">Product</p>
              </div>
              <div class="col-2">
                <p class="mb-0">Qty</p>
              </div>
              <div class="col-2">
                <p class="mb-0">Price</p>
              </div>
              <div class="col-2">
                <p class="mb-0">Subtotal</p>
              </div>
            </div>
          </div>
          <!-- card produk -->
          <form action="functions/handle_checkout.php" method="post" id="checkoutForm">
            <?php while ($book = $books->fetch_object()) {
              $total = $book->qty * $book->price;
              $grand_total += $total; ?>
              <div class="card p-2 mb-2">
                <div class="row">
                  <div class="col-2">
                    <img src="assets/books/<?= $book->img ?>" alt="book" class="rounded object-fit-cover"
                      style="width: 75px;">
                  </div>
                  <div class="col-4">
                    <p><?= $book->title ?></p>
                    <p><?= $book->type ?></p>
                  </div>
                  <div class="col-2">
                    <p><?= $book->qty ?></p>
                  </div>
                  <div class="col-2">
                    <p><?= $book->price ?></p>
                  </div>
                  <div class="col-2">
                    <p><?= $total ?></p>
                  </div>
                  <input type="number" name="qty" id="qty" value="<?= $book->qty ?>">
                  <input type="number" name="book_id" id="book_id" value="<?= $book->book_id ?>">
                  <input type="text" name="type" id="type" value="<?= $book->type ?>">
                </div>
              </div>
            <?php } ?>
          </form>
          <!-- end card produk -->
        </div>
        <div class="col-5 bg-dark-brown text-white">
          <div class="d-flex flex-column justify-content-center align-items-start p-5">
            <h1 class="fw-bold">Order Summary</h1>
            <div class="row w-100">
              <div class="col-6">
                <p>Total Price</p>
              </div>
              <div class="col-6 d-flex justify-content-end">
                <p>
                  <?= $grand_total ?>
                </p>
              </div>
              <div class="col-6">
                <p>Delivery</p>
              </div>
              <div class="col-6 d-flex justify-content-end">
                <p>
                  $0
                </p>
              </div>
              <hr style="background: #fff" class="mt-5 mb-2">
            </div>
            <span class="d-flex justify-content-end" style="width: 100%;">
              <p class="fw-bold" style="font-size: 20px"><?= $grand_total ?></p>
            </span>
            <a href="product.php" class="text-center links-co-white mb-3" style="width: 100%; font-size:15px"> Continue
              shopping </a>
            <button type="submit" class="links-co" style="width: 100%;" form="checkoutForm"> Checkout </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>