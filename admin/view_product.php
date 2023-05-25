<?php
include "header.php";
?>
<?php
$connection = mysqli_connect("localhost", "root", "", "priyank_ecom");
$qry = "select * from product_master";
$run = mysqli_query($connection, $qry);
$res = mysqli_num_rows($run);
?>
<div class="content-wrapper table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Description 2</th>
                <th scope="col">Catagory</th>
                <th scope="col">color</th>
                <th scope="col">Price</th>
                <th scope="col">MRP</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
                <th scope="col" style="min-width: 150px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center; <?php if ($res != 0) {
                                            ?>display:none; <?php } ?>">
                <td colspan="10">
                    No Data Found
                </td>
            </tr>
            <?php foreach ($run as $k => $user) { ?>
                <tr>
                    <th scope="row"><?php echo ++$k; ?></th>
                    <td> <?php if ($user['image'] != '') { ?>
                            <img src=<?php echo "../img/" . $user['image'] ?> height="50px" width="50px">
                        <?php } ?>
                    </td>
                    <td><?php echo $user['name'] ?></td>
                    <td class="desc_1"><?php $desc_1 = $user['description'];
                                        echo substr_replace("$desc_1", "", 9); ?><a href="#"  id="desc_1_link" class="desc_1_link">Read more</a></td>

                    <!-- Modal -->

                    <td><?php echo $user['desc_2'] ?></td>
                    <td><?php $cat_id = $user['cat_id'];
                        $qry = "select * from catagory where id = $cat_id ";
                        $data = mysqli_fetch_assoc(mysqli_query($connection, $qry));
                        echo $data['name'];
                        ?></td>
                    <td><?php $color_id = $user['color_id'];
                        $qry = "select * from color where color_id = $color_id ";
                        $data = mysqli_fetch_assoc(mysqli_query($connection, $qry));
                        echo $data['color_name'];
                        ?></td>
                    <td><?php echo $user['price'] ?></td>
                    <td><?php echo $user['MRP'] ?></td>
                    <td><?php echo $user['quantity'] ?></td>
                    <td>
                        <?php if ($user['status']  == 1) { ?>
                            <div class="badge badge-pill badge-success">Active</div>
                        <?php } else { ?>
                            <div class="badge badge-pill badge-danger">Inactive</div>
                        <?php } ?>
                    </td>
                    <td><button class="btn btn-sm btn-outline-primary">Edit</button>&nbsp;<?php if ($user['status']  == 0) { ?><a href="act_btn.php?act_btn=1&id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-success act_btn" id="active_btn">Active</a><?php } else { ?><a href="act_btn.php?act_btn=0&id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-danger act_btn" id="inactive_btn">Inactive</a><?php } ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- description modal -->


<!-- Trigger/Open The Modal -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("desc_1_link");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


<?php
include "footer.php";
?>