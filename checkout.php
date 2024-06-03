<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");

$connection = getConnection();

if (!isLogged()) {
  header("Location:login.php");
}

$loggedInUserId = $_SESSION['id'];

if (isset($_GET['books'])) {
  $book_ids = $_GET['books'];
  $placeholders = implode(',', $book_ids);
  $books = $connection->query("SELECT b.id as book_id, b.img, b.title, b.price, c.id, c.user_id, c.book_id, c.type, c.qty FROM shopping_cart c INNER JOIN books b ON c.book_id = b.id WHERE c.user_id = $loggedInUserId AND c.id IN ($placeholders)");
} elseif (isset($_POST['book_id'])) {
  $book_id = $_POST['book_id'];
  $qty = $_POST['size'];
  $type = $_POST['type'];
  $books = $connection->query("SELECT b.id as book_id, b.img, b.title, b.price FROM books b  WHERE b.id =$book_id");
}


$grand_total = 0;


include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
?>
<section id="checkout"
  class="d-flex justify-content-center font-inter align-items-center min-vh-100 max-vw-100 font-poppins"
  style="padding-top: 80px; background-color: #f4f4f5">
  <div class="container shadow" style="background-color: #fff">
    <div class="row p-5">
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


                if (isset($_GET['books'])) {
                  $total = $book->qty * $book->price;
                  $type = $book->type;
                  $qty = $book->qty;
                  $id = $book->id;
                } elseif (isset($_POST['book_id'])) {
                  $total = $qty * $book->price;
                  $id = NULL;
                }

                $grand_total += $total; ?>
                <tr>
                  <td><img src="assets/books/<?= $book->img ?>" alt="book" class="rounded object-fit-cover"
                      style="width: 75px;"></td>
                  <td><?= $book->title . "<br> <span style='font-size:12px'>" . $type . "</span>" ?></td>
                  <td><?= $qty ?></td>
                  <td><?= $book->price ?></td>
                  <td><?= $total ?></td>
                </tr>
                <input type="hidden" name="qty[]" value="<?= $qty ?>">
                <input type="hidden" name="book_id[]" value="<?= $book->book_id ?>">
                <input type="hidden" name="type[]" value="<?= $type ?>">
                <input type="hidden" name="id[]" value="<?= $id ?>">
              <?php } ?>
            </tbody>

          </form>
        </table>
      </div>

      <div class="col-5">
        <div class="card border-0">
          <div class="d-flex flex-column justify-content-center align-items-start p-5">
            <h1 class="fw-bold py-3">Order Summary</h1>
            <div class="row w-100">
              <div class="col-6">
                <p>Total Price</p>
              </div>
              <div class="col-6 d-flex justify-content-end">
                <p>
                  Rp <?= number_format($grand_total, 0, ',', '.') ?>
                </p>
              </div>
              <div class="col-6">
                <p>Delivery</p>
              </div>
              <div class="col-6 d-flex justify-content-end">
                <p>
                  Rp 0
                </p>
              </div>
              <hr style="background: #000" class="mt-5 mb-2">
            </div>
            <span class="d-flex justify-content-end" style="width: 100%;">
              <p class="fw-bold pe-3" style="font-size: 20px;">Rp <?= number_format($grand_total, 0, ',', '.') ?></p>
            </span>
            <a href="product.php" class="text-center links-co mb-3" style="width: 100%; font-size:15px"> Continue
              shopping </a>
            <button type="submit" class="links-co-white" style="width: 100%;" form="checkoutForm"> Checkout </button>
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