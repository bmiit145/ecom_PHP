<?php
session_start();
$connection =  mysqli_connect('localhost', 'root', '', 'priyank_ecom');
$xyz = 1;

if (isset($_SESSION['admin_id'])) {
    header("location:dashboard.php");
}

if (isset($_POST['submit'])) {
    $total_user = 0;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $qry = "select * from admins where username = '$username' and `password` = '$password' ";
    $run = mysqli_query($connection, $qry);
    $data = mysqli_fetch_assoc($run);
    $total_user = mysqli_num_rows($run);

    if ($total_user == 1) {
        $xyz = 1;
        $_SESSION['admin_id'] = $data['id'];
        header("location:dashboard.php");
    } else {
        $xyz = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="  assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="  assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="  assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="  assets/images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <style>
        .show_pass:hover{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="  assets/images/logo.svg">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" method="post" id="login">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username">
                                </div>
                                <div class="form-group">
                                    <div style="display: flex; align-items: center;">
                                    <input type="password"  class="form-control form-control-lg "  id="input_pass" placeholder="Password" name="password">
                                    <i class="fa fa-eye show_pass" ></i>
                                    </div>
                                    <div class="invalid-feedback notuser" style="display:none">user not exits</div>
                                </div>
                                <div class="mt-3 ">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn login-btn" name="submit">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="  assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="  assets/js/off-canvas.js"></script>
    <script src="  assets/js/hoverable-collapse.js"></script>
    <script src="  assets/js/misc.js"></script>
    <!-- endinject -->
    <script>
        var a = '<?php echo $xyz ?>';
        if (a != 1) {
            $('.notuser').show();
        } else {
            $('.notuser').hide();
        }
    </script>
    <script>
        

        $(document).on('click', '.login-btn', function() {
            username = $("input[name = 'username']").val();
        console.log(username);
        password = $("input[name = 'password']").val();

            if (username == "") {
                alert("Enter the Username");
            } else if (password == "") {
                alert("Enter the Password");
            } else {
                $('#login').submit();
            }
        })

        $(document).on('click' , '.show_pass' , function () {
            if ($('#input_pass').attr('type') == 'password') {
                $('#input_pass').attr('type' , 'text');
            }else{
                $('#input_pass').attr('type' , 'password');
            }

          })
    </script>
</body>

</html>