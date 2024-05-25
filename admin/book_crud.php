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
?>

<main id="book-crud" class="font-notosans no-padding-margin"
  style="background-color: #e2ac6b; background-image: linear-gradient(315deg, #e2ac6b 0%, #cba36d 74%)">
  <div class="container-fluid no-padding-margin">
    <div class="row no-padding-margin">

      <?php include (__DIR__ . "/../templates/sidebar.php"); ?>

      <!-- Container -->
      <div class="col-10 d-flex flex-column justify-content-start align-items-center no-padding-margin bg-white">
        <div class="row p-4">
          <h1 class="text-start fw-3">Books Data</h1>
        </div>
        <div class="row">
          <div class="card p-4 container-card mb-5 border-0">
            <a href="#" class="links-bg mt-1 mb-3" data-bs-toggle="modal" data-bs-target="#crudModal" type=n"><i
                class="fa-solid fa-plus"></i> Add Data</a>
            <table class="table align-items-center">
              <thead>
                <tr>
                  <th class="Child">Books ID</th>
                  <th>Cover</th>
                  <th>Title</th>
                  <th>Genre</th>
                  <th>Synopsis</th>
                  <th>Author</th>
                  <th>Publisher</th>
                  <th>Publication Date</th>
                  <th>Language</th>
                  <th>Pages</th>
                  <th>Weight</th>
                  <th>Price</th>
                  <th class="Child">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 0; $i < 10; $i++) { ?>
                  <tr>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>
                      <a class="p-2 text-black" href=""><i class="fa-solid fa-pen"></i></a>
                      <a class="p-2 text-black" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
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
</main>
<?php
include (__DIR__ . "/../templates/footer.php");
?>