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
  if (empty($_SESSION['priv']) || $_SESSION['priv'] != "kadiv") {
    header("Location: sign-in.php?r=guest");
  }

  include 'koneksi.php';
  $id = $_SESSION['id'];

  //divisi
  $result = $koneksi->query("SELECT id_divisi FROM pegawai WHERE id_pegawai = '$id'");
  $arr = mysqli_fetch_array($result);
  $idv = $arr['id_divisi'];
  date_default_timezone_set("Asia/Jakarta");
  $tgl = date('d-m-Y');
  $time = date('Y-m-d');
  $kode = date('Ymd').$idv;

  //cek jurnal tersedia

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Tulis Jurnal
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
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 text-center">
                <h3 class="text-white text-capitalize ps-3">Jurnal</h3>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="responsive p-0 p-4">
                
                <?php  
                  $result2 = $koneksi->query("SELECT * FROM jurnal WHERE id_jurnal = '$kode'");
                  if (mysqli_num_rows($result2) == 0) {
                    echo '
                      <div class="alert alert-danger alert-dismissible text-white" role="alert">
                          <span class="text-sm">Anda belum mengisi jurnal!</span>
                          <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form class="form" method="post" action="action/post-jurnal.php">
                        <!-- id jurnal -->
                        <input type="text" name="kode" hidden value="'. $kode .'">
                        <!-- id divisi -->
                        <input type="text" name="id_divisi" hidden value="'. $arr['id_divisi'].'">
                        <!-- tanggal -->
                        <input type="date" name="tanggal" hidden value="'. $time .'">
                        <!-- isi jurnal -->
                        <div class="form-group">
                          <h4>Jurnal Kegiatan Hari Ini ('.$tgl.')</h4>
                          <textarea class="form-control border border-primary p-2" name="jurnal" rows="4" required></textarea>
                        </div> 
                        <input type="submit" name="submit" class="btn btn-info mt-4">
                      </form>
                    ';
                  }else{
                    while($data = mysqli_fetch_array($result2)){
                        $id_jurnal = $data['id_jurnal']; 
                        $id_divisi = $data['id_divisi']; 
                        $tanggal = $data['tanggal'];
                        $isi_jurnal = $data['isi_jurnal'];
                    }
                    echo '
                      <div class="alert alert-success alert-dismissible text-white" role="alert">
                          <span class="text-sm">Anda sudah mengisi jurnal! Edit dibawah jika ada perubahan!</span>
                          <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form class="form" method="post" action="action/update-jurnal.php">
                        <!-- id jurnal -->
                        <input type="text" name="kode" hidden value="'. $id_jurnal .'">
                        <!-- id divisi -->
                        <input type="text" name="id_divisi" hidden value="'. $id_divisi.'">
                        <!-- tanggal -->
                        <input type="date" name="tanggal" hidden value="'. $tanggal .'">
                        <!-- isi jurnal -->
                        <div class="form-group">
                          <h4>Jurnal Kegiatan Hari Ini ('.$tgl.')</h4>
                          <textarea class="form-control border border-success p-2" name="jurnal" rows="4" required>'.$isi_jurnal.'</textarea>
                        </div> 
                        <input type="submit" name="submit" value="Submit Edit" class="btn btn-info mt-4">
                      </form>
                    ';
                  }
                ?>
                <hr>
                <h4>Riwayat Jurnal Bulan Ini</h4>
                <div class="table-responsive">
                  <table class="table w-100" id="riwayat">
                      <tr class="bg-light">
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Isi Jurnal</th>
                      </tr>
                      <?php
                        $result3 = $koneksi->query("SELECT * FROM jurnal WHERE id_divisi = '$idv' AND MONTH(tanggal) = MONTH(NOW())");
                        $i = 1;  
                        while ($data = mysqli_fetch_array($result3)) {
                         echo '
                          <tr>
                            <td>'.$i.'</td>
                            <td>'.$data['tanggal'].'</td>
                            <td style="white-space:pre;word-wrap: break-word;">'.$data['isi_jurnal'].'</td>
                          </tr>
                         ';
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