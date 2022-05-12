<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

include '../../config/database.php';

// cek apakah user sudah login sesuai role apa blom
if ($_SESSION['role'] != "admin") {
    // alihkan ke halaman login
    header('Location:../../auth/login.php');
}

// session data
$full_name = $_SESSION['nama'];
$fname = explode(' ', trim($full_name))[0];

// count total users
$sqlUsers = "SELECT COUNT(*) AS jumlah_user FROM users";
$queryUsers = mysqli_query($conn, $sqlUsers);
$fetchDataUsers = mysqli_fetch_array($queryUsers);

$jumlah_user = $fetchDataUsers['jumlah_user'];

// count total menu
$sqlMenu = "SELECT COUNT(*) AS jumlah_menu FROM menu";
$queryMenu = mysqli_query($conn, $sqlMenu);
$fetchDataMenu = mysqli_fetch_array($queryMenu);

$jumlah_menu = $fetchDataMenu['jumlah_menu'];

// count net income
$sqlNetIncome = "SELECT SUM(bayar) FROM report";
$queryNetIncome = mysqli_query($conn, $sqlNetIncome);
$fetchDataIncome = mysqli_fetch_array($queryNetIncome);

$jumlah_income = $fetchDataIncome[0];

// sql select all data
$sql = "SELECT * FROM menu";

// query all data users with connection database
$queryMenu = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="theme-color" content="cyan">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= ucfirst($_SESSION['title']) ?> Dashboard | CSO</title>

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
                            <i class="icon-grid mr-2 text-light" data-feather="home"></i>
                            <span class="menu-title">Beranda</span>
                        </a>
                    </li>

                    <!-- add -->
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">
                            <i class="icon-grid mr-2 text-secondary" data-feather="user-plus"></i>
                            <span class="menu-title">Tambah user</span>
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
                                    <h3 class="font-weight-bold">Hai, <?= $fname; ?>😊</h3>
                                    <h6 class="font-weight-normal mb-0">
                                        <span class="text-primary">
                                            <?= $_SESSION['role']; ?> | aplikasi management cafe kamu!
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <img src="../../public/img/dashboard.jpg" alt="people" style="height: 100%; border-radius: 25px;">
                            </div>
                        </div>

                        <div class="col-md-6 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">Total Users</p>
                                            <p class="fs-30 mb-2">
                                                <?php
                                                if ($jumlah_user == true) {
                                                    echo $jumlah_user;
                                                } else {
                                                    echo 0;
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Menu</p>
                                            <p class="fs-30 mb-2">
                                                <?php
                                                if ($jumlah_menu == true) {
                                                    echo $jumlah_menu;
                                                } else {
                                                    echo 0;
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                                    <div class="card card-light-blue bg-success">
                                        <div class="card-body">
                                            <p class="mb-4">Net Income</p>
                                            <p class="fs-30 mb-2">
                                                <?php
                                                if ($jumlah_income == true) {
                                                    echo 'Rp. ' . number_format($jumlah_income, 0, ',', '.');
                                                } else {
                                                    echo 'Rp. ' . 0;
                                                }
                                                ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4>Daftar Menu</h4>

                    <div class="row">
                        <?php
                        $no = 1;
                        while ($menuData = mysqli_fetch_array($queryMenu)) {
                        ?>
                            <div class="card col-lg-3 mr-2 mt-2 col-md-12">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong><?= $menuData['nama_menu']; ?></strong></li>
                                        <li class="list-group-item">
                                            <span class="text-success">
                                                <strong>
                                                    Rp. <?php
                                                        if ($menuData['harga'] == true) {
                                                            echo number_format($menuData['harga'], 0, ',', '.');
                                                        } else {
                                                            echo 0;
                                                        }
                                                        ?></td>
                                                </strong>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>


                <!-- content-wrapper ends -->

                <!-- footer.html -->
                <footer class="footer text-center" style="background: #fff;">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. CSO</span>
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

</body>

</html>