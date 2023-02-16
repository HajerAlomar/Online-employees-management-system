<?php
if (!isset($_SESSION)) {
    session_start();
}

include "DB.php";
$id = $_POST['id'];

//echo "<script>alert($id)</script>";
$sql = "SELECT * FROM `request` WHERE `id`=" .$id;
$request = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($request);

echo json_encode($row['description']);


    ?>