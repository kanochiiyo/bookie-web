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
          <input type="hidden" name="modal" value="create">
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
<div class="modal fade font-inter" id="categoryEditModal" tabindex="-1" aria-labelledby="categoryEditModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="categoryEditModalLabel">Add Category</h1>
          <p class="modal-description text-muted mb-0">Complete the data to continue</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="categoryEditForm" method="post" action="../functions/handle_category.php">
          <input type="hidden" name="categoryId" id="categoryId">
          <input type="hidden" name="modal" value="edit">
          <div id="dynamicFields">
            <!-- Field dynamic di sini -->
          </div>
          <input type="hidden" name="type" id="editCategoryType">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="categoryEditForm">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- end edit modal -->