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
  if (empty($_SESSION['priv']) || $_SESSION['priv'] != "pegawai") {
      if ($_SESSION['priv'] != "kadiv") {
        header("Location: sign-in.php?r=guest"); 
      }
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
  <?php include 'pegawai-sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include 'navbar.php';  ?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 text-center">
                <h3 class="text-white text-capitalize ps-3">Pengajuan Cuti</h3>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="responsive p-0 p-4">
                <?php  
                  $result = $koneksi->query("SELECT * FROM cuti WHERE id_pegawai = '$id' AND status = 'belum disetujui'");
                  $result2 = $koneksi->query("SELECT * FROM cuti WHERE id_pegawai = '$id' AND YEAR(timestamp) = YEAR(NOW()) AND status = 'disetujui'");
                  $cuti = mysqli_num_rows($result2);
                  if (mysqli_num_rows($result) == 0 && $cuti<$jatah_cuti) {
                    echo '
                      <div class="alert alert-success alert-dismissible text-white" role="alert">
                          <span class="text-sm">Jatah cuti anda : '.($jatah_cuti - $cuti).'</span>
                          <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form class="form" method="post" action="action/post-cuti.php">
                        <!-- timestamp -->
                        <input type="text" name="time" hidden value="'.$time.'">
                        <!-- id pegawai -->
                        <input type="text" name="id_pegawai" hidden value="'.$id.'">
                        <!-- tanggal -->
                        <input type="text" name="status" hidden value="belum disetujui">
                        <div class="form-group mb-3">
                          <h5>Tanggal Mulai</h5>
                          <input type="date" name="cutistr" required>
                        </div>
                        <div class="form-group mb-3">
                          <h5>Tanggal Selesai</h5>
                          <input type="date" name="cutistp" required>
                        </div>
                        <div class="form-group">
                          <h5>Alasan</h5>
                          <textarea class="form-control border border-primary p-2" name="alasan" rows="4" required></textarea>
                        </div> 
                        <input type="submit" name="submit" class="btn btn-info mt-4">
                      </form>
                    ';
                  }elseif ($cuti >= $jatah_cuti) {
                    echo '
                      <div class="alert alert-danger alert-dismissible text-white" role="alert">
                          <span class="text-sm">Jatah cuti anda tahun ini sudah habis. Anda tidak dapat mengajukan cuti kembali!</span>
                          <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    ';
                  }else{
                    echo '
                      <div class="alert alert-danger alert-dismissible text-white" role="alert">
                          <span class="text-sm">Anda tidak dapat mengajukan cuti kembali saat sedang menunggu persetujuan!</span>
                          <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    ';
                  }
                ?>
                <hr>
                <div class="row mb-4">
                  <div class="col-sm-8">
                    <h4>Riwayat Cuti</h4>
                  </div>
                  <div class="col-sm-4">
                    <table>
                      <tr>
                        <td><span class="material-icons text-secondary">circle</span></td>
                        <td>Menunggu Persetujuan</td>
                      </tr>
                      <tr>
                        <td><span class="material-icons text-success">circle</span></td>
                        <td>Disetujui</td>
                      </tr>
                      <tr>
                        <td><span class="material-icons text-danger">circle</span></td>
                        <td>Ditolak</td>
                      </tr>
                    </table>
                  </div>
                </div>
                
                <div class="table-responsive">
                  <table class="table w-100" id="riwayat">
                      <tr class="bg-light">
                        <th>No.</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Status</th>
                      </tr>
                      <?php
                        $result3 = $koneksi->query("SELECT * FROM cuti WHERE id_pegawai = '$id' ORDER BY timestamp DESC");
                        $i = 1;  
                        while ($data = mysqli_fetch_array($result3)) {
                          
                         echo '
                          <tr>
                            <td>'.$i.'</td>
                            <td>'.$data['tanggal_mulai'].'</td>
                            <td>'.$data['tanggal_selesai'].'</td>
                            <td style="white-space:pre;word-wrap: break-word;" >'.$data['alasan'].'</td>
                            <td><center>';
                            switch ($data['status']) {
                              case 'belum disetujui':
                                echo '
                                  <span class="material-icons text-secondary">circle</span>
                                ';
                                break;
                              case 'disetujui':
                                echo '
                                  <span class="material-icons text-success">circle</span>
                                ';
                                break;
                              case 'ditolak':
                                echo '
                                  <span class="material-icons text-danger">circle</span>
                                ';
                                break;
                              default:
                                # code...
                                break;
                            }
                          echo '</center></td></tr>';
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