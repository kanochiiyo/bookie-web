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

$data = query("SELECT b.id, b.img, b.title, g.name as genre, b.synopsis, a.name as author, p.name as publisher, b.publication_date, b.language, b.totalpage, b.weight, b.price 
FROM books b
INNER JOIN genre g ON b.genre_id = g.id 
INNER JOIN author a ON b.author_id = a.id
INNER JOIN publisher p ON b.publisher_id = p.id");
// var_dump($data);
?>

<main id="book-crud" class="font-notosans no-padding-margin" style="background-color: #e2ac6b; background-image:
  linear-gradient(315deg, #e2ac6b 0%, #cba36d 74%)">
  <div class="container-fluid no-padding-margin">
    <div class="row no-padding-margin">

      <?php include (__DIR__ . "/../templates/sidebar.php"); ?>

      <!-- Container -->
      <div class="col-10 d-flex flex-column justify-content-start align-items-center no-padding-margin bg-white">
        <div class="row p-4 w-100">
          <h1 class="text-start fw-3">Books Data</h1>
        </div>
        <div class="row w-100">
          <div class="card py-3 container-card mb-5 border-0 w-100">
            <a href="#" class="links-bg-white mt-1 mb-3" style="width:110px" data-bs-toggle="modal"
              data-bs-target="#crudModal"><i class="fa-solid fa-plus"></i> Add Data</a>
            <table class="table align-items-center borderless" style="font-size:14px">
              <thead>
                <tr>
                  <th>Books ID</th>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $row) { ?>
                  <tr>
                    <td><?= $row["id"] ?> </td>
                    <td><img src="../assets/books/<?= $row["img"] ?>" alt="" class="book-cover img-fluid"> </td>
                    <td><?= $row["title"] ?> </td>
                    <td><?= $row["genre"] ?> </td>
                    <td><?= $row["synopsis"] ?> </td>
                    <td><?= $row["author"] ?> </td>
                    <td><?= $row["publisher"] ?> </td>
                    <td><?= $row["publication_date"] ?> </td>
                    <td><?= $row["language"] ?> </td>
                    <td><?= $row["totalpage"] ?> </td>
                    <td><?= $row["weight"] ?> </td>
                    <td><?= $row["price"] ?> </td>
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