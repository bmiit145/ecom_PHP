<?php 
$connection = mysqli_connect("localhost", "root", "", "priyank_ecom");
$status = $_GET['act_btn'];
$id = $_GET['id'];
$qry = "update product_master set status = '$status' where id = $id";
$run = mysqli_query($connection, $qry);
header('location:view_product.php');
?>