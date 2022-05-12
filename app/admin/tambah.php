<?php
// include database connection file
include '../../config/database.php';

// Check If form submitted, insert form data into users table.
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Insert user data into table
    $result = mysqli_query($conn, "INSERT INTO users(nama,username, role, password) VALUES('$nama','$username','$role','$password')");

    // Show message when user added
    header('location:../../../cafeshop/src/admin/tambah.php');
}
