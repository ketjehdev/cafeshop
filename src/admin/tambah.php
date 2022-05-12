<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

include '../../config/database.php';

// cek apakah user sudah login apa blom
if ($_SESSION['role'] == "") {
    // alihkan ke halaman login
    header('location:../../auth/login.php');
}

// session data
$full_name = $_SESSION['nama'];
$fname = explode(' ', trim($full_name))[0];

// sql select all data
$sql = "SELECT * FROM users";

// query all data users with connection database
$query = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="theme-color" content="cyan">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= ucfirst($_SESSION['title']) ?> Tambah User | CSO</title>

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
                        <a class="nav-link" href="tambah.php">
                            <i class="icon-grid mr-2 text-light" data-feather="user-plus"></i>
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
                                    <h3 class="font-weight-bold">Tambah data <button type="button" class="btn btn-success px-3 py-1" data-toggle="modal" data-target="#addUser"><span style="font-size: 18px;">+</span></button></h3>
                                    <h6 class="font-weight-normal mb-0">
                                        <span class="text-primary">
                                            Management user disini!
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" style="margin-top: -2.5em;" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah user</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../app/admin/tambah.php" method="POST">
                                        <label for="nama">Nama :</label>
                                        <input type="text" required name="nama" autofocus class="form-control" placeholder="Masukkan nama user" id="nama">

                                        <label for="username" style="margin-top: 10px;">Username :</label>
                                        <input type="text" required name="username" class="form-control" placeholder="Masukkan username user" id="username">

                                        <label for="role" style="margin-top: 10px;">Role :</label>
                                        <select name="role" class="form-control" id="role" required>
                                            <option value="">- Pilih Role -</option>
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="kasir">Kasir</option>
                                        </select>

                                        <label for="password" style="margin-top: 10px;">Password :</label>
                                        <input type="text" name="password" required class="form-control" placeholder="Masukkan password user" id="password">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr class="text-center table-info">
                                    <th class="th-sm">#</th>
                                    <th class="th-sm">Nama</th>
                                    <th class="th-sm">Username</th>
                                    <th class="th-sm">Password</th>
                                    <th class="th-sm">Role</th>
                                    <th class="th-sm">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr class="text-center table-warning">
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data['nama'] ?></td>
                                        <td><?php echo $data['username'] ?></td>
                                        <td><?php echo $data['password'] ?></td>
                                        <td><?php echo $data['role'] ?></td>
                                        <td>
                                            <a href='../../app/admin/delete.php?id=<?= $data['id'] ?>'>
                                                <button class="btn btn-danger px-2"><i data-feather="trash-2"></i></button>
                                            </a>
                                            <button class="btn btn-info px-2"><i data-feather="edit"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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

    <script>
        $(document).ready(function() {
            $(' #dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>

</html>