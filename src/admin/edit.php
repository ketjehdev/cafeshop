<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

include '../../config/database.php';
include '../../app/admin/edit.php';

// cek apakah user sudah login apa blom
if ($_SESSION['role'] != "admin") {
    // alihkan ke halaman login
    header('location:../../auth/login.php');
}
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

    <!-- partial -->
    <div class="container-fluid d-flex justify-content-center page-body-wrapper">
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-3 mb-xl-0">
                                <h3 class="font-weight-bold">Edit data <h6 class="font-weight-normal mb-0">
                                        <span class="text-primary">
                                            Management user disini!
                                        </span>
                                    </h6>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="tambah.php">
                    <button class="btn btn-warning mb-4" style="display: inline-block;">Kembali</button>
                </a>

                <form action="../../app/admin/edit.php" method="POST">
                    <span>Nama</span>
                    <input type="text" class="form-control mb-3" placeholder="Masukkan nama" value="<?= $nama; ?>" name="nama">

                    <span>Username</span>
                    <input type="text" class="form-control mb-3" placeholder="Masukkan username" value="<?= $username; ?>" name="username" id="">

                    <span>Role</span>
                    <select name="role" class="form-control mb-3" required>
                        <option value="">- Pilih Role -</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="kasir">Kasir</option>
                    </select>

                    <span>Password</span>
                    <input type="text" class="form-control mb-4" placeholder="Masukkan password" name="password" value="<?= $password; ?>" id="">
                    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                    <button name="update" class="btn btn-primary" style="width: 100%;" type="submit">Simpan Perubahan</button>
                </form>
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