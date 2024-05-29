<?php
session_start();
require_once 'authentication.php';
$connection = getConnection();

if (!isLogged()) {
  header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id']) && isset($_POST['reviewRating']) && isset($_POST['reviewContent'])) {
  $bookId = $_POST['book_id'];
  $rating = $_POST['reviewRating'];
  $review = mysqli_real_escape_string($connection, $_POST['reviewContent']);
  $reviewId = isset($_POST['review_id']) ? $_POST['review_id'] : 0;
  $trxDetailId = $_POST['trxDetail_id'];

  if ($reviewId > 0) {
    // Update review
    $query = "UPDATE review SET content = '$review', rate = $rating WHERE id = $reviewId";
  } else {
    // Insert new review
    $query = "INSERT INTO review (content, rate) VALUES ('$review', $rating)";
    if (mysqli_query($connection, $query)) {
      $reviewId = mysqli_insert_id($connection);
      $query = "UPDATE transaction_detail SET review_id = $reviewId WHERE id = $trxDetailId";
    }
  }

  if (mysqli_query($connection, $query)) {
    header("Location: ./../transaction.php");
  } else {
    echo "Error: " . mysqli_error($connection);
  }
}
?>