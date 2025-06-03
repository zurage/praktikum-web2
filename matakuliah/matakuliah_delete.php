<?php
include "../connection.php";
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM matakuliah WHERE id=$id");
header("Location:../admin/?page=matakuliah-show");
