<?php
include (__DIR__ . "/../templates/header.php");
?>
<style>
  .font-notosans {
    font-family: "Noto Sans", sans-serif;
  }

  a {
    text-decoration: none;
    color: #333;
    /* Warna teks yang lebih gelap untuk kontras yang lebih baik */
  }

  #book-crud .sidebar {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    z-index: 2;
    /* Tingkatkan z-index agar sidebar di atas navbar */
  }

  #book-crud .sidebar-item {
    display: block;
    padding: 10px;
    margin: 5px;
    transition: background-color 0.3s;
    /* Tambahkan transisi untuk hover */
  }

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

  /* Responsivitas untuk perangkat mobile */
  @media (max-width: 768px) {
    .sidebar {
      min-width: 80px;
      /* Atur lebar minimum sidebar */
    }

    .navbar .container-fluid {
      padding-left: 85px;
      /* Beri ruang untuk sidebar */
    }

    .table-responsive {
      overflow-x: auto;
      /* Tambahkan scroll horizontal untuk tabel */
    }
  }

  /* Aksesibilitas untuk ikon */
  a.text-black {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
  }

  a.text-black:hover {
    background-color: #f0f0f0;
    /* Tambahkan feedback visual saat hover */
    border-radius: 18px;
    /* Bentuk lingkaran */
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
          <h1 class="text-start fw-3">Books Data</h1>
        </div>
        <div class="row">
          <div class="card p-4 container-card mb-5 border-0">
            <button class="p-2 my-2 text-white border-0"
              style="text-decoration: none; background-color:#463610; border-radius: 20px; width:110px"><i
                class="fa-solid fa-plus"></i>Add Data</button>
            <table class="table align-items-center">
              <thead>
                <tr>
                  <th class="Child">Books ID</th>
                  <th>Cover</th>
                  <th>Title</th>
                  <th>Genre</th>
                  <th>Synopsis</th>
                  <th>Author</th>
                  <th>Publisher</th>
                  <th>Publication Date</th>
                  <th>Pages</th>
                  <th>Language</th>
                  <th>Weight</th>
                  <th>Price</th>
                  <th class="Child">Action</th>
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
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>Data </td>
                    <td>
                      <a class="p-2 text-black" href=""><i class="fa-solid fa-pen"></i></a>
                      <a class="p-2 text-black" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
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