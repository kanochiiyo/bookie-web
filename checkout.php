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
<section id="checkout"
  class="d-flex justify-content-center font-inter align-items-center min-vh-100 max-vw-100 font-poppins"
  style="padding-top: 80px;">
  <div class="container">
    <div class="row">
      <div class="col-7">

        <table class="table table-borderless">
          <thead>
            <tr>
              <th colspan="2">Product</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <form action="functions/handle_checkout.php" method="post" id="checkoutForm">
            <tbody>
              <?php while ($book = $books->fetch_object()) {
                $total = $book->qty * $book->price;
                $grand_total += $total; ?>
                <tr>
                  <td><img src="assets/books/<?= $book->img ?>" alt="book" class="rounded object-fit-cover"
                      style="width: 75px;"></td>
                  <td><?= $book->title ?></td>
                  <td><?= $book->qty ?></td>
                  <td><?= $book->price ?></td>
                  <td><?= $total ?></td>
                </tr>
                <input type="hidden" name="qty[]" value="<?= $book->qty ?>">
                <input type="hidden" name="book_id[]" value="<?= $book->book_id ?>">
                <input type="hidden" name="type[]" value="<?= $book->type ?>">
                <input type="hidden" name="id[]" value="<?= $book->id ?>">
              <?php } ?>
            </tbody>

          </form>
        </table>
      </div>

      <div class="col-5">
        <div class="card border-0">
          <div class="d-flex flex-column justify-content-center align-items-start p-5">
            <div class="row">
              <div class="col">
                <h3 class="fw-bold">Total Amount</h3>
                <h6>
                  <?= $grand_total ?>
                </h6>
              </div>
            </div>
            <div class="row">
              <div class="col-6">Delivery</div>
            </div>
            <hr style="background: red" class="mt-5 mb-2">
            <a href="product.php" class="text-center links-bg-white mb-3" style="width: 100%; font-size:15px"> Continue
              shopping </a>
            <button type="submit" class="links-co" style="width: 100%;" form="checkoutForm">
              Checkout </button>
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