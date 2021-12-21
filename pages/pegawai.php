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
	include_once("koneksi.php");
	if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $tampilpegawai = mysqli_query($koneksi, "SELECT pegawai.id_pegawai id_pegawai, pegawai.username username, pegawai.password password, pegawai.jabatan jabatan,
   pegawai.nama nama, pegawai.alamat alamat, pegawai.telp telp, pegawai.gaji_pokok gaji_pokok, divisi.nama_divisi FROM pegawai INNER JOIN divisi ON pegawai.id_divisi=divisi.id_divisi
   WHERE pegawai.nama LIKE '%".$cari."%' ");
  } else{
    $tampilpegawai = mysqli_query($koneksi, "SELECT pegawai.id_pegawai id_pegawai, pegawai.username username, pegawai.password password, pegawai.jabatan jabatan,
   pegawai.nama nama, pegawai.alamat alamat, pegawai.telp telp, pegawai.gaji_pokok gaji_pokok, divisi.nama_divisi FROM pegawai INNER JOIN divisi ON pegawai.id_divisi=divisi.id_divisi
    ORDER BY pegawai.nama ASC");
  }

  $hitung1 = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE jabatan = 'karyawan'");
  $hitung2 = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE jabatan = 'ketua'");
  $hitung3 = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE jabatan = 'admin'");

 $hkaryawan = mysqli_num_rows( $hitung1 );
 $hketua = mysqli_num_rows( $hitung2 );
 $hadmin = mysqli_num_rows( $hitung3 );

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Data Pegawai
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
      <div class="row mt-3">
        <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">people</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Karyawan</p>
                <h4 class="mb-0"><?= $hkaryawan;?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">engineering</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Ketua Divisi</p>
                <h4 class="mb-0"><?= $hketua;?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">psychology</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Admin</p>
                <h4 class="mb-0"><?= $hadmin;?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Data Karyawan</h6>
              </div>
              <hr>
              <div class="row">
                <div class="col-5">
                  <form action="pegawai.php" method="get">
                  <div class="input-group input-group-outline">
                    <label class="form-label">Cari Karyawan</label>
                     <input type="text" name="cari" class="form-control">
                     <button class="btn bg-gradient-dark mb-0" type="submit"><i class="material-icons text-sm">search</i></button>
                  </div>
                  </form>
                </div>
                <div class="col-2 text-end">
                  <a class="btn bg-gradient-success mb-0" href="tambah_pegawai.php"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Karyawan</a>
                </div>
              </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jabatan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Divisi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telepon</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    while($user_data = mysqli_fetch_array($tampilpegawai)){ ?>
                     <tr>
                      <td>
                        <div class='d-flex px-2 py-1'>
                          <div class='d-flex flex-column justify-content-center'>
                            <h6 class='mb-0 text-sm'> <?= $user_data['nama'];?> </h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class='text-xs font-weight-bold mb-0'> <?= $user_data['jabatan'];?> </p>
                      </td>
                      <td class='align-middle text-center text-sm'>
                        <p class='text-xs font-weight-bold mb-0'> <?= $user_data['nama_divisi'];?> </p>
                      </td>
                      <td class='align-middle text-center text-sm'>
                        <p class='text-xs font-weight-bold mb-0'> <?= $user_data['telp'];?> </p>
                      </td>
                      <td class='align-middle text-center'>
                        <span class='text-secondary text-xs font-weight-bold'> <?= $user_data['alamat'];?> </span>
                      </td>
                      <td class='align-middle'>
                        <a href='edit_pegawai.php?id=<?= $user_data['id_pegawai'];?>' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user'>
                          <span class='badge badge-sm bg-gradient-success'>Edit</span>
                        </a>
                        <a href='hapus_pegawai.php?id=<?= $user_data['id_pegawai'];?>' onclick="return confirm('Anda yakin mau menghapus item ini ?')" class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Hapus user'>
                          <span class='badge badge-sm bg-gradient-danger'>Hapus</span>
                        </a>
                      </td>
                     </tr>
                 <?php
                    }
                  ?>
                  </tbody>
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