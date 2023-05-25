<?php
include "header.php";
?>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'priyank_ecom');

?>
<div class="content-wrapper">
    <div class="row">

        <div class="col-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add New Color</h4>
                    <p class="card-description">Color details </p>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data" id="add_color">
                        <div class="form-group">
                            <label for="color_name">Color Name</label>
                            <input type="text" class="form-control" id="color_name" name="color_name">
                            <p class="valid-feedback">Available!</p>
                            <p class="invalid-feedback">Not Available!</p>
                        </div>


                        <button class="btn btn-gradient-primary me-2 submit" disabled>Submit</button>
                        <!-- <button type="submit" class="btn btn-gradient-primary me-2 submit" name="submit" disabled>Submit</button> -->
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(document).on('click', '.file-upload-browse', function() {
        $('.file-upload-default').click();
    })
</script>

<!-- for radio -->
<script>
    $(document).on('keyup', '#color_name', function() {
        let color_name = $(this).val();
        $.ajax({
            type: 'post',
            url: 'check_color_name.php',
            data: {
                color_name: color_name
            },
            success: function(res) {
                if (res == 1) {
                    $('.valid-feedback').show();
                    $('.submit').removeAttr('disabled');
                } else {
                    $('.valid-feedback').hide();
                    $('.submit').attr('disabled', true);
                }
            }
        })
    })
</script>

<script>
    $('#add_color').validate({
        rules: {
            color_name: {
                required: true,
                minlength: 3,
            }
        },

        submitHandler: function(form) {

            var color_name = $('#color_name').val();
            console.log(color_name);
            $.ajax({
                type: 'post',
                url: 'add_color_ajax.php',
                data: {
                    color_name: color_name
                },
                success: function(res) {
                    location.reload();
                }
            })
        }


    })


    // $(document).on('click', '.submit', function() {

    //     var color_name = $('#color_name').val();
    //     console.log(color_name);
    //     $.ajax({
    //         type: 'post',
    //         url: 'add_color_ajax.php',
    //         data: {
    //             color_name: color_name
    //         },
    //         success: function(res) {

    //         }
    //     })
    // })
</script>
<!-- validation -->
<script>

</script>