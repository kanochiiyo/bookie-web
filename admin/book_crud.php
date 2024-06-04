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
$errorMessage = getFlash('error');
$successMessage = getFlash('success');

if ($errorMessage) {
  echo "<script>
        alert('$errorMessage');
    </script>";
}

if ($successMessage) {
  echo "<script>
        alert('$successMessage');
    </script>";
}

include (__DIR__ . "/../templates/header.php");

$data = query("SELECT b.id, b.img, b.title, b.genre_id, b.author_id, b.publisher_id, g.name as genre, b.synopsis, a.name as author, p.name as publisher, b.publication_date, b.language, b.totalpage, b.weight, b.price 
FROM books b
INNER JOIN genre g ON b.genre_id = g.id 
INNER JOIN author a ON b.author_id = a.id
INNER JOIN publisher p ON b.publisher_id = p.id");
// var_dump($data);
?>

<!-- Create modal -->
<div class="modal fade font-inter" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="crudModalLabel">Add book's data</h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../functions/upload.php" method="post" id="crudForm" enctype="multipart/form-data">
          <input type="hidden" name="op" value="create">
          <div class="mb-3">
            <label for="bookCover" class="form-label">Book Cover</label>
            <input class="form-control" type="file" id="bookCover" name="bookCover" required>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookTitle" class="col-sm-2 col-form-label">Book Title</label>
            <div class="col-sm-10">
              <input type="text" id="bookTitle" class="form-control" name="bookTitle" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookGenre" class="col-sm-2 col-form-label">Genre</label>
            <div class="col-sm-10">
              <select class="form-control" id="bookGenre" name="bookGenre" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $genres = $connection->query("SELECT * FROM genre ORDER BY name ASC");
                while ($genre = $genres->fetch_object()) {
                  ?>
                  <option value="<?= $genre->id ?>"><?= $genre->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookSynopsis" class="col-sm-2 col-form-label">Synopsis</label>
            <div class="col-sm-10">
              <input type="text" id="bookSynopsis" class="form-control" name="bookSynopsis" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
              <select class="form-control" id="author" name="author" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $authors = $connection->query("SELECT * FROM author ORDER BY name ASC");
                while ($author = $authors->fetch_object()) {
                  ?>
                  <option value="<?= $author->id ?>"><?= $author->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
            <div class="col-sm-10">
              <select class="form-control" id="publisher" name="publisher" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $publishers = $connection->query("SELECT * FROM publisher ORDER BY name ASC");
                while ($publisher = $publishers->fetch_object()) {
                  ?>
                  <option value="<?= $publisher->id ?>"><?= $publisher->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="publication" class="col-sm-2 col-form-label">Publication date</label>
            <div class="col-sm-10">
              <input type="date" id="publication" class="form-control" name="publication" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="lang" class="col-sm-2 col-form-label">Language</label>
            <div class="col-sm-10">
              <input type="text" id="lang" class="form-control" name="lang" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="pages" class="col-sm-2 col-form-label">Pages</label>
            <div class="col-sm-10">
              <input type="number" id="pages" class="form-control" name="pages" min=0 required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="weight" class="col-sm-2 col-form-label">Weight</label>
            <div class="col-sm-10">
              <input type="number" id="weight" class="form-control" name="weight" min=0 step="0.1" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
              <input type="number" id="price" class="form-control" name="price" min=0 required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="crudForm">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- End Create modal -->

<!-- start edit modal -->
<div class="modal fade font-inter" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg">
    <div class="modal-content modal-bg">
      <div class="modal-header">
        <div>
          <h1 class="modal-title fs-5" id="editBookModalLabel">Edit book's data</h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../functions/upload.php" method="post" id="editBookForm" enctype="multipart/form-data">
          <input type="hidden" name="op" value="edit">
          <input class="form-control" type="hidden" id="edit_id" name="edit_id" required>
          <div class="mb-3">
            <label for="bookCover" class="form-label">Book Cover</label>
            <input class="form-control" type="file" id="bookCover" name="bookCover">
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookTitle" class="col-sm-2 col-form-label">Book Title</label>
            <div class="col-sm-10">
              <input type="text" id="edit_book_title" class="form-control" name="bookTitle" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookGenre" class="col-sm-2 col-form-label">Genre</label>
            <div class="col-sm-10">
              <select class="form-control" id="edit_book_genre" name="bookGenre" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $genres = $connection->query("SELECT * FROM genre ORDER BY name ASC");
                while ($genre = $genres->fetch_object()) {
                  ?>
                  <option value="<?= $genre->id ?>"><?= $genre->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="bookSynopsis" class="col-sm-2 col-form-label">Synopsis</label>
            <div class="col-sm-10">
              <input type="text" id="edit_book_synopsis" class="form-control" name="bookSynopsis" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="author" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
              <select class="form-control" id="edit_author" name="author" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $authors = $connection->query("SELECT * FROM author ORDER BY name ASC");
                while ($author = $authors->fetch_object()) {
                  ?>
                  <option value="<?= $author->id ?>"><?= $author->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
            <div class="col-sm-10">
              <select class="form-control" id="edit_publisher" name="publisher" required>
                <option value="" disabled selected>Select one option</option>
                <?php
                $publishers = $connection->query("SELECT * FROM publisher ORDER BY name ASC");
                while ($publisher = $publishers->fetch_object()) {
                  ?>
                  <option value="<?= $publisher->id ?>"><?= $publisher->name ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="publication" class="col-sm-2 col-form-label">Publication date</label>
            <div class="col-sm-10">
              <input type="date" id="edit_publication" class="form-control" name="publication" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="lang" class="col-sm-2 col-form-label">Language</label>
            <div class="col-sm-10">
              <input type="text" id="edit_lang" class="form-control" name="lang" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="pages" class="col-sm-2 col-form-label">Pages</label>
            <div class="col-sm-10">
              <input type="number" id="edit_pages" class="form-control" name="pages" min=0 required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="weight" class="col-sm-2 col-form-label">Weight</label>
            <div class="col-sm-10">
              <input type="number" id="edit_weight" class="form-control" name="weight" min=0 step="0.1" required>
            </div>
          </div>
          <div class="mb-3 row d-flex align-items-center">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
              <input type="number" id="edit_price" class="form-control" name="price" min=0 required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="links-bg-white" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="links-bg" form="editBookForm">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- end edit modal -->

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
                      <a class="p-2 text-black editBookBtn" data-bs-toggle="modal" data-bs-target="#editBookModal"
                        data-edit-id="<?= $row["id"] ?>" data-title="<?= $row["title"] ?>"
                        data-genre="<?= $row["genre_id"] ?>" data-synopsis="<?= $row["synopsis"] ?>"
                        data-author="<?= $row["author_id"] ?>" data-publisher="<?= $row["publisher_id"] ?>"
                        data-publication="<?= $row["publication_date"] ?>" data-language="<?= $row["language"] ?>"
                        data-pages="<?= $row["totalpage"] ?>" data-weight="<?= $row["weight"] ?>"
                        data-price="<?= $row["price"] ?>">
                        <i class="fa-solid fa-pen"></i>
                      </a>
                      <a href="../functions/upload.php?op=delete&id=<?= $row["id"] ?>"
                        onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
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