<?php
include (__DIR__ . "/../templates/header.php");
?>
<style>
  .font-notosans {
    font-family: "Noto Sans", sans-serif;
  }

  a {
    text-decoration: none;
  }

  #book-crud .sidebar {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    z-index: 1;
  }

  #book-crud .sidebar-item {
    display: block;
    padding: 10px;
    margin: 5px;
  }

  /* Sebenernya ini untuk kalau page nya aktif */
  #book-crud .sidebar-item:hover {
    background-color: rgba(255, 255, 255, 0.25);
    border-radius: 20px;
  }

  .no-padding-margin {
    padding: 0;
    margin: 0;
  }

  .container-img {
    border-top-left-radius: 40px;
    border-bottom-left-radius: 40px;
  }

  .table thead th {
    background-color: #F4F4F5;
    font-weight: 500;
    color: #5A6278;
    font-size: 14px;
  }

  .table thead th:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
  }

  .table thead th:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
  }
</style>
<main id="book-crud" class="font-notosans no-padding-margin"
  style="background-color: #e2ac6b; background-image: linear-gradient(315deg, #e2ac6b 0%, #cba36d 74%)">
  <div class="container-fluid no-padding-margin">
    <div class="row no-padding-margin">

      <?php include (__DIR__ . "/../templates/sidebar.php"); ?>

      <!-- Container -->
      <div class="col-10 d-flex flex-column justify-content-start align-items-center no-padding-margin bg-white" style="border-top-left-radius: 40px;
    border-bottom-left-radius: 40px">
        <div class="row p-4">
          <h1 class="text-start fw-3">Transaction Data</h1>
        </div>
        <div class="row">
          <div class="card p-4 container-card mb-5 border-0" style="width: 1000px">
            <button class="p-2 my-2 text-white border-0"
              style="text-decoration: none; background-color:#463610; border-radius: 20px; width:110px"><a
                href="add_book.php" class="text-white"><i class="fa-solid fa-plus"></i> Add Data</a></button>
            <table class="table align-items-center">
              <thead>
                <tr>
                  <th class="Child">Transaction ID</th>
                  <th>Buyer Name</th>
                  <th>Book Name</th>
                  <th>Quantity</th>
                  <th>Type</th>
                  <th>Date</th>
                  <th class="Child">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 0; $i < 10; $i++) { ?>
                  <tr>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
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