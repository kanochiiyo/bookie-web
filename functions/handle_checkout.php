<?php
session_start();

require_once (__DIR__ . "/connection.php");
require_once (__DIR__ . "/functions.php");
$connection = getConnection();

$user_id = $_SESSION["id"];
$errorMessage = NULL;
$successMessage = NULL;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $book_ids = $_POST["book_id"];
  $quantities = $_POST["qty"];
  $types = $_POST["type"];
  $cart_ids = $_POST["id"];
  $date = new DateTime();
  $formatted_date = $date->format('Y-m-d H:i:s');

  $insert_transaction = $connection->query("INSERT INTO transaction (user_id, transaction_date) VALUES ($user_id, '$formatted_date')");

  if ($insert_transaction) {
    $transaction_id = $connection->insert_id;

    foreach ($book_ids as $index => $book_id) {
      $qty = $quantities[$index];
      $type = $types[$index];
      $cart_id = $cart_ids[$index];
      $insert_detail = $connection->query("INSERT INTO transaction_detail (transaction_id, book_id, qty, type) VALUES ($transaction_id, $book_id, $qty, '$type')");
      if (!$insert_detail) {
        throw new Exception($connection->error);
      } else {
        $successMessage = "Pembelian berhasil!";
      }

      $delete_cart = $connection->query("DELETE FROM shopping_cart WHERE id=$cart_id");
    }

  } else {
    $errorMessage = $errorMessage . $connection->error;
  }


  setFlash('error', $errorMessage);
  setFlash('success', $successMessage);

  header("Location: ./../transaction.php");
}
?>