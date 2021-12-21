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
	include_once("koneksi.php");
	$tampildivisi = mysqli_query($koneksi, "SELECT * FROM divisi ORDER BY id_divisi DESC");
  $hitung1 = mysqli_query($koneksi, "SELECT pegawai.id_pegawai id_pegawai, pegawai.username username, pegawai.password password, pegawai.jabatan jabatan,
  pegawai.nama nama, pegawai.tgl_lahir tgl_lahir, pegawai.gaji_pokok gaji_pokok, divisi.nama_divisi FROM pegawai INNER JOIN divisi ON pegawai.id_divisi=divisi.id_divisi
  WHERE pegawai.jabatan = 'karyawan'");
  $hitung2 = mysqli_query($koneksi, "SELECT pegawai.id_pegawai id_pegawai, pegawai.username username, pegawai.password password, pegawai.jabatan jabatan,
  pegawai.nama nama, pegawai.tgl_lahir tgl_lahir, pegawai.gaji_pokok gaji_pokok, divisi.nama_divisi FROM pegawai INNER JOIN divisi ON pegawai.id_divisi=divisi.id_divisi
  WHERE pegawai.jabatan = 'ketua'");
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
    Tambah Pegawai
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
                <p class="text-sm mb-0 text-capitalize">Ketua</p>
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
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 text-center">
                <h5 class="text-white text-capitalize ps-3">Tambah Karyawan</h5>
              </div>
            </div>
            <div class="card-body">
                  <form role="form" method="post" action="tambah_pegawai.php">
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">ID Pegawai</label>
                      <input required type="text" name="kodekar" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nama</label>
                      <input required type="text" name="namakar" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input required type="text" name="email" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Telepon</label>
                      <input required type="text" name="telp" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Tanggal Lahir : </label>
                        <input required type="date" name="ttlkar">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Alamat</label>
                      <input required type="text" name="alamat" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Jabatan : </label>
                        <select required name="jabatan" id="jabatan">
                            <option value="" class="form-control" selected disabled hidden>--Pilih Jabatan--</option>
                            <option value="Ketua" class="form-control">Ketua</option>
                            <option value="Karyawan" class="form-control">Karyawan</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Divisi : </label>
                        <select required name="divisi" id="divisi">
                           <option value="" class="form-control"  selected disabled hidden>--Divisi--</option>
                        <?php
                          while($divisi = mysqli_fetch_array($tampildivisi)){
                          echo "<option value='".$divisi['id_divisi']."' class='form-control'>".$divisi['nama_divisi']."</option>";
                          }
                        ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Tanggal Masuk : </label>
                        <input required type="date" name="tglmsk">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Username</label>
                      <input required type="text" name="username" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input required type="text" name="password" class="form-control">
                    </div>
                    <div class="row mb-4">
                      <div class = "col-6"> 
                        <div class="text-center">
                          <input type="submit" name="tambah" class="btn btn-lg bg-gradient-success btn-lg w-30 mt-4 mb-0"></button>
                        </div>
                      </div>
                      <div class = "col-5">
                        <div class="text-center">
                         <a href="pegawai.php"><button type="button" class="btn btn-lg bg-gradient-danger btn-lg w-30 mt-4 mb-0">Batal</button></a>
                        </div>
                      </div>
                    </div>
                  </form>
                  <?php
                    if(isset($_POST['tambah'])){
                    $id = $_POST['kodekar'];
                    $nama = $_POST['namakar'];
                    $tanggal = $_POST['ttlkar'];
                    $jabatan = $_POST['jabatan'];
                    $divisi = $_POST['divisi'];
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $telepon = $_POST['telp'];
                    $email = $_POST['email'];
                    $terima = $_POST['tglmsk'];
                    $alamat = $_POST['alamat'];
                    if($_POST['jabatan']=="Ketua"){
                      $priv = 2;
                    } else if($_POST['jabatan']=="Karyawan"){
                      $priv = 3;
                    } else{
                      $priv = 0;
                    }
                    include_once("koneksi.php");

                    $result = mysqli_query($koneksi,"INSERT INTO pegawai (id_pegawai,username,password,nama,email,telp,tgl_lahir,alamat,tgl_masuk,gaji_pokok,jabatan,id_divisi,
                    sisa_cuti,priv) VALUES ('$id','$username','$password','$nama','$email','$telepon','$tanggal','$alamat','$terima','0','$jabatan','$divisi','10','$priv')");

                    echo "Karyawan berhasil ditambahkan! <a href='pegawai.php'>Lihat Karyawan</a>";
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