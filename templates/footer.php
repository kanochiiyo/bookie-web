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

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var editButtons = document.querySelectorAll(".submitcart");

    editButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var id = button.getAttribute("data-id");
        // var name = button.getAttribute("data-name");
        document.getElementById("bookId").value = id;
        // document.getElementById("bookName").value = name;
      });
    });
  });
</script>

</body>

</html>