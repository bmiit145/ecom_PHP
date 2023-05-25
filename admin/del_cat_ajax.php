<?php 
$connection = mysqli_connect('localhost' , 'root' , '' , 'priyank_ecom');

$cat_id = $_POST['cat_id'];
$qry = "select * from catagory where cat_id = '$cat_id'";
$num1 = mysqli_num_rows(mysqli_query($connection , $qry));

$qry = "select * from product_master where cat_id  = '$cat_id'";
$num2 = mysqli_num_rows(mysqli_query($connection , $qry));

if ($num1 == 0 && $num2 == 0) {
    echo 0;
    $qry = "delete from catagory where `id` = '$cat_id'";
    mysqli_query($connection , $qry);
}else if($num1 != 0 && $num2 != 0){
    echo 1;
}else if ($num2 != 0 && $num1 == 0 ) {
    echo 3;
}else{
    echo 2;
}
