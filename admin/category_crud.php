<?php
session_start();

require_once (__DIR__ . "/../functions/authentication.php");
require_once (__DIR__ . "/../functions/connection.php");
require_once (__DIR__ . "/../functions/functions.php");

$connection = getConnection();

if (!isLogged()) {
  header("Location: ../login.php?message=login_admin");
  exit();
} else {
  if (!isAdmin()) {
    header("Location: ../index.php?message=not_admin");
    exit();
  }
}

if (isset($_SESSION["error"])) {
  echo "<script>
        alert('" . $_SESSION['error'] . "');
    </script>";
  unset($_SESSION["error"]);
}

if (isset($_SESSION["success"])) {
  echo "<script>
        alert('" . $_SESSION['success'] . "');
    </script>";
  unset($_SESSION["success"]);
}

include (__DIR__ . "/../templates/header.php");
include (__DIR__ . "/../templates/category_modal.php");

// Read Category
$author = query("SELECT id AS author_id, name AS author_name FROM author");
$genre = query("SELECT id AS genre_id, name AS genre_name FROM genre");
$publisher = query("SELECT id AS publisher_id, name AS publisher_name FROM publisher");
?>

<main id="category-crud" class="font-notosans no-padding-margin" style="background-color: #e2ac6b; background-image:
  linear-gradient(315deg, #e2ac6b 0%, #cba36d 74%)">
  <div class="container-fluid no-padding-margin">
    <div class="row no-padding-margin">

      <?php include (__DIR__ . "/../templates/sidebar.php"); ?>

      <!-- Container -->
      <div class="col-10 d-flex flex-column justify-content-start align-items-center no-padding-margin bg-white" style="border-top-left-radius: 40px;
    border-bottom-left-radius: 40px">
        <div class="row p-4 w-100">
          <h1 class="text-start fw-3">Category Data</h1>
        </div>
        <div class="row w-100">
          <div class="card py-3 container-card mb-5 border-0 ">

            <div class="row my-3 d-flex justify-content-around">
              <div class="col-auto">
                <button id="addAuthorBtn" class="links-bg-white" type="button" data-bs-toggle="modal"
                  data-bs-target="#categoryModal" data-type="author">
                  <i class="fa-solid fa-plus"></i> Add Author
                </button>
              </div>
              <div class="col-auto">
                <button id="addPublisherBtn" class="links-bg-white" type="button" data-bs-toggle="modal"
                  data-bs-target="#categoryModal" data-type="publisher">
                  <i class="fa-solid fa-plus"></i> Add Publisher
                </button>
              </div>
              <div class="col-auto">
                <button id="addGenreBtn" class="links-bg-white" type="button" data-bs-toggle="modal"
                  data-bs-target="#categoryModal" data-type="genre">
                  <i class="fa-solid fa-plus"></i> Add Genre
                </button>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <table class="table align-items-center borderless" style="font-size:14px">
                  <thead>
                    <tr>
                      <th class="text-center">Author ID</th>
                      <th class="text-center">Author Name</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($author as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $row["author_id"] ?> </td>
                        <td class="text-center"><?= $row["author_name"] ?> </td>
                        <td>
                          <a id="addAuthorBtn" type="button" data-bs-toggle="modal" data-bs-target="#categoryEditModal"
                            data-type="author" data-id="<?= $row["author_id"] ?>"
                            data-name="<?= $row["author_name"] ?>"><i class=" fa-solid fa-pen"></i></a>
                          <a href="../functions/handle_category.php?op=delete&type=author&id=<?= $row["author_id"] ?>"
                            onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="col">
                <table class="table align-items-center borderless" style="font-size:14px">
                  <thead>
                    <tr>
                      <th class="text-center">Publisher ID</th>
                      <th class="text-center">Publisher Name</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($publisher as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $row["publisher_id"] ?> </td>
                        <td class="text-center"><?= $row["publisher_name"] ?> </td>
                        <td>
                          <a id="addPublisherBtn" type="button" data-bs-toggle="modal" data-bs-target="#categoryEditModal"
                            data-type="publisher" data-id="<?= $row["publisher_id"] ?>"
                            data-name="<?= $row["publisher_name"] ?>"><i class="fa-solid fa-pen"></i></a>
                          <a href="../functions/handle_category.php?op=delete&type=publisher&id=<?= $row["publisher_id"] ?>"
                            onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="col">
                <table class="table align-items-center borderless" style="font-size:14px">
                  <thead>
                    <tr>
                      <th class="text-center">Genre ID</th>
                      <th class="text-center">Genre Name</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($genre as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $row["genre_id"] ?> </td>
                        <td class="text-center"><?= $row["genre_name"] ?> </td>
                        <td>
                          <a id="addGenreBtn" type="button" data-bs-toggle="modal" data-bs-target="#categoryEditModal"
                            data-type="genre" data-id="<?= $row["genre_id"] ?>" data-name="<?= $row["genre_name"] ?>"><i
                              class="fa-solid fa-pen"></i></a>
                          <a href="../functions/handle_category.php?op=delete&type=genre&id=<?= $row["genre_id"] ?>"
                            onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include (__DIR__ . "/../templates/footer.php");
?>