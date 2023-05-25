<?php 
    $connection = mysqli_connect('localhost' , 'root' , '' , 'priyank_ecom');

    $cat_name = $_POST['cat_name'];
    
    $qry = "select * from catagory where name = '$cat_name'";

    $run = mysqli_query($connection , $qry);

    $num = mysqli_num_rows($run);

    if ($num == 0) {
        echo 1;
    }else{
        echo 0;
    }
