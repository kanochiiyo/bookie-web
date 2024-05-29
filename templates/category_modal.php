<!-- modal category -->
<div class="modal fade font-inter" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="categoryModalLabel">Add Category</h1>
          <p class="modal-description text-muted mb-0">Complete the data to continue</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="categoryForm" method="post" action="../functions/handle_category.php">
          <div id="dynamicFields">
            <!-- Field dynamic di sini -->
          </div>
          <input type="hidden" name="type" id="categoryType">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="categoryForm">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal category -->

<!-- edit modal -->


<script>
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
</script>