<?php 
    $connection = mysqli_connect('localhost' , 'root' , '' , 'priyank_ecom');

    $color_name = $_POST['color_name'];
    
    $qry = "select * from color where color_name = '$color_name'";

    $run = mysqli_query($connection , $qry);

    $num = mysqli_num_rows($run);

    if ($num == 0) {
        echo 1;
    }else{
        echo 0;
    }
?>