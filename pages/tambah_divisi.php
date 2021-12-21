<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php 
  session_start();
  if (empty($_SESSION['priv']) || $_SESSION['priv'] != "admin") {
    header("Location: sign-in.php?"); 
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Tambah Divisi
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'server-sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include 'navbar.php';  ?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 text-center">
                <h5 class="text-white text-capitalize ps-3">Tambah Divisi</h5>
              </div>
            </div>
            <div class="card-body">
                  <form role="form" method="post">
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">ID Divisi</label>
                      <input type="text" name="kodediv" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nama Divisi</label>
                      <input type="text" name="namadiv" class="form-control">
                    </div>
                    <div class="row mb-4">
                      <div class = "col-6"> 
                        <div class="text-center">
                          <input type="submit" name="tambah" Value="Tambah" class="btn btn-lg bg-gradient-success btn-lg w-30 mt-4 mb-0">
                        </div>
                      </div>
                      <div class = "col-5">
                        <div class="text-center">
                         <a href="divisi.php"><button type="button" class="btn btn-lg bg-gradient-danger btn-lg w-30 mt-4 mb-0">Batal</button></a>
                        </div>
                      </div>
                    </div>
                  </form>
                  <?php
                    if(isset($_POST['tambah'])){
                    $nama = $_POST['namadiv'];
                    $kode = $_POST['kodediv'];

                    include_once("koneksi.php");

                    $result = mysqli_query($koneksi,"INSERT INTO divisi(id_divisi,nama_divisi) VALUES ('$kode','$nama')");

                    echo "Divisi berhasil ditambahkan! <a href='divisi.php'>Lihat Divisi</a>";
                    }
                    ?>
                </div>
          </div>
        </div>
      </div>
    </div>


  </main>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>