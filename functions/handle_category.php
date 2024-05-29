<?php
require_once 'authentication.php';
$connection = getConnection();

// Insert
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['authorName'])) {
    $authorName = mysqli_real_escape_string($connection, $_POST['authorName']);
    $query = "INSERT INTO author VALUES '$authorName'";
  } elseif (isset($_POST['publisherName'])) {
    $publisherName = mysqli_real_escape_string($connection, $_POST['publisherName']);
    $query = "INSERT INTO publisher VALUES '$publisherName'";
  } elseif (isset($_POST['genreName'])) {
    $genreName = $_POST['genreName'];
    $query = "INSERT INTO genre VALUES '$genreName'";
  }

  if (isset($query)) {
    if (mysqli_query($connection, $query)) {
      $message = "Record added sucessfully.";
      echo "<script>
            alert('$message');
            window.location.href = './../admin/category_crud.php';
          </script>";
    } else {
      echo "Error inserting record: " . mysqli_error($connection);
    }
  }
}

// Delete
if (isset($_GET['op']) && isset($_GET['type']) && isset($_GET['id'])) {
  $op = $_GET['op'];
  $type = $_GET['type'];
  $id = $_GET['id'];

  if ($op === 'delete') {
  }
  switch ($type) {
    case 'publisher':
      $query = "DELETE FROM publisher WHERE id = $id";
      break;
    case 'author':
      $query = "DELETE FROM author WHERE id = $id";
      break;
    case 'genre':
      $query = "DELETE FROM genre WHERE id = $id";
      break;
    default:
      echo "Invalid type.";
      exit;
  }

  if (isset($query)) {
    if (mysqli_query($connection, $query)) {
      $message = "Record added sucessfully.";
      echo "<script>
            alert('$message');
            window.location.href = './../admin/category_crud.php';
          </script>";
    } else {
      echo "Error inserting record: " . mysqli_error($connection);
    }
  }
}

?>