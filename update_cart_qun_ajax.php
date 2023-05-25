<?php 
    session_start();

    $id = $_POST['id'];
    $qun = $_POST['qun'];

    $arr =  $_SESSION['add_cart'];

    foreach($arr as $key => $arr_ele){
        if ($arr[$key]['prod_id'] == $id) {
            $arr[$key]['qan'] = $qun;
            $_SESSION['add_cart'] = $arr;
            break;
        }
    }

    print_r($_SESSION['add_cart'])

?>