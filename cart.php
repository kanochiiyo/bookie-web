<?php
include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
?>
<section class="sec-detail max-vw-100" id="cart" style="margin-top: 70px">
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
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th colspan="2" scope="col">Product</th>
                <th scope="col">Type</th>
                <th scope="col">Qty</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <tr>
                  <th scope="row">
                    <input class="form-check-input" type="checkbox" value="check<?= $i; ?>" id="check"
                      name="check<?= $i; ?>">
                  </th>
                  <td>
                    <img src="assets/books/book1.jpg" alt="book" class="rounded object-fit-cover" style="width: 75px;">
                  </td>
                  <td>Harry Potter: Half Blood Prince</td>
                  <td>e-book</td>
                  <td>1</td>
                  <td>$25</td>
                  <td>
                    <span class="d-flex justify-content-center">
                      <a href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </span>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="2" scope="row" class="fw-bold"><span class="medium-brown">Total Price</span></td>
                <td scope="row"></td>
                <td scope="row"></td>
                <td scope="row"></td>
                <td colspan="2" scope="row" class="fw-bold"><span class="dark-brown">$2000000</span></td>
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