<?php 
    session_start();
    $id = $_POST['id'];


    // $_SESSION['add_cart'] = \array_diff($_SESSION['add_cart'] , array('prod_id' => $id));
    
    
    $arr =  $_SESSION['add_cart'];

    foreach($arr as $key => $arr_ele){
        if ($arr[$key]['prod_id'] == $id) {
            unset($arr[$key]);
            $_SESSION['add_cart'] = $arr;
        }
    }
    


    $_SESSION['cart_num'] = count($_SESSION['add_cart']);

    echo $_SESSION['cart_num'];
