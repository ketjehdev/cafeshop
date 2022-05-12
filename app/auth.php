<?php

// mengaktifkan session
session_start();

// menghubungkan koneksi ke db
include '../config/database.php';

// menangkap data yang diinput/dikirim
$user = $_POST['username'];
$pass = $_POST['password'];

// menyeleksi data user dengan username dann password yang sesuai
$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user' AND password = '$pass'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($query);

// cek apakah username dan password ada pada database
if ($cek > 0) {
    // mengambil data dari database yang di query
    $data = mysqli_fetch_assoc($query);

    // cek jika user login sebagai admin
    if ($data['role'] == "admin") {
        // membuat session admin
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = "admin";
        $_SESSION['title'] = $data['role'];
        // mengalihkan ke halaman admin
        header('Location:../src/admin/index.php');
    }

    // cek jika user login sebagai manager
    else if ($data['role'] == "manager") {
        // membuat session manager
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = "manager";
        $_SESSION['title'] = $data['role'];
        // mengalihkan ke halaman manager
        header('Location:../src/manager/index.php');
    }

    // cek jika user login sebagai kasir
    else if ($data['role'] == "kasir") {
        // membuat session kasir
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = "kasir";
        $_SESSION['title'] = $data['role'];
        // mengalihkan ke halaman kasir
        header('Location:../src/kasir/index.php');
    }

    // jika tidak ada kondisi di atas yang benar maka kembalikan ke halaman login
    else {
        header("Location:../auth/login.php?alert=gagal");
    }
} else {
    header("Location:../auth/login.php");
}
