<?php
session_start();

require_once (__DIR__ . "/../functions/authentication.php");
require_once (__DIR__ . "/../functions/connection.php");
require_once (__DIR__ . "/../functions/functions.php");

$connection = getConnection();
$loggedInUserId = $_SESSION['id'];

if (!isLogged()) {
  $message = "You need to be logged in to add items to the cart.";
  echo "<script>
            alert('$message');
            window.location.href = '../login.php';
          </script>";
  exit();
}

// Add to cart
if (isAdmin()) {
  $message = "Sorry, you're an admin.";
  echo "<script>
            alert('" . addslashes($message) . "');
            window.location.href = '../index.php';
          </script>";
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $book_id = $_POST['book_id'];
  $book_name = $_POST['book_name'];
  $type = $_POST['type'];
  $amount = $_POST['amount'];

  setFlash('book_name', $book_name);

  $checkCart = $connection->query("SELECT book_id, type, qty FROM shopping_cart WHERE user_id=$loggedInUserId AND book_id=$book_id AND type='$type'");
  $result = $checkCart->fetch_object();
  if ($result) {
    if ($type == 'e-book') {
      $message = "$book_name is already in your cart!";
    } else {
      $amountAdded = $result->qty + $amount;

      $update = $connection->query("UPDATE shopping_cart SET qty=$amountAdded WHERE user_id=$loggedInUserId AND book_id=$book_id AND type='$type'");
      if ($update) {
        $message = "$book_name has been added to your cart!";
      } else {
        $message = "Failed to add $book_name to cart. Please try again.";
      }
    }



  } else {
    $query = "INSERT INTO shopping_cart (user_id, book_id, type, qty) VALUES ($loggedInUserId, $book_id, '$type', $amount)";
    // var_dump($query);

    if (mysqli_query($connection, $query)) {
      $message = "$book_name has been added to your cart!";
    } else {
      $message = "Failed to add $book_name to cart. Please try again.";
    }
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
  $cart_id = $_GET["id"];
  $query = "DELETE FROM shopping_cart WHERE id = $cart_id";

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