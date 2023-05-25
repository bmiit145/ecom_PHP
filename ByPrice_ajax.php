<?php
$connection = mysqli_connect('localhost', 'root', '', 'priyank_ecom');

$cat_id = $_POST['cat_id'];


$qry = "SELECT * FROM `product_master` WHERE price = '' ";

if (!isset($_POST['all_price'])) {

    if (isset($_POST['price_1'])) {
        $qry .= "or price between 0 and 100 and cat_id = '$cat_id' and status = '1'";
    }
    if (isset($_POST['price_2'])) {
        $qry .= "or price between 100 and 200 and cat_id = '$cat_id'and status = '1'";
    }
    if (isset($_POST['price_3'])) {
        $qry .= "or price between 200 and 300 and cat_id = '$cat_id'and status = '1'";
    }
    if (isset($_POST['price_4'])) {
        $qry .= "or price between 300 and 400 and cat_id = '$cat_id'and status = '1'";
    }
    if (isset($_POST['price_5'])) {
        $qry .= "or price between 400 and 500 and cat_id = '$cat_id'and status = '1'";
    }
} else {
    $qry .= "or cat_id = '$cat_id'and status = '1'";
}


$run = mysqli_query($connection, $qry);
$data = mysqli_fetch_all($run);

// print_r($data);

?>

<?php foreach ($run as $user) { ?>
    <div class="col-lg-4 col-md-6 col-sm-12 pb-1 ByPrice">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" src="img/<?php echo $user['image'] ?>" alt="">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3"><?php echo $user['name'] ?></h6>
                <div class="d-flex justify-content-center">
                    <h6>$<?php echo $user['price'] ?></h6>
                    <h6 class="text-muted ml-2"><del>$<?php echo $user['MRP'] ?></del></h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="detail.php?p_id=<?php echo $user['id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
            </div>
        </div>
    </div>
<?php } ?>