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
  if ($_SESSION['priv'] != "admin") {
    header("Location: sign-in.php?"); 
  }

  include 'koneksi.php';

  $jatah_cuti = 10;
  $id = $_SESSION['id'];
  date_default_timezone_set("Asia/Jakarta");
  $time = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Pengajuan Cuti
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
                <h3 class="text-white text-capitalize ps-3">Permohonan Cuti</h3>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-4"> 
                <table class="table table-bordered" id="riwayat">
                  <tr class="bg-light">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan</th>
                    <th>Status</th>
                  </tr> 
                  <?php
                    $result3 = $koneksi->query("SELECT cuti.id_cuti id_cuti, pegawai.nama nama_pegawai, divisi.nama_divisi nama_divisi, cuti.tanggal_mulai tanggal_mulai, cuti.tanggal_selesai tanggal_selesai, cuti.alasan alasan  FROM cuti INNER JOIN pegawai ON cuti.id_pegawai=pegawai.id_pegawai INNER JOIN divisi ON pegawai.id_divisi=divisi.id_divisi WHERE status='belum disetujui' ORDER BY timestamp ASC; ");
                    $i = 1;  
                    while ($data = mysqli_fetch_array($result3)) {
                      
                     echo '
                      <tr>
                        <td>'.$i.'</td>
                        <td>'.$data['nama_pegawai'].'</td>
                        <td>'.$data['nama_divisi'].'</td>
                        <td>'.$data['tanggal_mulai'].'</td>
                        <td>'.$data['tanggal_selesai'].'</td>
                        <td style="white-space:pre;word-wrap: break-word;" >'.$data['alasan'].'</td>
                        <td>
                          <form method="post" action="action/confirm-cuti.php">
                            <input type="text" name="kode" hidden value="'.$data['id_cuti'].'">
                            <input type="text" name="nama" hidden value="'.$data['nama_pegawai'].'">
                            <input class="btn btn-success" type="submit" name="submit" value="Setujui">
                            <input class="btn btn-danger" type="submit" name="submit" value="Tolak">
                          </form>
                        </td>
                        </tr>';
                     $i++;
                    }
                  ?>
                </table>
              </div>
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