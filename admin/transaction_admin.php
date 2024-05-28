<?php
session_start();

require_once (__DIR__ . "/../functions/authentication.php");
require_once (__DIR__ . "/../functions/connection.php");

$connection = getConnection();

if (!isLogged()) {
  header("Location: ../login.php?message=login_admin");
  exit();
} else {
  if (!isAdmin()) {
    header("Location: ../index.php?message=not_admin");
    exit();
  }
}

include (__DIR__ . "/../templates/header.php");
include (__DIR__ . "/../templates/modal.php");
require_once (__DIR__ . "/../functions/functions.php");

$data = query("SELECT t.id, t.transaction_date, u.username, b.title, b.price, b.img, td.qty, td.type 
FROM transaction t 
INNER JOIN user u ON t.user_id = u.id 
INNER JOIN transaction_detail td ON t.id = td.transaction_id 
INNER JOIN books b ON td.book_id = b.id");
;
// var_dump($data);
?>
<main id="transaction-admin" class="font-notosans no-padding-margin"
  style="background-color: #e2ac6b; background-image: linear-gradient(315deg, #e2ac6b 0%, #cba36d 74%)">
  <div class="container-fluid no-padding-margin">
    <div class="row no-padding-margin">

      <?php include (__DIR__ . "/../templates/sidebar.php"); ?>

      <!-- Container -->
      <div class="col-10 d-flex flex-column justify-content-start align-items-center no-padding-margin bg-white" style="border-top-left-radius: 40px;
    border-bottom-left-radius: 40px">
        <div class="row p-4">
          <h1 class="text-start fw-3">Transaction Data</h1>
        </div>
        <div class="row">
          <div class="card p-4 container-card mb-5 border-0" style="width: 1000px">
            <table class="table align-items-center borderless" style="font-size:14px">
              <thead>
                <tr>
                  <th class="text-center">Transaction ID</th>
                  <th class="text-center">Buyer Username</th>
                  <th class="text-center">Date</th>
                  <th colspan="2" class="text-center">Book</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Type</th>
                  <th class="text-center">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $row) { ?>
                  <tr>
                    <?php
                    $qty = intval($row["qty"]);
                    $price = intval($row["price"]);
                    $total = $qty * $price;
                    ?>
                    <td class="text-center"><?= $row["id"] ?></td>
                    <td class="text-center"><?= $row["username"] ?></td>
                    <td class="text-center"><?= $row["transaction_date"] ?> </td>
                    <td><img src="../assets/books/<?= $row["img"] ?>" alt="" class="book-cover img-fluid border-2"
                        style="width: 200px; height: 100px"> </td>
                    <td class="text-center"><?= $row["title"] ?> </td>
                    <td class="text-center"><?= $row["qty"] ?> </td>
                    <td class="text-center"><?= $row["type"] ?> </td>
                    <td class="text-center">Rp <?= number_format($total, 0, ',', '.') ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
  </div>
</main>
<?php
include (__DIR__ . "/../templates/footer.php");
?>