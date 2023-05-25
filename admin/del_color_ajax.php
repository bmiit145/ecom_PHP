<?php 
$connection = mysqli_connect('localhost' , 'root' , '' , 'priyank_ecom');

$color_id = $_POST['color_id'];

$qry = "select * from product_master where color_id  = '$color_id'";
$num1 = mysqli_num_rows(mysqli_query($connection , $qry));

if ($num1 == 0) {
    $qry = "delete from color where `color_id` = '$color_id'";
    mysqli_query($connection , $qry);
    echo 0;
}else{
    echo 1;
}
