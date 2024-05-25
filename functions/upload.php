<?php

session_start();

// Koneksi ke database
require_once (__DIR__ . "/connection.php");
$connection = getConnection();

$errorMessage = NULL;
$successMessage = NULL;

// Periksa apakah form sudah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Mengambil data dari form
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

  // Direktori penyimpanan
  $target_dir = "../assets/books/";

  // File yang di-upload
  $temp_file = $_FILES["bookCover"]["tmp_name"];
  $uploadOK = 1;
  $imageFileType = strtolower(pathinfo($_FILES["bookCover"]["name"], PATHINFO_EXTENSION));

  // Periksa apakah file benar-benar gambar
  $check = getimagesize($temp_file);
  if ($check !== false) {
    $uploadOK = 1;
  } else {
    $errorMessage = $errorMessage . "File bukan gambar";
    $uploadOK = 0;
  }

  // Batasi ukuran file (misalnya 5MB)
  if ($_FILES["bookCover"]["size"] > 3000000) {
    $errorMessage = $errorMessage . "File telalu besar, maksimal 3MB min. ";
    $uploadOK = 0;
  }

  // Batasi format file yang diizinkan
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    $errorMessage = $errorMessage . "Hanya menerima JPG, JPEG, PNG, & GIF. ";
    $uploadOK = 0;
  }

  // Periksa apakah $uploadOK bernilai 0 karena error
  if ($uploadOK == 0) {
    $errorMessage = "Maaf, tidak dapat mengupload data." . $errorMessage;
  } else {
    // Simpan data buku terlebih dahulu tanpa nama file
    $insert = $connection->query("INSERT INTO books (title, synopsis, price, language, weight, publication_date, publisher_id, author_id, genre_id, totalpage) VALUES ('$bookTitle', '$bookSynopsis', $price, '$lang', $weight, '$publication', $publisher, $author, $bookGenre, $pages)");

    if ($insert) {
      // Dapatkan ID buku yang baru saja dimasukkan
      $book_id = $connection->insert_id;
      $new_file_name = $book_id . "." . $imageFileType;
      $target_file = $target_dir . $new_file_name;

      // Pindahkan file ke direktori target dengan nama baru
      if (move_uploaded_file($temp_file, $target_file)) {
        $successMessage = $successMessage . "File " . htmlspecialchars(basename($_FILES["bookCover"]["name"])) . " berhasil di Upload. ";

        // Update database dengan nama file yang baru
        $update = $connection->query("UPDATE books SET img='$new_file_name' WHERE id='$book_id'");

        if ($update) {
          $successMessage = $successMessage . "Berhasil disimpan ke database.";
        } else {
          $errorMessage = $errorMessage . $connection->error;
        }
      } else {
        $errorMessage = "Sorry, there was an error uploading your file. " . $errorMessage;
      }
    } else {
      $errorMessage = $errorMessage . $connection->error;
    }
  }
}

$_SESSION["error"] = $errorMessage;
$_SESSION["success"] = $successMessage;

header("Location: ../admin/book_crud.php");

?>