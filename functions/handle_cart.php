<?php
require_once (__DIR__ . "/../functions/authentication.php");
require_once (__DIR__ . "/../functions/connection.php");
require_once (__DIR__ . "/../functions/functions.php");

$connection = getConnection();
$loggedInUserId = $_SESSION['id'];

if (!isset($loggedInUserId)) {
  $message = "You need to be logged in to add items to the cart.";
  echo "<script>
            alert('$message');
            window.location.href = 'login.php';
          </script>";
  exit();
}

// Add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $book_id = $_POST['book_id'];
  $book_name = $_POST['book_name'];
  $type = $_POST['type'];
  $amount = $_POST['amount'];

  setFlash('book_name', $book_name);

  $query = "INSERT INTO shopping_cart (user_id, book_id, type, qty) VALUES ('$loggedInUserId', '$book_id', '$type', '$amount')";

  if (mysqli_query($connection, $query)) {
    $message = "$book_name has been added to your cart!";
  } else {
    $message = "Failed to add $book_name to cart. Please try again.";
  }

  echo "<script>
            alert('$message');
            window.location.href = '../cart.php'; 
          </script>";
  exit();
}

// Delete from cart
if (isset($_GET["op"])) {
  $op = $_GET["op"];
} else {
  $op = "";
}

if ($op == "delete") {
  $book_id = $_GET["book_id"];
  $query = "DELETE FROM shopping_cart WHERE book_id = '$book_id' AND user_id = '$loggedInUserId'";

  $book_name = getFlash('book_name');

  if (mysqli_query($connection, $query)) {
    $message = "$book_name has been deleted from your cart!";
  } else {
    $message = "Failed to delete $book_name from cart. Please try again.";
  }
  echo "<script>
            alert('$message');
            window.location.href = '../cart.php'; 
          </script>";
  exit();
}
?>