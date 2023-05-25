<?php 
$connection = mysqli_connect('localhost' , 'root' , '' ,'priyank_ecom');

$cat_id = $_POST['cat_id'];
$cat_name = $_POST['cat_name'];

$qry = "insert into catagory(name , cat_id) values('$cat_name' , '$cat_id')";
mysqli_query($connection , $qry);

?>