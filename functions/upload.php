<?php

session_start();

// Koneksi ke database
require_once (__DIR__ . "/connection.php");
require_once (__DIR__ . "/functions.php");
$connection = getConnection();


$errorMessage = NULL;
$successMessage = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST["op"] == "create") {
    $bookTitle = $_POST['bookTitle'];
    $bookGenre = $_POST['bookGenre'];
    $bookSynopsis = $_POST['bookSynopsis'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $publication = $_POST['publication'];
    $lang = $_POST['lang'];
    $pages = $_POST['pages'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    $target_dir = "../assets/books/";

    $temp_file = $_FILES["bookCover"]["tmp_name"] ?? null;
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($_FILES["bookCover"]["name"] ?? '', PATHINFO_EXTENSION));

    if ($temp_file && getimagesize($temp_file) !== false) {
      $uploadOK = 1;
    } else {
      $errorMessage .= "File bukan gambar. ";
      $uploadOK = 0;
    }

    if ($_FILES["bookCover"]["size"] > 3000000) {
      $errorMessage .= "File terlalu besar, maksimal 3MB. ";
      $uploadOK = 0;
    }

    // Batasi format file yang diizinkan
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
      $errorMessage .= "Hanya menerima JPG, JPEG, PNG, & GIF. ";
      $uploadOK = 0;
    }

    if ($uploadOK == 0) {
      $errorMessage = "Maaf, tidak dapat mengupload data. " . $errorMessage;
    } else {
      $insert = $connection->query("INSERT INTO books (title, synopsis, price, language, weight, publication_date, publisher_id, author_id, genre_id, totalpage) VALUES ('$bookTitle', '$bookSynopsis', $price, '$lang', $weight, '$publication', $publisher, $author, $bookGenre, $pages)");

      if ($insert) {
        $book_id = $connection->insert_id;
        $new_file_name = $book_id . "." . $imageFileType;
        $target_file = $target_dir . $new_file_name;

        if (move_uploaded_file($temp_file, $target_file)) {
          $update = $connection->query("UPDATE books SET img='$new_file_name' WHERE id='$book_id'");

          if ($update) {
            $successMessage .= "Berhasil menambahkan data buku.";
          } else {
            $errorMessage .= $connection->error;
          }
        } else {
          $errorMessage = "Sorry, there was an error uploading your file. " . $errorMessage;
        }
      } else {
        $errorMessage .= $connection->error;
      }
    }
  } elseif ($_POST["op"] == "edit") {
    $id = $_POST['edit_id'] ?? null;
    $bookTitle = $_POST['bookTitle'];
    $bookGenre = $_POST['bookGenre'];
    $bookSynopsis = $_POST['bookSynopsis'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $publication = $_POST['publication'];
    $lang = $_POST['lang'];
    $pages = $_POST['pages'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    // var_dump($bookTitle);

    // update ke db
    $update = $connection->query("UPDATE books SET title = '$bookTitle',  synopsis = '$bookSynopsis',  price = $price,  language = '$lang',  weight = $weight, publication_date = '$publication',  publisher_id = $publisher, author_id = $author, genre_id = $bookGenre,  totalpage = $pages WHERE id = $id");

    if (!$update) {
      $errorMessage .= $connection->error;
    } else {
      $successMessage .= "Berhasil mengedit data buku";
    }

    if (isset($_FILES["bookCover"]) && $_FILES["bookCover"]["tmp_name"]) {
      $target_dir = "../assets/books/";

      $temp_file = $_FILES["bookCover"]["tmp_name"];
      $uploadOK = 1;
      $imageFileType = strtolower(pathinfo($_FILES["bookCover"]["name"], PATHINFO_EXTENSION));

      if (getimagesize($temp_file) !== false) {
        $uploadOK = 1;
      } else {
        $errorMessage .= "File bukan gambar. ";
        $uploadOK = 0;
      }

      if ($_FILES["bookCover"]["size"] > 3000000) {
        $errorMessage .= "File terlalu besar, maksimal 3MB. ";
        $uploadOK = 0;
      }

      if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        $errorMessage .= "Hanya menerima JPG, JPEG, PNG, & GIF. ";
        $uploadOK = 0;
      }

      if ($uploadOK == 0) {
        $errorMessage = "Maaf, tidak dapat mengupload gambar. " . $errorMessage;
      } else {
        $new_file_name = $id . "_edit." . $imageFileType;
        $target_file = $target_dir . $new_file_name;

        // mindah file
        if (move_uploaded_file($temp_file, $target_file)) {
          // Update cover buku pake nama baru
          $update = $connection->query("UPDATE books SET img='$new_file_name' WHERE id='$id'");

          if ($update) {
            $successMessage .= " dan gambar buku.";
          } else {
            $errorMessage .= $connection->error;
          }
        } else {
          $errorMessage = "Sorry, there was an error uploading your file. " . $errorMessage;
        }
      }
    }
  }
}


// Delete
if (isset($_GET['op']) && isset($_GET['id'])) {
  $op = $_GET['op'];
  $id = $_GET['id'];

  if ($op === 'delete') {
    $query = "DELETE FROM books WHERE id = $id";
  }


  if (isset($query)) {
    if (mysqli_query($connection, $query)) {
      $message = "Record deleted sucessfully.";
      echo "<script>
            alert('$message');
            window.location.href = './../admin/category_crud.php';
          </script>";
    } else {
      echo "Error deleting record: " . mysqli_error($connection);
    }
  }
}

setFlash('error', $errorMessage);
setFlash('success', $successMessage);

header("Location: ../admin/book_crud.php");

?>