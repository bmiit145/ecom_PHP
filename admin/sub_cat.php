<?php
$connection = mysqli_connect("localhost", "root", "", "priyank_ecom");
$cat_id =  $_POST['cat_id'];
$num = 0; 
$qry = "select * from catagory where cat_id = $cat_id";
$catagory = mysqli_query($connection, $qry);
$num  = mysqli_num_rows($catagory);

if ($num != 0) { ?>
  <div class="sub-cat">
    <br>
    <br>
    <label for="sub_catagory_<?php echo $cat_id ?>">Sub Catagory</label>
    <select class="form-control catagory" id="sub_cat_<?php echo $cat_id ?>" name="catagory">
      <option value="-1" selected>select</option>
      <?php foreach ($catagory as $key => $user) { ?>
        <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
      <?php } ?>
    </select>
  </div>
<?php
}
?>