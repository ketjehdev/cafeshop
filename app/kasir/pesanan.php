<?php
session_start();
// include database connection file
include '../../config/database.php';

// Check If form submitted, insert form data into users table.
if (isset($_POST['pesan'])) {
    $nama = $_POST['nama'];
    $no_meja = $_POST['no_meja'];
    $pesanan = $_POST['pesanan'];
    $pegawai = $_SESSION['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $bayar = str_replace(array('Rp.', '.'), array('', ''), $_POST['bayar']);
    $exp_day = date('ymd', strtotime('+6 day'));
    $exp_week = date('ymd', strtotime('+29 day'));

    // Insert user data into table
    $result = mysqli_query($conn, "INSERT INTO report(nama, no_meja, pesanan, pegawai, jumlah, harga, bayar, exp_day, exp_week) VALUES('$nama','$no_meja','$pesanan','$pegawai','$jumlah','$harga','$bayar','$exp_day','$exp_week')");

    // Show message when user added
    header('location:../../../cafeshop/src/kasir/report.php');
}
