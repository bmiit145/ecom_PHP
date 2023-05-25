<?php 
$connection = mysqli_connect('localhost', 'root', '', 'priyank_ecom');

    $p_name = $_POST['p_name'];
    // echo $p_name;
    $p_desc = $_POST['p_desc'];
    $p_price = $_POST['web_price'];
    $p_mrp = $_POST['mrp'];
    $catagory = $_POST['cat_id'];

    $img_name = '';
  
    // if ($_FILES['image']["name"] != '') {
    //   $img_name = time() . rand(1000, 9999) . $_FILES['image']["name"];
    //   // print_r($_FILES['image']);
  
    //   if (!is_dir('../img')) {
    //       mkdir('../img');
    //   }
  
    //   $target_file = "../img/" . $img_name;
    //   move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    // }
  
  $qry  = "insert into product_master(name , cat_id , description , price , MRP , image )values('$p_name' , '$catagory' ,'$p_desc' , '$p_price' , '$p_mrp' ,'$img_name')" ;
  mysqli_query($connection , $qry);
  
  
?>