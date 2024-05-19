<?php
// nambahin code header dan navbar biar gak bikin code yang sama berulang kali di beda page
include (__DIR__ . "/templates/header.php");
include (__DIR__ . "/templates/navbar.php");
?>

<main>
  <!-- Hero -->
  <section class="hero" id="hero">
    <div class="container">
      <div class="row">
        <div class="col-8 my-5">
          <p class="d-inline-block disclaimer bg-white mb-3">
            ● Your next good reading is waiting
          </p>
          <h1 class="fw-bold mt-3 mb-3" style="letter-spacing: 2px">
            Discover Worlds Between Pages
          </h1>
          <p class="mt-3 mb-3">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit
            dolorem maxime, esse quod molestias nam ut laborum quos quo sint
            non quidem obcaecati, porro iusto aliquam quam. Quae,
            consectetur minus?
          </p>
          <form class="d-inline-block mt-3 mb-3" role="search">
            <input class="form-control me-2 border-1" style="border-color: black" type="search"
              placeholder="Search books" />
            <span>
              <a href="#" class="links-bg my-3" type="submit">Browse books</a>
            </span>
          </form>
        </div>

        <div class="col-4" style="height: 480px; margin-top: 40px">
          <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade " data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/hero.jpg" alt="Bookstore image" class="hero-img rounded d-block object-fit-cover">
              </div>
              <div class="carousel-item">
                <img src="assets/hero2.jpg" alt="Bookstore image" class="hero-img rounded d-block object-fit-cover">
              </div>
              <div class="carousel-item">
                <img src="assets/hero3.jpg" alt="Bookstore image" class="hero-img rounded d-block object-fit-cover">
              </div>
            </div>
          </div>
          <!-- <img class="hero-img rounded d-block object-fit-cover" src="assets/hero.jpg" alt="Bookstore image" /> -->
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero -->

  <!-- Section 2 -->
  <section id="desc">
    <div class="container">
      <p class="d-inline-block disclaimer mb-2 my-5">
        ● Why choose bookie
      </p>
      <h1 class="mt-1 mb-3">
        Best way to manage your <br> reading life
      </h1>
      <p class="mt-3 mb-3">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. <br> Fugit
        dolorem maxime, esse quod molestias nam ut laborum quos
      </p>
      <div class="row text-center my-5">
        <div class="col-4 p-5">
          <i class="fa-solid fa-magnifying-glass mb-3"></i>
          <h2>Book Discovery</h2>
          <p class="mt-2 mb-3">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit
            dolorem maxime, esse quod molestias nam ut laborum quos
          </p>
        </div>
        <div class="col-4 p-5">
          <i class="fa-solid fa-users mb-3"></i>
          <h2>Friends and Community</h2>
          <p class="mt-2 mb-3">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit
            dolorem maxime, esse quod molestias nam ut laborum quos
          </p>
        </div>
        <div class="col-4 p-5">
          <i class="fa-solid fa-star mb-3"></i>
          <h2>Book Review</h2>
          <p class="mt-2 mb-3">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit
            dolorem maxime, esse quod molestias nam ut laborum quos
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- End Section 2 -->

  <!-- section 3 -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-4" style="height: 480px; margin-top: 40px">
          <img class="hero-img rounded d-block object-fit-cover" src="assets/desc.jpg" alt="Bookstore image" />
        </div>
        <div class="col-8 p-5">
          <p class="d-inline-block disclaimer mb-2 my-5">
            ● Why choose bookie
          </p>
          <h1 class="mt-1 mb-3">
            Best way to discover, track, and share your reading life
          </h1>
          <p class="mt-3 mb-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo enim officiis minima itaque, tenetur aliquid
            quae fuga, voluptatum vero voluptatem architecto exercitationem, labore dolor dolorum quibusdam cum id neque
            a!
          </p>
          <span>
            <a href="#" class="links-bg my-3" type="submit">Join for free(?)</a>
          </span>
        </div>
      </div>

  </section>
  <!-- end section 3 -->
</main>

<?php
include (__DIR__ . "/templates/footer.php");
?>