<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<!-- Nav JS -->
<script src="./js/script.js"></script>
<script src="../js/script.js"></script>

<script>
  // ngirim data ke modal edit
  document.addEventListener("DOMContentLoaded", function () {
    var editButtons = document.querySelectorAll(".editBookBtn");

    editButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var id = button.getAttribute("data-edit-id");
        var title = button.getAttribute("data-title");
        var synopsis = button.getAttribute("data-synopsis");
        var author = button.getAttribute("data-author");
        var genreId = button.getAttribute("data-genre");
        var publisherId = button.getAttribute("data-publisher");
        var publication = button.getAttribute("data-publication");
        var language = button.getAttribute("data-language");
        var pages = button.getAttribute("data-pages");
        var weight = button.getAttribute("data-weight");
        var price = button.getAttribute("data-price");

        document.getElementById("edit_id").value = id;
        document.getElementById("edit_book_title").value = title;
        document.getElementById("edit_book_genre").value = genreId;
        document.getElementById("edit_book_synopsis").value = synopsis;
        document.getElementById("edit_author").value = author;
        document.getElementById("edit_publisher").value = publisherId;
        document.getElementById("edit_publication").value = publication;
        document.getElementById("edit_lang").value = language;
        document.getElementById("edit_pages").value = pages;
        document.getElementById("edit_weight").value = weight;
        document.getElementById("edit_price").value = price;
      });
    });
  });
</script>
</body>

</html>