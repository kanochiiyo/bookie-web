<?php
require_once 'authentication.php';
$connection = getConnection();
// require_once (__DIR__ . "/../functions/connection.php");
// $connection = getConnection();

function executeQuery($connection, $query, $successMessage, $errorMessage)
{
  if (mysqli_query($connection, $query)) {
    echo "<script>
            alert('$successMessage');
            window.location.href = './../admin/category_crud.php';
        </script>";
  } else {
    echo "Error: " . $errorMessage . " " . mysqli_error($connection);
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST["modal"])) {
    $modal = $_POST["modal"];
    // var_dump($modal);
    $id = isset($_POST["categoryId"]) ? (int) $_POST["categoryId"] : null;
    // var_dump($id);
    $successMessage = "";
    $errorMessage = "";

    if ($modal == "create") {
      if (isset($_POST['authorName'])) {
        $name = mysqli_real_escape_string($connection, $_POST['authorName']);
        $query = "INSERT INTO author(name) VALUES ('$name')";
        $successMessage = "Author added successfully.";
        $errorMessage = "Error inserting author.";
      } elseif (isset($_POST['publisherName'])) {
        $name = mysqli_real_escape_string($connection, $_POST['publisherName']);
        $query = "INSERT INTO publisher(name) VALUES ('$name')";
        $successMessage = "Publisher added successfully.";
        $errorMessage = "Error inserting publisher.";
      } elseif (isset($_POST['genreName'])) {
        $name = mysqli_real_escape_string($connection, $_POST['genreName']);
        $query = "INSERT INTO genre(name) VALUES ('$name')";
        $successMessage = "Genre added successfully.";
        $errorMessage = "Error inserting genre.";
      }
    } elseif ($modal == "edit" && $id !== null) {
      if (isset($_POST['authorName'])) {
        $name = mysqli_real_escape_string($connection, $_POST['authorName']);
        $query = "UPDATE author SET name='$name' WHERE id=$id";
        $successMessage = "Author edited successfully.";
        $errorMessage = "Error editing author.";
      } elseif (isset($_POST['publisherName'])) {
        $name = mysqli_real_escape_string($connection, $_POST['publisherName']);
        $query = "UPDATE publisher SET name='$name' WHERE id=$id";
        $successMessage = "Publisher edited successfully.";
        $errorMessage = "Error editing publisher.";
      } elseif (isset($_POST['genreName'])) {
        $name = mysqli_real_escape_string($connection, $_POST['genreName']);
        $query = "UPDATE genre SET name='$name' WHERE id=$id";
        $successMessage = "Genre edited successfully.";
        $errorMessage = "Error editing genre.";
      }
    }

    if (isset($query)) {
      executeQuery($connection, $query, $successMessage, $errorMessage);
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
      $message = "Record deleted sucessfully.";
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