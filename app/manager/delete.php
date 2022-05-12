<?php
// include database connection file
include '../../config/database.php';

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM menu WHERE id=$id");

// After delete redirect to Home, so that latest user list will be displayed.
header("location:../../../cafeshop/src/manager/menu.php");
