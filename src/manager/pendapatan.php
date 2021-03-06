<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

include '../../config/database.php';

// cek apakah user sudah login apa blom
if ($_SESSION['role'] != "manager") {
    // alihkan ke halaman login
    header('location:../../auth/login.php');
}

// session data
$full_name = $_SESSION['nama'];
$fname = explode(' ', trim($full_name))[0];

// sql select all data
$sql = "SELECT * FROM menu";

// query all data users with connection database
$query = mysqli_query($conn, $sql);

date_default_timezone_set('Asia/Jakarta');
$today = date('ymd', strtotime('today'));

// count net income +7 day (week)
$sqlNetIncomeDay = "SELECT SUM(bayar) FROM report WHERE $today <= exp_day";
$queryNetIncomeDay = mysqli_query($conn, $sqlNetIncomeDay);
$fetchDataIncomeDay = mysqli_fetch_array($queryNetIncomeDay);

$jumlah_income_day = $fetchDataIncomeDay[0];

// count net income +30 day (week)
$sqlNetIncomeWeek = "SELECT SUM(bayar) FROM report WHERE $today >= exp_week OR $today <= exp_week";
$queryNetIncomeWeek = mysqli_query($conn, $sqlNetIncomeWeek);
$fetchDataIncomeWeek = mysqli_fetch_array($queryNetIncomeWeek);

$jumlah_income_week = $fetchDataIncomeWeek[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="theme-color" content="cyan">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= ucfirst($_SESSION['title']) ?> Pendapatan | CSO</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="../../public/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../public/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../public/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../public/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../public/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../../public/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="../../public/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../public/img/logo.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="z-index: 100;">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="../../index.php"><img src="../../public/img/logo.png" class="mr-2" alt="logo" style="width: 40px; height: 40px;" /></a>
                <a class="navbar-brand brand-logo-mini" href="../../index.php"><img src="../../public/img/logo.png" alt="logo" style="width: 40px; height: 40px;" /></a>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <span class="text-dark mx-1" style="font-size: 11px;"><?= $fname; ?></span>
                            <img src="../../public/img/profil.png" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a href="logout.php" class="dropdown-item">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- partial -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <!-- dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="icon-grid mr-2 text-secondary" data-feather="home"></i>
                            <span class="menu-title">Beranda</span>
                        </a>
                    </li>

                    <!-- add -->
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">
                            <i class="icon-grid mr-2 text-secondary" data-feather="list"></i>
                            <span class="menu-title">Tambah menu</span>
                        </a>
                    </li>

                    <!-- report -->
                    <li class="nav-item">
                        <a class="nav-link" href="report.php">
                            <i class="icon-grid mr-2 text-secondary" data-feather="database"></i>
                            <span class="menu-title">Laporan</span>
                        </a>
                    </li>

                    <!-- pendapatan -->
                    <li class="nav-item">
                        <a class="nav-link" href="pendapatan.php">
                            <i class="icon-grid mr-2 text-light" data-feather="dollar-sign"></i>
                            <span class="menu-title">Pendapatan</span>
                        </a>
                    </li>

                    <!-- log -->
                    <li class="nav-item">
                        <a class="nav-link" href="log.php">
                            <i class="icon-grid mr-2 text-secondary" data-feather="navigation"></i>
                            <span class="menu-title">Log activity</span>
                        </a>
                    </li>

                    <!-- logout -->
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="icon-grid mr-2 text-secondary" data-feather="log-out"></i>
                            <span class="menu-title">Keluar</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Pendapatan (Net Income)
                                        <h6 class="font-weight-normal mb-0">
                                            <span class="text-primary">
                                                Total pendapatan cafe kamu disini!
                                            </span>
                                        </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 text-light p-3 mb-2 mr-2 bg-primary" style="background: red;height:20vh;border-radius: 18px;">
                            <h3 class="mb-0">Pendapatan Harian</h3>
                            <p>pendapatan cafe kamu selama 7 hari</p>
                            <h4>
                                <strong>
                                    Rp. <?php
                                        if ($jumlah_income_day == true) {
                                            echo number_format($jumlah_income_day, 0, ',', '.');
                                        } else {
                                            echo 0;
                                        }

                                        ?>


                                </strong>
                            </h4>
                        </div>
                        <div class="col-md-5 p-3 mb-2 mr-1 text-dark bg-warning" style="background: red;height:20vh;border-radius: 18px;">
                            <h3 class="mb-0">Pendapatan Bulanan</h3>
                            <p>pendapatan cafe kamu selama 30 hari</p>
                            <h4>
                                <strong>
                                    Rp.
                                    <?php
                                    if ($jumlah_income_week == true) {
                                        echo number_format($jumlah_income_week, 0, ',', '.');
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </strong>

                            </h4>
                        </div>
                    </div>
                </div>

                <!-- content-wrapper ends -->

                <!-- footer.html -->
                <footer class="footer text-center" style="background: #fff;">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ?? 2021. CSO</span>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugin feather icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>
    <!-- end of plugin feather icon -->

    <!-- plugins:js -->
    <script src="../../public/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="../../public/vendors/chart.js/Chart.min.js"></script>
    <script src="../../public/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../../public/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="../../public/js/dataTables.select.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="../../public/js/off-canvas.js"></script>
    <script src="../../public/js/hoverable-collapse.js"></script>
    <script src="../../public/js/template.js"></script>

    <!-- Custom js for this page-->
    <script src="../../public/js/dashboard.js"></script>
    <script src="../../public/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->

    <script>
        $(document).ready(function() {
            $(' #dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

    <!-- script cleave n money -->
    <script src="../../public/js/cleave.js"></script>
    <script src="../../public/js/money.js"></script>
    <!-- end script cleave n money -->
</body>

</html>