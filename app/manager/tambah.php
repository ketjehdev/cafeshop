<?php
// include database connection file
include '../../config/database.php';

// Check If form submitted, insert form data into users table.
if (isset($_POST['submit'])) {
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];

    // Insert user data into table
    $result = mysqli_query($conn, "INSERT INTO menu(nama_menu,harga) VALUES('$nama_menu','$harga')");

    // Show message when user added
    header('location:../../../cafeshop/src/manager/menu.php');
}
