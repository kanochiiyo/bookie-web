document.addEventListener("DOMContentLoaded", function () {
  const navbarHeight = document.querySelector(".navbar").offsetHeight;

  runRadioChooseBook("cartModal", "input-number-purchase");
  runRadioChooseBook("buyModal", "input-number-purchase-buy");

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();

      const targetElement = document.querySelector(this.getAttribute("href"));
      const targetPosition =
        targetElement.getBoundingClientRect().top +
        window.scrollY -
        navbarHeight;

      window.scrollTo({
        top: targetPosition,
        behavior: "smooth",
      });
    });
  });
});

// function untuk menghilangkan input nominal ketika klik ebook
function runRadioChooseBook(modalClass, elementId) {
  const inputCountElement = document.querySelector("#" + elementId);
  const inputCount = document.querySelector("#" + elementId + " input");
  let lastValue = 1;

  const radioInputElement = document.querySelectorAll(
    "#" + modalClass + " input[name='type']"
  );

  for (radio in radioInputElement) {
    radioInputElement[radio].onclick = function () {
      if (this.value == "e-book") {
        inputCountElement.classList.add("d-none");
        lastValue = inputCount.value;
        inputCount.value = 1;
      } else {
        inputCountElement.classList.remove("d-none");
        inputCount.value = lastValue;
      }
    };
  }
}

// Function untuk slider di Review Buku modal
document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector("#rating");
  const first = document.querySelector(".first");
  const last = document.querySelector(".last");

  first.innerHTML = slider.min;
  last.innerHTML = slider.value;

  slider.addEventListener("input", function () {
    last.innerHTML = slider.value;
  });
});

// function untuk modal category
document.addEventListener("DOMContentLoaded", function () {
  const categoryModal = document.getElementById("categoryModal");
  const dynamicFields = document.getElementById("dynamicFields");
  const categoryTypeInput = document.getElementById("categoryType");

  categoryModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;
    const type = button.getAttribute("data-type");

    categoryTypeInput.value = type;

    let fields = "";
    if (type === "author") {
      fields = `
          <div class="mb-3">
            <label class="fw-bold" class="form-label" for="authorName">Author Name:</label>
            <input type="text" class="form-control" id="authorName" name="authorName" required>
          </div>
        `;
    } else if (type === "publisher") {
      fields = `
          <div class="mb-3">
            <label class="fw-bold" class="form-label" for="publisherName">Publisher Name:</label>
            <input type="text" class="form-control" id="publisherName" name="publisherName" required>
          </div>
        `;
    } else if (type === "genre") {
      fields = `
          <div class="mb-3">
            <label class="fw-bold" class="form-label" for="genreName">Genre Name:</label>
            <input type="text" class="form-control" id="genreName" name="genreName"" required>
          </div>
        `;
    }

    dynamicFields.innerHTML = fields;
  });
});

// function untuk edit review
document.addEventListener("DOMContentLoaded", function () {
  var reviewBtns = document.querySelectorAll(".reviewBtn");
  reviewBtns.forEach(function (btn) {
    btn.addEventListener("click", function () {
      var bookTitle = this.getAttribute("data-book-title");
      var author = this.getAttribute("data-author");
      var bookId = this.getAttribute("data-book-id");
      var trxDetailId = this.getAttribute("data-trx-id");
      var reviewId = this.getAttribute("data-review-id");
      var reviewContent = this.getAttribute("data-review-content");
      var reviewRating = this.getAttribute("data-review-rating");

      document.querySelector("#bookReviewModalLabel").textContent =
        "Add Review for " + bookTitle + " by " + author;
      document.querySelector('#bookReviewForm input[name="book_id"]').value =
        bookId;
      document.querySelector(
        '#bookReviewForm input[name="trxDetail_id"]'
      ).value = trxDetailId;
      document.querySelector('#bookReviewForm input[name="review_id"]').value =
        reviewId ? reviewId : "";
      document.querySelector(
        '#bookReviewForm textarea[name="reviewContent"]'
      ).value = reviewContent ? reviewContent : "";
      document.querySelector(
        '#bookReviewForm input[name="reviewRating"]'
      ).value = reviewRating ? reviewRating : "";
    });
  });
});
