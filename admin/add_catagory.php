<?php
include "header.php";
?>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'priyank_ecom');
$cat_id = 0;
$qry = "select * from catagory where cat_id = $cat_id";
$catagory = mysqli_query($connection, $qry);

?>
<div class="content-wrapper">
    <div class="row">

        <div class="col-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add New Catagory</h4>
                    <p class="card-description">Catagory details </p>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="cat_name">Catagory Name</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name">
                            <p class="valid-feedback">Available!</p>
                            <p class="invalid-feedback">Not Available!</p>
                        </div>

                        <div class="form-group">
                            <input type="radio" class="form-check-input" name="cat_type" id="main_catagory" value="1">
                            <label class="form-check-label" for="main_catagory">Main Catagory</label>

                            <input type="radio" class="form-check-input" name="cat_type" id="sub_catagtory" value="0">
                            <label class="form-check-label" for="sub_catagtory">Sub Catagory</label>
                        </div>

                        <div class="form-group main_catagory">
                            <div>
                                <label for="catagory">Catagory</label>
                                <select class="form-control catagory" name="catagory" id="sub_catagory">
                                    <option value="-1" selected>select</option>
                                    <?php foreach ($catagory as $key => $user) { ?>
                                        <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-gradient-primary me-2 submit" name="submit" disabled>Submit</button>
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
<script>
    $(document).on('click', '.file-upload-browse', function() {
        $('.file-upload-default').click();
    })
</script>
<!-- for catagory -->
<script>
    $(document).on("change", ".catagory", function() {
        var cat_id = $(this).val();

        var index = $(this).parents('.sub-cat').index();
        var len = $(this).parents('.main_catagory').children('.sub-cat').length;

        // console.log(index , len);

        if (index != len) {
            // console.log(54546545);
            for (let i = index; i < len; i++) {
                $(document).find('.sub-cat').eq(i).remove();
            }
        }
        $(this).removeAttr('name');
        $.ajax({
            type: "post",
            url: "sub_cat.php",
            data: {
                cat_id: cat_id
            },
            success: function(res) {
                // console.log(res);
                $(document).find('.main_catagory').append(res);
                len_cat = $(document).find('catagory').length
                $(document).find('.catagory').removeAttr('name');
                $(document).find('.catagory').eq(len_cat - 1).attr('name', 'catagory');
            }
        })
    })
</script>



<!-- for radio -->
<script>
    $('.catagory').attr('disabled', true);
    $(document).on('change', 'input[type=radio][name="cat_type"]', function() {

        let value = $(this).val();

        if (value == 1) {
            $('.catagory').attr('disabled', true);
            // $('.submit').removeAttr('disabled');
        } else {
            $('.catagory').removeAttr('disabled');
        }
    })


    $(document).on('keyup', '#cat_name', function() {
        let cat_name = $(this).val();
        $.ajax({
            type: 'post',
            url: 'check_cat_name.php',
            data: {
                cat_name: cat_name
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
    $(document).on('click', '.submit', function() {
        var len = $('.catagory').length;
        var cat_type = $('input[name="cat_type"]:checked').val();

        if (cat_type == 1) {
            var cat_id  = 0;
        }else{
            if ($('.catagory').eq(len - 1).val() != -1) {
                var cat_id = $('.catagory').eq(len - 1).val();
    
            } else {
                var cat_id = $('.catagory').eq(len - 2).val();
            }
        }
        
        var cat_name = $('#cat_name').val();

        $.ajax({
            type:'post',
            url:'add_cat_ajax.php',
            data:{
                cat_id:cat_id,
                cat_name:cat_name
            },
            success:function(res){

            }
        })
    })
</script>
<!-- validation -->
<script>

</script>