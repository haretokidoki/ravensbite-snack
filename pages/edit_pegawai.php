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
$id = $_GET['id'];
include_once("koneksi.php");
  if(isset($_POST['update'])){
    $kode = $_POST['kodekar'];
    $user = $_POST['username'];
    $jbtn = $_POST['jabatan'];
    $name = $_POST['namakar'];
    $almt = $_POST['alamat'];
    $telp = $_POST['telp'];
    $eml = $_POST['email'];
    $msk = $_POST['tglmsk'];
    $tgll = $_POST['ttlkar'];
    $gj = $_POST['gaji'];
    $dvs = $_POST['divisi'];
    $result = mysqli_query($koneksi, "UPDATE pegawai SET id_pegawai='$kode', nama='$name', tgl_lahir='$tgll', jabatan='$jbtn',
    alamat='$almt', telp='$telp', email='$eml', tgl_masuk='$msk', username='$user', gaji_pokok='$gj', id_divisi='$dvs' WHERE id_pegawai='$id'");
     header("Location: pegawai.php");
    }
?>

<?php

$id = $_GET['id'];

$result=mysqli_query($koneksi, "SELECT pegawai.id_pegawai id_pegawai, pegawai.username username, pegawai.password password, pegawai.jabatan jabatan, pegawai.nama nama, pegawai.tgl_lahir tgl_lahir,
 pegawai.gaji_pokok gaji_pokok, pegawai.alamat alamat, pegawai.email email,pegawai.telp telp,
 pegawai.tgl_masuk tgl_masuk, divisi.nama_divisi FROM pegawai INNER JOIN divisi ON pegawai.id_divisi=divisi.id_divisi WHERE pegawai.id_pegawai='$id';");
$tampildivisi = mysqli_query($koneksi, "SELECT * FROM divisi ORDER BY id_divisi DESC");

while($user_data = mysqli_fetch_array($result)){
    $id = $user_data['id_pegawai'];
    $alamat = $user_data['alamat'];
    $telepon = $user_data['telp'];
    $email = $user_data['email'];
    $masuk = $user_data['tgl_masuk'];
    $username = $user_data['username'];
    $password = $user_data['password'];
    $jabatan = $user_data['jabatan'];
    $nama = $user_data['nama'];
    $tgl = $user_data['tgl_lahir'];
    $gaji = $user_data['gaji_pokok'];
    $divisi = $user_data['nama_divisi'];
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
    Edit Pegawai
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
                <h5 class="text-white text-capitalize ps-3">Edit Karyawan</h5>
              </div>
            </div>
            <div class="card-body">
                <div class="col-12">
                  <ul class="list-group">
                     <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                          <h6 class="mb-3 text-sm"><?= $nama?></h6>
                          <span class="mb-2 text-xs">Tanggal Lahir: <span class="text-dark font-weight-bold ms-sm-2"><?= $tgl?></span></span>
                          <span class="mb-2 text-xs">Alamat: <span class="text-dark font-weight-bold ms-sm-2"><?= $alamat?></span></span>
                          <span class="mb-2 text-xs">Jabatan: <span class="text-dark ms-sm-2 font-weight-bold"><?= $jabatan?></span></span>
                          <span class="mb-2 text-xs">Divisi: <span class="text-dark ms-sm-2 font-weight-bold"><?= $divisi?></span></span>
                          <span class="mb-2 text-xs">Kode Karyawan: <span class="text-dark ms-sm-2 font-weight-bold"><?= $id?></span></span>
                          <span class="mb-2 text-xs">Tanggal Diterima: <span class="text-dark font-weight-bold ms-sm-2"><?= $masuk?></span></span>
                          <br>
                          <span class="mb-2 text-xs">Username: <span class="text-dark ms-sm-2 font-weight-bold"><?= $username?></span></span>
                          <span class="mb-2 text-xs">Email: <span class="text-dark font-weight-bold ms-sm-2"><?= $email?></span></span>
                          <span class="mb-2 text-xs">Telepon: <span class="text-dark font-weight-bold ms-sm-2"><?= $telepon?></span></span>
                          <span class="mb-2 text-xs">Gaji Pokok: <span class="text-dark ms-sm-2 font-weight-bold"><?= $gaji?></span></span>
                          
                        </div>
                     </li>
                  </ul>
                </div>
                  <form role="form" method="post">
                    <div class="form-group">
                      <h6>Kode Karyawan</h6>
                      <input required type="text" name="kodekar" value="<?php echo $id;?>" class="form-control border border-primary p-2">
                    </div>
                    <div class="form-group">
                      <h6>Nama</h6>
                      <input required type="text" name="namakar" value="<?php echo $nama;?>" class="form-control border border-primary p-2">
                    </div>
                    <div class="form-group">
                      <h6>Email</h6>
                      <input required type="text" name="email" value="<?php echo $email;?>" class="form-control border border-primary p-2">
                    </div>
                    <div class="form-group">
                      <h6>Telepon</h6>
                      <input required type="text" name="telp" value="<?php echo $telepon;?>" class="form-control border border-primary p-2">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Tanggal Lahir : </label>
                        <input required type="date" value="<?php echo $tgl;?>" name="ttlkar">
                    </div>
                    <div class="form-group">
                      <h6>Alamat</h6>
                      <input required type="text" name="alamat" value="<?php echo $alamat;?>" class="form-control border border-primary p-2">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Jabatan : </label>
                        <select required name="jabatan" value="<?php echo $jabatan;?>" id="jabatan">
                            <option <?php if($jabatan == 'Ketua'){echo("selected");}?> value="Ketua">Ketua</option>
                            <option <?php if($jabatan == 'Karyawan'){echo("selected");}?> value="Karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Divisi : </label>
                        <select required name="divisi" id="divisi">
                            <?php
                            while($divisis = mysqli_fetch_array($tampildivisi)){
                            $selected = $divisi == $divisis['nama_divisi'] ? "selected" : "";
                            echo "<option value='".$divisis['id_divisi']."' ".$selected." class='form-control'>".$divisis['nama_divisi']."</option>";
                            }
                           ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Tanggal Masuk : </label>
                        <input required type="date" value="<?php echo $masuk;?>" name="tglmsk">
                    </div>
                    <div class="form-group">
                      <h6>Username</h6>
                      <input required type="text" name="username" value="<?= $username?>" class="form-control border border-primary p-2">
                    </div>
                    
                    <div class="form-group">
                      <h6>Gaji</h6>
                      <input required type="text" name="gaji" value="<?= $gaji?>" class="form-control border border-primary p-2">
                    </div>
                    <div class="row mb-4">
                      <div class = "col-6"> 
                        <div class="text-center">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                        <input type="submit" name="update" value="simpan" class="btn btn-lg bg-gradient-success btn-lg w-30 mt-4 mb-0"></button>
                        </div>
                      </div>
                      <div class = "col-5">
                        <div class="text-center">
                        <a href="pegawai.php"><button type="button" class="btn btn-lg bg-gradient-danger btn-lg w-30 mt-4 mb-0">Batal</button></a>
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