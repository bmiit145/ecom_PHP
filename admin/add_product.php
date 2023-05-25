<?php
include "header.php";
?>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'priyank_ecom');
$cat_id = 0;
$qry = "select * from catagory where cat_id = $cat_id";
$catagory = mysqli_query($connection, $qry);


$qry = "select * from color";
$color = mysqli_query($connection , $qry);

$qry = "select * from size";
$size =  mysqli_query($connection , $qry);

if (isset($_POST['p_name'])) {
  $p_name = $_POST['p_name'];
  $p_desc = $_POST['p_desc'];
  $p_price = $_POST['web_price'];
  $p_mrp = $_POST['mrp'];
  $catagory = $_POST['cat_id'];
  $color_id = $_POST['color_id'];
  $status = 1;
  $img_name = '';
  $p_qua = $_POST['p_qua'];
  $p_desc_2 = $_POST['p_desc_2'];
  $size_id = $_POST['size'];
  if ($_FILES['image']["name"] != '') {
    $img_name = time() . rand(1000, 9999) . $_FILES['image']["name"];
    // print_r($_FILES['image']);

    if (!is_dir('../img')) {
      mkdir('../img');
    }

    $target_file = "../img/" . $img_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
  }

  $qry  = "insert into product_master(name , cat_id , description , price , MRP , image , color_id , status , quantity , desc_2 , size_id)values('$p_name' , '$catagory' ,'$p_desc' , '$p_price' , '$p_mrp' ,'$img_name' , '$color_id' , '$status' , '$p_qua' , '$p_desc_2' , '$size_id')";
  mysqli_query($connection, $qry);
}

?>
<div class="content-wrapper">
  <div class="row">

    <div class="col-9 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Product</h4>
          <p class="card-description">Product details </p>



          <form class="forms-sample" method="POST" enctype="multipart/form-data" id="product_data">
            <input type="text" name="cat_id" id="cat_id" hidden>
            <div class="form-group">
              <label for="exampleInputName1">Product Name</label>
              <input type="text" class="form-control" name="p_name" placeholder="Product Name">
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">Product Description</label>
              <textarea class="form-control" id="p_desc" rows="4" name="p_desc"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">Product Description (optional)</label>
              <textarea class="form-control" id="p_desc_2" rows="4" name="p_desc_2"></textarea>
            </div>

            <div class="form-group">
              <label>photo upload</label>
              <input type="file" class="file-upload-default" name="image">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">

                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Website Price</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gradient-primary text-white">$</span>
                </div>
                <input type="text" class="form-control" name="web_price" id="web_price" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                  <span class="input-group-text">.00</span>
                </div>
              </div>
              <label id="web_price-error" class="error" for="web_price" style="display: none;"></label>
            </div>
            <div class="form-group">
              <label for="exampleInputName1">MRP</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gradient-primary text-white">$</span>
                </div>
                <input type="text" name="mrp" class="form-control" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                  <span class="input-group-text">.00</span>
                </div>
              </div>
              <label id="mrp-error" class="error" for="mrp" style="display: none;"></label>
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <select class="form-control size" name="size" id="p_size">
                  <option value="-1" selected>select</option>
                  <?php foreach ($size as $key => $user) { ?>
                    <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Quantity</label>
              <input type="text" class="form-control" name="p_qua" placeholder="Quantity">
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <select class="form-control color" name="color_id" id="main_color">
                  <option value="-1" selected>select</option>
                  <?php foreach ($color as $key => $user) { ?>
                    <option value="<?php echo $user['color_id'] ?>"><?php echo $user['color_name'] ?></option>
                  <?php } ?>
                </select>
            </div>

            <div class="form-group main_catagory">
              <div>
                <label for="catagory">Catagory</label>
                <select class="form-control catagory" name="catagory" id="main_cat">
                  <option value="-1" selected>select</option>
                  <?php foreach ($catagory as $key => $user) { ?>
                    <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
                  <?php } ?>
                </select>
                <label id="main_cata-error" for="main_cat" style="color: red;">Please select value</label>
              </div>
            </div>

           

            <button class="btn btn-gradient-primary me-2 submit">Submit</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
  $(document).on('click', '.file-upload-browse', function() {
    $('.file-upload-default').click();
  })
  $(document).on('change', '.file-upload-default', function() {
    $(".file-upload-info").val($(this).val().substring(12))

  })
</script>
<!-- for catagory -->
<script>
  $('#main_cata-error').hide();
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
        $(document).find('.main_catagory').append(res);
        len_cat = $(document).find('catagory').length
        $(document).find('.catagory').removeAttr('name');
        $(document).find('.catagory').eq(len_cat - 1).attr('name','catagory');
      }
    })
  })
