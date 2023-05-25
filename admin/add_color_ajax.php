<?php 
$connection = mysqli_connect('localhost' , 'root' , '' ,'priyank_ecom');

$color_name = $_POST['color_name'];

$qry = "insert into color(color_name) values('$color_name')";
mysqli_query($connection , $qry);


?>