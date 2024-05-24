<?php
include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
?>
<section class="d-flex justify-content-center align-items-center min-vh-100 max-vw-100" style="padding-top:80px">
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
          <?php for ($i = 1; $i <= 3; $i++) { ?>
            <div class="card p-2 mb-2">
              <div class="row">
                <div class="col-2">
                  <img src="assets/books/book1.jpg" alt="book" class="rounded object-fit-cover" style="width: 75px;">
                </div>
                <div class="col-4">
                  <p>Harry Potter: Half Blood Prince</p>
                  <p>e-book</p>
                </div>
                <div class="col-2">
                  <input class="form-control" type="number" value="2" min="1">
                </div>
                <div class="col-2">
                  <p>$2544</p>
                </div>
                <div class="col-2">
                  <p>$5044</p>
                </div>
              </div>
            </div>
          <?php } ?>
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
                  $56890
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
              <p class="fw-bold" style="font-size: 20px">$56890</p>
            </span>
            <a href="product.php" class="text-center links-co-white mb-3" style="width: 100%; font-size:15px"> Continue
              shopping </a>
            <button type="submit" class="links-co" style="width: 100%;"> Checkout </button>
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