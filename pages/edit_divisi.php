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
$aidi = $_GET['id'];
include_once("koneksi.php");
  if(isset($_POST['update'])){
    $ids = $_POST['kodediv'];
    $name = $_POST['namadiv'];
    $result = mysqli_query($koneksi, "UPDATE divisi SET id_divisi='$ids', nama_divisi='$name' WHERE id_divisi='$aidi'");
     header("Location: divisi.php");
    }
?>

<?php

$id = $_GET['id'];

$result=mysqli_query($koneksi, "SELECT * FROM divisi WHERE id_divisi='$id'");

while($user_data = mysqli_fetch_array($result)){
    $kode = $user_data['id_divisi'];
    $nama = $user_data['nama_divisi'];
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
    Edit Divisi
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
                <h5 class="text-white text-capitalize ps-3">Edit Divisi</h5>
              </div>
            </div>
            <div class="card-body">
                <div class="col-12">
                  <ul class="list-group">
                     <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                       <div class="d-flex flex-column">
                         <h6 class="mb-3 text-sm"><?php echo $nama;?></h6>
                         <span class="mb-2 text-xs">
                         <?php echo $kode;?>
                         </span>
                       </div>
                     </li>
                  </ul>
                </div>
                  <form role="form" method="post">
                    <div class="form-group">
                      <h6>Kode Divisi</h6>
                      <input required type="text" name="kodediv" value=<?php echo $kode;?> class="form-control border border-primary p-2">
                    </div>
                    <div class="form-group">
                      <h6>Nama Divisi</h6>
                      <input required type="text" name="namadiv" value=<?php echo $nama;?> class="form-control border border-primary p-2">
                    </div>
                    <div class="row mb-4">
                      <div class = "col-6"> 
                        <div class="text-center">
                          <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                          <input type="submit" name="update" value="Simpan" class="btn btn-lg bg-gradient-success btn-lg w-30 mt-4 mb-0"></button>
                        </div>
                      </div>
                      <div class = "col-5">
                        <div class="text-center">
                         <a href="divisi.php"><button type="button" class="btn btn-lg bg-gradient-danger btn-lg w-30 mt-4 mb-0">Batal</button></a>
                        </div>
                      </div>
                    </div>
                    
                  </form>
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