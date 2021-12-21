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

  include 'koneksi.php';
  $id = $_SESSION['id'];

  date_default_timezone_set("Asia/Jakarta");

  $result = $koneksi->query("SELECT * FROM pegawai WHERE pegawai.id_pegawai = '$id'");
  $arr = mysqli_fetch_array($result);

  $presensi = $koneksi->query("SELECT * FROM presensi WHERE id_pegawai = '$id' AND MONTH(waktu) = MONTH(NOW())");

  //highcharts json
  $prs = mysqli_query($koneksi, 'SELECT COUNT(*) as cnt, date(waktu) as tanggal FROM presensi GROUP BY tanggal ');
  while ($row=mysqli_fetch_array($prs)) {
    $data[] = array(
      $row['tanggal'],
      floatval($row['cnt'])
    );
  }
  $json = json_encode($data);
                  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Dashboard
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
                <h3 class="text-white text-capitalize ps-3">Dashboard Admin</h3>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="responsive p-0 p-4">
                <div class="row">
                  <div class="col-12 col-xl-8">
                    <div class="card card-plain h-100">
                      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-3">
                        <div class="card">
                          <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                              <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                              <p class="text-sm mb-0 text-capitalize"></p>
                            </div>
                          </div>
                          <div class="card-body">
                            <div id="grafik"></div>
                          </div>
                          <hr class="dark horizontal my-0">
                          <div class="card-footer p-3">
                            <p class="mb-0"> 
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                      <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                          <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                              <h6 class="mb-0">Profil Admin</h6>
                            </div>
                          </div>
                        </div>
                        <div class="card-body p-3">
                          <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Username Admin:</strong> &nbsp; <?=$arr['username']?></li>
                            <hr>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.highcharts.com/highcharts.src.js"></script>
  <script src="highcharts/code/highcharts.js"></script>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script type="text/javascript">
    Highcharts.chart('grafik', {
        chart: {
          type: 'line',
          zoomType: 'x'
        },

        title: {
          text: 'Presensi Karyawan'
        },

        subtitle: {
          text: ''
        },

        yAxis: {
          title: {
            text: 'Karyawan Masuk'
          },
          allowDecimals: false,
        },

        xAxis: {
          type: 'category',
          accessibility: {
            rangeDescription: 'Tanggal'
          }
        },

        tooltip: {
          pointFormat: '{point.y} Karyawan'
        },

        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
        },

        plotOptions: {
          series: {
            label: {
              connectorAllowed: false
            }
          }
        },

        series: [{
          name: 'Jumlah Karyawan',
          lineWidth: 2,
          data: <?= $json ?>
        }],

        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom'
              }
            }
          }]
        }
      });    
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>