<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");
$connection = getConnection();

if (!isLogged()) {
  header("Location:login.php");
}

if (isset($_SESSION["error"])) {
  echo "<script>
        alert('" . $_SESSION['error'] . "');
    </script>";
  unset($_SESSION["error"]);
}

if (isset($_SESSION["success"])) {
  echo "<script>
        alert('" . $_SESSION['success'] . "');
    </script>";
  unset($_SESSION["success"]);
}

include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
include (__DIR__ . "/functions/functions.php");

$loggedInUserId = $_SESSION['id'];
$data = query("SELECT b.id as book_id, b.img, b.title, b.price, c.id, c.user_id, c.book_id, c.type, c.qty FROM shopping_cart c INNER JOIN books b ON c.book_id = b.id WHERE c.user_id = $loggedInUserId ORDER BY c.id DESC");
// var_dump($data);
?>
<section class="sec-detail max-vw-100 font-inter" id="cart" style="margin-top: 70px">
  <div class="w-100" style="height: 250px; background-image: url(assets/cart.jpg); background-size: cover;">
    <div class="pt-3 px-5">
      <h1 class="text-white fw-bold m-5">Your shopping cart</h1>
      <a href="product.php" class="text-white ms-5"><u>
          < Continue shopping</u>
      </a>
    </div>
  </div>
  <div class="d-flex justify-content-center mt-5">
    <div class="card">
      <div class="card-body p-3">
        <form action="checkout.php" method="get" id="cart">
          <table class="table borderless font-poppins">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th colspan="2" scope="col">Product</th>
                <th scope="col">Qty</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $total = 0;
              $grand_total = 0;
              foreach ($data as $row) { ?>
                <tr>
                  <?php
                  $qty = intval($row["qty"]);
                  $price = intval($row["price"]);
                  $total = $qty * $price;
                  $grand_total += $total;
                  ?>
                  <th scope="row">
                    <input class="form-check-input" type="checkbox" value="<?= $row["id"]; ?>" name="books[]" required>
                  </th>
                  <td><img src="assets/books/<?= $row["img"] ?>" alt="" class="book-cover img-fluid border-2"
                      style="width: 70px; height: 100px"> </td>
                  <td class="text-center"><?= $row["title"] ?> </td>
                  <td class="text-center"><?= $row["qty"] ?> </td>
                  <td class="text-center"><?= $row["type"] ?> </td>
                  <td>Rp <?= $price ?></td>
                  <td>
                    <span class="d-flex justify-content-center">
                      <a href="functions/handle_cart.php?op=delete&id=<?= $row["id"] ?>"><i class="fa fa-trash"
                          aria-hidden="true"></i></a>
                    </span>
                  </td>

                </tr>
              <?php } ?>
              <tr>
                <td colspan="2" scope="row" class="fw-bold"><span class="medium-brown">Total Price</span></td>
                <td scope="row"></td>
                <td scope="row"></td>
                <td scope="row"></td>
                <td colspan="2" scope="row" class="fw-bold"><span class="dark-brown">Rp
                    <?= number_format($grand_total, 0, ',', '.') ?></span></td>
              </tr>
            </tbody>
          </table>
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <a href="product.php" class="mini-nav"><u>
                  < Continue shopping</u></a>
            </div>
            <div class="col-6 d-flex justify-content-end">
              <button type="submit" class="links-bg">Buy now</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>