</script>
<!-- for submit -->
<script>
  $.validator.addMethod("greaterThanEqual", function(value, element, param) {
    var target = $(param);

    // if (this.settings.onfocusout && target.not(".validate-greaterThanEqual-blur").length) {
      // target.addClass("validate-greaterThanEqual-blur").on("blur.validate-greaterThanEqual", function() {
        // $(element).valid();
      // });
    // }

    var referenceValue = target.val();
    if ($.isNumeric(value) && $.isNumeric(referenceValue)) {
      value = parseFloat(value);
      referenceValue = parseFloat(referenceValue);
      return value >= referenceValue;
    }

    // return value >= target.val();
  }, "Please enter a Greter or equal value than website price");

    $.validator.addMethod("notEqualValue" , function(value , element , param){
      return param !== value;
    },"Please select value")

  $("#product_data").validate({
    rules: {
      p_name: {
        required: true,
        minlength: 3,
        // maxlength: 8,
      },
      p_desc: {
        required: true,
        minlength: 10
      },
      image: {
        required: true,
      },
      web_price: {
        required: true,
        number: true,
        min:1,
      },
      mrp: {
        required: true,
        number: true,
        min:1,
        greaterThanEqual:'#web_price'
      },
      color_id:{
        notEqualValue:'-1',
      },
      p_qua:{
        required:true,
        number:true,
        min:1
      },

      size:{
        notEqualValue:'-1',
      }

    },

    
    submitHandler: function(form) {

      var len = $('.catagory').length;
      if ($('.catagory').eq(len - 1).val() != -1) {
        var cat_id = $('.catagory').eq(len - 1).val();

      } else {
        var cat_id = $('.catagory').eq(len - 2).val();
      }
      $("#cat_id").val(cat_id);

      var main_cat_val = $('#main_cat').val();
      console.log(main_cat_val);
      if(main_cat_val == -1){
        $('#main_cata-error').show();
      }else{
        $("#product_data").submit();
      }


      // console.log($("#product_data").serialize());
      // $.ajax({
      //   url: "add_product_ajax.php",
      //   type: "POST",
      //   data: $("#product_data").serialize(),
      //   success: function(res) {
      //     alert("Successfully added");
      //     // location.reload();
      //   },
      // });

    }
  });

  // $("#main_cat").rules("add" , {
  //   notEqualValue:'-1',
  // })

  // by simple method

  // $(document).on('click', '.submit', function() {
  //   var len = $('.catagory').length;
  //   var cat_type = $('input[name="cat_type"]:checked').val();

  //   if (cat_type == 1) {
  //     var cat_id = 0;
  //   } else {
  //     if ($('.catagory').eq(len - 1).val() != -1) {
  //       var cat_id = $('.catagory').eq(len - 1).val();

  //     } else {
  //       var cat_id = $('.catagory').eq(len - 2).val();
  //     }
  //   }
  //   $("#cat_id").val(cat_id);
  //   // var cat_name = $('#cat_name').val();
  //   var formData = $('#product_data').serialize();
  //   console.log(typeof(formData));
  //   $.ajax({
  //     type: 'post',
  //     url: 'add_product_ajax.php',
  //     data: formData,
  //     success: function(res) {
  //       console.log(res);
  //     }
  //   })
  // })
</script>