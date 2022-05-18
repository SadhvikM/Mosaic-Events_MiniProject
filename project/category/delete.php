<?php
include('../db_connect.php');
include('../checklogin.php');
$id = $_GET['id'];
$DelSql = "DELETE FROM `categories` WHERE id=$id";
$res = mysqli_query($conn, $DelSql);
if($res){
	header('location: view.php');
}else{
	echo "Failed to delete";
}
?>