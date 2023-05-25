<?php 
session_start();
if(!isset($_SESSION['add_cart'])){
    $_SESSION['add_cart'] = array();
}
// print_r($_SESSION['add_cart']);
// echo 1111;
$id = $_POST['id'];
array_push($_SESSION['add_cart'],array('prod_id' => $id , 'qan' => 1));
// $_SESSION['add_cart'] = array_unique($_SESSION['add_cart']);
$_SESSION['add_cart']  = array_map("unserialize", array_unique(array_map("serialize", $_SESSION['add_cart'])));
// print_r($_SESSION['add_cart']);
// echo 2222;

$_SESSION['cart_num'] = count($_SESSION['add_cart']);
echo $_SESSION['cart_num'];

?>