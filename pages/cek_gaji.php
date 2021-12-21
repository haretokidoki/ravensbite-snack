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
  include 'koneksi.php';
  session_start();
  if (empty($_SESSION['priv']) || $_SESSION['priv'] != "pegawai") {
      if ($_SESSION['priv'] != "kadiv") {
        header("Location: sign-in.php?r=guest"); 
      }
  }

  $id = $_SESSION['id'];
  $result = $koneksi->query("SELECT gaji_pokok, tgl_masuk FROM pegawai WHERE id_pegawai = '$id'");
  $gaji = mysqli_fetch_array($result);

  date_default_timezone_set("Asia/Jakarta");
  $today = date('Y-m-d');
  
  //hitung cuti
  $cuti = $koneksi->query("SELECT * FROM cuti WHERE id_pegawai = '$id' AND MONTH(tanggal_mulai) = MONTH(NOW()) AND status = 'disetujui'");
  $xcuti = 0;
  while ($data = mysqli_fetch_array($cuti)) {
    //cuti sudah berlaku
    $x = (strtotime($data['tanggal_selesai']) - strtotime($data['tanggal_mulai'])) / (60 * 60 * 24);
    //cuti belum berlaku
    $y = (strtotime($data['tanggal_selesai']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
    //cuti terhitung hari ini
    $xcuti += $x - $y;
  }

  $presensi = $koneksi->query("SELECT * FROM presensi WHERE id_pegawai = '$id' AND MONTH(waktu) = MONTH(NOW())");
  

  //Menghitung absen di bulan ini
  $bulan = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));

  if (date('m') == date('m', strtotime($gaji['tgl_masuk']))) {
    //Jika karyawan masuk di tengah bulan
    $awal = date('Y-m', strtotime($gaji['tgl_masuk']))."-01";
    $akhir = date("Y-m")."-".$bulan;
    //absen sudah terlewat
    $datediff = (strtotime($gaji['tgl_masuk']) - strtotime($awal)) / (60 * 60 * 24);
    //absen belum dibuka
    $datediff2 = (strtotime($akhir) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
    $denda = ($bulan - mysqli_num_rows($presensi) - $datediff - $datediff2 - $xcuti + 1) * 100000;
  }else{
    //Jika karyawan sudah mulai bekerja
    $akhir = date("Y-m")."-".$bulan;
    //absen belum dibuka
    $datediff2 = (strtotime($akhir) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
    $denda = ($bulan - mysqli_num_rows($presensi) - $datediff2 - $xcuti + 1) * 100000;
  }

  //Menghitung cuti di bulan ini

  
  $tunjangan = 550000;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Cek Gaji
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
  <?php include 'pegawai-sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include 'navbar.php';  ?>
    <div class="container-fluid py-4">
      <div class="col-xl-12 col-sm-12 mb-xl-4 mb-5">
        <div class="card">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 text-center">
              <h3 class="text-white text-capitalize ps-3">Cek Gaji</h3>
            </div>
          </div>
          <div class="card-header p-3 pt-2">
            <div class="text-center p-6">
              <p class="mb-0 text-capitalize">Gaji Bersih</p>
              <h2 class="mb-0">Rp. <?= (int)$gaji['gaji_pokok'] - $denda?></h2>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"></p>
          </div>
        </div>
      </div>
      <hr>
      <div class="row mt-5">
        <div class="col-xl-6 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">money_off</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Denda</p>
                <h4 class="mb-0">Rp. <?= $denda?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">payments</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Gaji Pokok</p>
                <h4 class="mb-0">Rp. <?= (int)$gaji['gaji_pokok']?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"></p>
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