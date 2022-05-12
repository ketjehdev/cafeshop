<?php
// include database connection file
include '../../config/database.php';

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $nama_menu = $_POST['nama_menu'];
    $harga = str_replace(array('Rp.', '.'), array('', ''), $_POST['harga']);

    // update user data
    $result = mysqli_query($conn, "UPDATE menu SET nama_menu='$nama_menu', harga='$harga' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: ../../../cafeshop/src/manager/menu.php");
}
?>

<?php
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM menu WHERE id=$id");

while ($menu = mysqli_fetch_array($result)) {
    $nama_menu = $menu['nama_menu'];
    $harga = $menu['harga'];
}
?>