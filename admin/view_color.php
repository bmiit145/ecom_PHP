<?php
include "header.php";
?>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'priyank_ecom');

$qry = "select * from color";
$run = mysqli_query($connection, $qry);
$res = mysqli_num_rows($run);

?>

<div class="content-wrapper">
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Color Name</th>
                <th scope="col" style="min-width: 150px; <?php if ($role == 0) { ?> display:none <?php } ?> ">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center; <?php if ($res != 0) {
                                            ?>display:none; <?php } ?>">
                <td colspan="3">
                    No Data Found
                </td>
            </tr>
            <?php foreach ($run as $k => $user) { ?>
                <tr>
                    <th scope="row"><?php echo ++$k; ?></th>
                    <td><?php echo $user['color_name'] ?></td>
                    <td><button class="btn btn-sm btn-outline-primary">Edit</button>&nbsp;&nbsp;
                        <button class="btn btn-sm btn-outline-danger del_btn" data-color_id="<?php echo $user['color_id']?>" >Delete</button>
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
        id = $(this).data('color_id');
         $(this).parents('tr').addClass('del_tr');
        $.ajax({
            type:'post',
            url:'del_color_ajax.php',
            data:{
                color_id:id
            },
            success:function(res){

                if (res == 0) {
                    alert("Deleted Successfully");
                    $(document).find('.del_tr').hide();
                }else{
                    alert("Not Deleted ");
                    $(document).find('.del_tr').removeClass('del_tr');
                }
            }

        })
    })
</script>