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
        <form id="purchaseForm">
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
            <input type="number" class="form-control" id="size" min="1" placeholder="Enter the number of purchases"
              name="size" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="purchaseForm">Buy now</button>
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
        <form id="cartForm">
          <div class="form-group">
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
            <label class="fw-bold" for="size">number of add cart:</label>
            <input type="number" class="form-control" id="size" min="1" placeholder="Enter the number of purchases"
              name="size" required>
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


<!-- modal reviews -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="reviewModalLabel">Reviews</h1>
          <p class="modal-description text-muted mb-0">Lihat apa pendapat mereka</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php for ($i = 1; $i <= 10; $i++) { ?>
          <div class="card p-2 m-3">
            <div class="row">
              <div class="col-1 d-flex mx-0 justify-content-center">
                <img class="user-review" src="assets/user/user.png" alt="user">
              </div>
              <div class="col-11 mx-0">
                <p class="fw-bold medium-brown mb-0"> user12323232</p>
                <p class=" fw-bold mb-0 dark-brown" style="font-size:12px">
                  <i class="fa-solid fa-star"></i>
                  5
                </p>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, id sapiente magnam
                  consequuntur eius ad
                  autem
                  odio tempore, dignissimos, animi vel impedit iure. Cumque perspiciatis, consectetur quidem delectus
                  voluptatibus beatae?</p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal reviews -->

<!-- CRUD modal -->

<div class="modal fade font-inter" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="crudModalLabel">Add book's data</h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../functions/upload.php" method="post" id="crudForm" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="bookCover" class="form-label">Book Cover</label>
            <input class="form-control" type="file" id="bookCover" name="bookCover" required>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookTitle" class="col-sm-2 col-form-label">Book Title</label>
            <div class="col-sm-10">
              <input type="text" id="bookTitle" class="form-control" name="bookTitle" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookGenre" class="col-sm-2 col-form-label">Genre</label>
            <div class="col-sm-10">
              <select class="form-control" id="bookGenre" name="bookGenre" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $genres = $connection->query("SELECT * FROM genre ORDER BY name ASC");
                while ($genre = $genres->fetch_object()) {
                  ?>
                  <option value="<?= $genre->id ?>"><?= $genre->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookSynopsis" class="col-sm-2 col-form-label">Synopsis</label>
            <div class="col-sm-10">
              <input type="text" id="bookSynopsis" class="form-control" name="bookSynopsis" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
              <select class="form-control" id="author" name="author" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $authors = $connection->query("SELECT * FROM author ORDER BY name ASC");
                while ($author = $authors->fetch_object()) {
                  ?>
                  <option value="<?= $author->id ?>"><?= $author->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
            <div class="col-sm-10">
              <select class="form-control" id="publisher" name="publisher" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $publishers = $connection->query("SELECT * FROM publisher ORDER BY name ASC");
                while ($publisher = $publishers->fetch_object()) {
                  ?>
                  <option value="<?= $publisher->id ?>"><?= $publisher->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="publication" class="col-sm-2 col-form-label">Publication date</label>
            <div class="col-sm-10">
              <input type="date" id="publication" class="form-control" name="publication" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="lang" class="col-sm-2 col-form-label">Language</label>
            <div class="col-sm-10">
              <input type="text" id="lang" class="form-control" name="lang" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="pages" class="col-sm-2 col-form-label">Pages</label>
            <div class="col-sm-10">
              <input type="number" id="pages" class="form-control" name="pages" min=0 required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="weight" class="col-sm-2 col-form-label">Weight</label>
            <div class="col-sm-10">
              <input type="number" id="weight" class="form-control" name="weight" min=0 step="0.1" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
              <input type="number" id="price" class="form-control" name="price" min=0 required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="crudForm">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- End CRUD modal -->

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