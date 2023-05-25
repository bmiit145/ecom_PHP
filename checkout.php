<?php

include "header.php";
if (!isset($_SESSION['user_id'])) {
    $_SESSION['status'] = 1;
    echo "<script>  window.location = 'login.php' </script>";
}

if (isset($_SESSION['add_cart'])) {
    // print_r($_SESSION['add_cart']);
    $data = $_SESSION['add_cart'];
    // print_r($data);
} else {
    header('location:index.php');
}

$connection = mysqli_connect('localhost' , 'root' , '' , 'priyank_ecom');

$qry = "select * from countries";
$countries = ( mysqli_query($connection , $qry));
?>

<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                <form id="order_form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John" name="fname">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe" name="lname">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com" name="email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789" name="mo_no">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street" name="address1">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street" name="address2">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select" name="country">
                                <option value="-1" selected>Select Country</option>
                                <?php  foreach($countries as $key => $country) {?>
                                <option value="<?php echo $country['id']?>"><?php echo $country['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Pin Code</label>
                            <input class="form-control" type="text" placeholder="123" name="pincode">
                        </div>
                </form>
                <!-- <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="newaccount">
                            <label class="custom-control-label" for="newaccount">Create an account</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="shipto">
                            <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                        </div>
                    </div> -->
            </div>
        </div>
        <!-- <div class="collapse mb-4" id="shipping-address">
                <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" placeholder="John">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" placeholder="Doe">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" placeholder="example@email.com">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" type="text" placeholder="+123 456 789">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 1</label>
                        <input class="form-control" type="text" placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 2</label>
                        <input class="form-control" type="text" placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select class="custom-select">
                            <option selected>United States</option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" placeholder="New York">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <input class="form-control" type="text" placeholder="New York">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>ZIP Code</label>
                        <input class="form-control" type="text" placeholder="123">
                    </div>
                </div>
            </div> -->
    </div>
    <div class="col-lg-4">
        <div class="card border-secondary mb-5">
            <div class="card-header bg-secondary border-0">
                <h4 class="font-weight-semi-bold m-0">Order Total</h4>
            </div>
            <div class="card-body">
                <h5 class="font-weight-medium mb-3">Products</h5>

                <?php foreach ($data as $key => $prod) {
                    $prod_data_id = $prod['prod_id'];
                    $qry = "select * from product_master where id = '$prod_data_id'";
                    $prod_run = mysqli_query($connection, $qry);
                    $prod_data = mysqli_fetch_assoc($prod_run);
                ?>

                    <div class="d-flex justify-content-between product_cart">
                        <p> <?php echo $prod_data['name'] ?></p>
                        <p class="each-total">$<?php echo $prod_data['price'] * $data[$key]['qan']; ?></p>
                    </div>
                <?php } ?>
                <hr class="mt-0">
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Subtotal</h6>
                    <h6 class="font-weight-medium sub_total">$150</h6>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">Shipping</h6>
                    <h6 class="font-weight-medium shipp">$10</h6>
                </div>
            </div>
            <div class="card-footer border-secondary bg-transparent">
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold">Total</h5>
                    <h5 class="font-weight-bold g_total"></h5>
                </div>
            </div>
        </div>
        <div class="card border-secondary mb-5">
            <div class="card-header bg-secondary border-0">
                <h4 class="font-weight-semi-bold m-0">Payment</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="payment" id="paypal">
                        <label class="custom-control-label" for="paypal">Paypal</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                        <label class="custom-control-label" for="directcheck">Direct Check</label>
                    </div>
                </div>
                <div class="">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                        <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                    </div>
                </div>
            </div>
            <div class="card-footer border-secondary bg-transparent">
                <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 order" name="p_order">Place Order</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Checkout End -->

<?php
include "footer.php"
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    sub_total(shipp);
</script>
<script>
    
  $.validator.addMethod("notEqualValue" , function(value , element , param){
    return param !== value;
  },"Please select value")


    $('#order_form').validate({
        rules: {
            fname: {
                required: true,
                minlength: 2,
            },
            lname: {
                required: true,
                minlength: 2,
            },
            email:{
                required:true,
                email:true,
            },
            mo_no:{
                required:true,
                number:true,
                minlength:10,
                maxlength:10,

            },
            address1:{
                required:true,
                minlength:10,
            },
            address2:{
                required:false,
                minlength:10,
            },
            country:{
                notEqualValue:'-1',
            },
            state:{
                notEqualValue:'-1',
            },
            city:{
                notEqualValue:'-1',
            },
            pincode:{
                required:true,
                minlength:6,
                maxlength:6,
            }

        },

    })
    $('.order').click(function() {
        $('#order_form').submit();
    })
</script>