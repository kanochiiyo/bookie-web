<?php
session_start();

require_once (__DIR__ . "/functions/authentication.php");
include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
include (__DIR__ . "/templates/modal.php");
?>
<section class="sec-detail max-vw-100 min-vh-100" id="detail">
  <div class="container mt-5 pt-5">
    <div class="row ">
      <!-- foto buku disini -->
      <div class="col-6 p-5">
        <div class="position-absolute d-flex justify-content-center">
          <img class="detail-img d-block object-fit-cover" src="assets/books/book1.jpg" alt="buku1">
        </div>
      </div>
      <!-- judul buku disini -->
      <div class="col-6 pt-5">
        <h1 class="mt-5 mb-3 fw-bold">
          Harry Potter:Half Blood Prince
        </h1>
        <h2 class="mb-3">Rake Putri Cahyani</h2>
        <p class="">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit
          dolorem maxime, esse quod molestias nam ut laborum quos
        </p>
        <p class="dark-brown fw-bold" style="font-size:12px">
          <i class="fa-solid fa-star"></i>
          4,5
        </p>

        <p class="fw-bold mb-0" style="font-size:28px">$20</p>
      </div>
    </div>

    <!-- content bg putih -->
    <div class="container bg-white min-vh-100">
      <div class="row mt-5 pt-4">
        <div class="col-6">
        </div>
        <div class="col-6">
          <div>
            <a href="#" class="links-bg mt-1 mb-3" data-bs-toggle="modal" data-bs-target="#buyModal" type="button">Buy
              now</a>
            <a href="#" class="links-bg-white mt-1 mb-3" data-bs-toggle="modal" data-bs-target="#cartModal"
              type="button"> Add to cart</a>
          </div>
          <div class="me-5">
            <div class="d-flex justify-content-end">
              <a href="#synopsis" class="mx-3 mini-nav" type="submit">Synopsis</a>
              <a href="#details" class="mx-3 mini-nav" type="submit">Book's Details</a>
              <a href="#reviews" class="ms-3 mini-nav" type="submit">Reviews</a>
            </div>
            <hr>
          </div>
        </div>
      </div>
      <!-- start synopsis -->
      <div class="m-5" id="synopsis">
        <h2 class="mb-3 fw-bold">Synopsis</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, id sapiente magnam consequuntur eius ad autem
          odio tempore, dignissimos, animi vel impedit iure. Cumque perspiciatis, consectetur quidem delectus
          voluptatibus beatae?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, id sapiente magnam consequuntur eius ad autem
          odio tempore, dignissimos, animi vel impedit iure. Cumque perspiciatis, consectetur quidem delectus
          voluptatibus beatae?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, id sapiente magnam consequuntur eius ad autem
          odio tempore, dignissimos, animi vel impedit iure. Cumque perspiciatis, consectetur quidem delectus
          voluptatibus beatae?</p>
      </div>
      <!-- end synopsis -->
      <!-- start details -->
      <div class="mx-5 mb-5 card p-3 shadow" id="details">
        <h2 class="mb-3 fw-bold">Book's Details</h2>
        <div class="row">
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              number of pages
            </p>
            <p>
              124
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Publication date
            </p>
            <p>
              20-04-2020
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              ISBN
            </p>
            <p>
              12434324333
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Publisher
            </p>
            <p>
              Gramedia's book
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Language
            </p>
            <p>
              English
            </p>
          </div>
          <div class="col-6">
            <p class="fw-bold medium-brown mb-0">
              Weight
            </p>
            <p>
              0.2 kg
            </p>
          </div>
          <div class="col-6 mb-0">
            <p class="fw-bold medium-brown mb-0">
              Height
            </p>
            <p>
              18 cm
            </p>
          </div>
          <div class="col-6 mb-0">
            <p class="fw-bold medium-brown mb-0">
              Width
            </p>
            <p>
              10 cm
            </p>
          </div>
        </div>
      </div>
      <!-- end details -->
      <!-- start reviews -->
      <div class="mx-5" id="reviews">
        <h2 class="mb-0 fw-bold">Reviews</h2>
        <div class="d-flex justify-content-end">
          <p class="dark-brown fw-bold" style="font-size: 22px;">
            <i class="fa-solid fa-star"></i>
            4,5
          </p>
        </div>
        <hr class="mt-0">
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
        <div class="d-flex justify-content-end pb-5">
          <a href="#" class="dark-brown fw-bold" data-bs-toggle="modal" data-bs-target="#reviewModal"
            type="button"><u>More reviews..</u></a>
        </div>
      </div>
      <!-- end reviews -->
    </div>
  </div>
</section>
<?php
include (__DIR__ . "/templates/credit.php");
include (__DIR__ . "/templates/footer.php");
?>