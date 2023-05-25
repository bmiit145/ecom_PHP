<?php
include "header.php";
?>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'priyank_ecom');

$qry = "select * from catagory";
$run = mysqli_query($connection, $qry);
$res = mysqli_num_rows($run);

?>

<div class="content-wrapper">
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Parent Catagory</th>
                <th scope="col" style="min-width: 150px; <?php if ($role == 0) { ?> display:none <?php } ?> ">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center; <?php if ($res != 0) {
                                            ?>display:none; <?php } ?>">
                <td colspan="4">
                    No Data Found
                </td>
            </tr>
            <?php foreach ($run as $k => $user) { ?>
                <tr>
                    <th scope="row"><?php echo ++$k; ?></th>
                    <td><?php echo $user['name'] ?></td>
                    <td>
                        <?php if ($user['cat_id'] != 0) {
                            $qry  = "select name from catagory where id = $user[cat_id]";
                            $data = mysqli_query($connection, $qry);
                            $cat = mysqli_fetch_assoc($data);
                            echo $cat['name'];
                        } else {
                            echo "Main Catagory";
                        }
                        ?>
                    </td>
                    <td><button class="btn btn-sm btn-outline-primary">Edit</button>&nbsp;&nbsp;
                        <button class="btn btn-sm btn-outline-danger del_btn" data-cat_id="<?php echo $user['id']?>" >Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include "footer.php";
?>

<script>
    $(document).on('click', '.del_btn', function() {
        id = $(this).data('cat_id');
         $(this).parents('tr').addClass('del_tr');
        $.ajax({
            type:'post',
            url:'del_cat_ajax.php',
            data:{
                cat_id:id
            },
            success:function(res){

                if (res != 0) {
                    $(document).find('.del_tr').removeClass('del_tr');
                    if (res == 1) {
                        alert("Catagory is given to another pata catagory and products ");
                    } else if(res == 2) {
                        alert("Catagory has given to the Another catagory");
                    }else if(res == 3){
                        alert("catagory has givem to the Product");
                    }
                }else{
                    alert("Deleted Successfully");
                    $(document).find('.del_tr').hide();
                }
            }

        })
    })
</script>