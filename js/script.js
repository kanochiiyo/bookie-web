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
