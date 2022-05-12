<?php
// include database connection file
include '../../config/database.php';

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // update user data
    $result = mysqli_query($conn, "UPDATE users SET nama='$nama', username='$username', role='$role', password='$password' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: ../../../cafeshop/src/admin/tambah.php");
}
?>

<?php
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");

while ($item = mysqli_fetch_array($result)) {
    $nama = $item['nama'];
    $username = $item['username'];
    $role = $item['role'];
    $password = $item['password'];
}
?>