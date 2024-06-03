<!-- Modal buy now -->
<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="buyModalLabel">Purchase details</h1>
          <p class="modal-description text-muted mb-0">Complete the data to continue</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="PurchaseFormOrder" action="checkout.php" method="post">
          <input type="hidden" id="buy_id" class="form-control" name="book_id">
          <div class="form-group">
            <label class="fw-bold" for="type">Type of book:</label>
            <p class="mb-0" style="font-size: 12px">*select one</p>
            <div class="row">
              <div class="col-6">
                <div class="form-check form-check-inline p-0" style="width: 100%">
                  <input class="btn-check" type="radio" id="buy-e-book" name="type" value="e-book" autocomplete="off"
                    required>
                  <label class="btn" for="buy-e-book" style="width: 100%">e-book</label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check form-check-inline p-0" style="width: 100%">
                  <input class="btn-check" type="radio" id="buy-physical-book" name="type" value="physical book"
                    autocomplete="off">
                  <label class="btn" for="buy-physical-book" style="width: 100%">physical book</label>
                </div>
              </div>
            </div>
          </div>
          <div id="input-number-purchase-buy" class="form-group mt-3 d-none">
            <label class="fw-bold" for="size">number of add cart:</label>
            <input type="number" class="form-control" id="size" name="size" min="1"
              placeholder="Enter the number of purchases" name="size" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="PurchaseFormOrder">Buy now</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal buy-->


<!-- modal cart -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="cartModalLabel">Add to cart details</h1>
          <p class="modal-description text-muted mb-0">Complete the data to continue</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="cartForm" action="functions/handle_cart.php" method="post">
          <div class="form-group">
            <div class="row">
              <input type="hidden" id="bookId" class="form-control" name="book_id" value="">
            </div>
            <div class="row">
              <input type="hidden" id="bookName" class="form-control" name="book_name" value="">
            </div>
            <label class="fw-bold" for="type">Type of book:</label>
            <p class="mb-0" style="font-size: 12px">*select one</p>
            <div class="row">
              <div class="col-6">
                <div class="form-check form-check-inline p-0" style="width: 100%">
                  <input class="btn-check" type="radio" id="cart-e-book" name="type" value="e-book" autocomplete="off"
                    required>
                  <label class="btn" for="cart-e-book" style="width: 100%">e-book</label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check form-check-inline p-0" style="width: 100%">
                  <input class="btn-check" type="radio" id="cart-physical-book" name="type" value="physical book"
                    autocomplete="off">
                  <label class="btn" for="cart-physical-book" style="width: 100%">physical book</label>
                </div>
              </div>
            </div>
          </div>
          <div id="input-number-purchase" class="form-group mt-3 d-none">
            <label class="fw-bold" for="amount">Amount : </label>
            <input type="number" class="form-control" id="amount" min="1" placeholder="Enter the number of purchases"
              name="amount" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="cartForm">Add to cart</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal cart -->