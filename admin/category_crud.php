<?php
session_start();

require_once (__DIR__ . "/../functions/authentication.php");
require_once (__DIR__ . "/../functions/connection.php");

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
include (__DIR__ . "/../templates/modal.php");
include (__DIR__ . "/../functions/read.php");

$author = query("SELECT id as author_id, name as author_name FROM author");
$genre = query("SELECT id as genre_id, name as genre_name FROM genre");
$publisher = query("SELECT id as publisher_id, name as publisher_name FROM publisher");
?>

<main id="book-crud" class="font-notosans no-padding-margin" style="background-color: #e2ac6b; background-image:
  linear-gradient(315deg, #e2ac6b 0%, #cba36d 74%)">
  <div class="container-fluid no-padding-margin">
    <div class="row no-padding-margin">

      <?php include (__DIR__ . "/../templates/sidebar.php"); ?>

      <!-- Container -->
      <div class="col-10 d-flex flex-column justify-content-start align-items-center no-padding-margin bg-white">
        <div class="row p-4 w-100">
          <h1 class="text-start fw-3">Category Data</h1>
        </div>
        <div class="row w-100">
          <div class="card py-3 container-card mb-5 border-0 ">
            <div class="row">
              <a href="#" class="links-bg-white mt-1 mb-3" style="width:110px" data-bs-toggle="modal"
                data-bs-target="#crudModal"><i class="fa-solid fa-plus"></i> Add Data</a>
            </div>

            <div class="row">
              <div class="col-3">
                <table class="table align-items-center borderless" style="font-size:14px">
                  <thead>
                    <tr>
                      <th class="text-center">Author ID</th>
                      <th class="text-center">Author Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($author as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $row["author_id"] ?> </td>
                        <td class="text-center"><?= $row["author_name"] ?> </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="col-3">
                <table class="table align-items-center borderless" style="font-size:14px">
                  <thead>
                    <tr>
                      <th class="text-center">Publisher ID</th>
                      <th class="text-center">Publisher Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($genre as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $row["genre_id"] ?> </td>
                        <td class="text-center"><?= $row["genre_name"] ?> </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <div class="col-3">
                <table class="table align-items-center borderless" style="font-size:14px">
                  <thead>
                    <tr>
                      <th class="text-center">Genre ID</th>
                      <th class="text-center">Genre Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($publisher as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $row["publisher_id"] ?> </td>
                        <td class="text-center"><?= $row["publisher_name"] ?> </td>
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