<?php
include "header.php";
?>
<?php
// array_push($_SESSION['add_cart'],'554');
// array_push($_SESSION['add_cart'],'565');

if (isset($_SESSION['add_cart'])) {
	// print_r($_SESSION['add_cart']);
	$data = $_SESSION['add_cart'];
	// print_r($data);
}
?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
	<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
		<h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
		<div class="d-inline-flex">
			<p class="m-0"><a href="index.php">Home</a></p>
			<p class="m-0 px-2">-</p>
			<p class="m-0">Shopping Cart</p>
		</div>
	</div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
	<div class="row px-xl-5">
		<div class="col-lg-8 table-responsive mb-5">
			<table class="table table-bordered text-center mb-0">
				<thead class="bg-secondary text-dark">
					<tr>
						<th>Products</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>Remove</th>
					</tr>
				</thead>
				<?php if (isset($_SESSION['add_cart'])) { ?>
					<tbody class="align-middle">
						<?php
						foreach ($data as $key => $prod) {
							$prod_data_id = $prod['prod_id'];
							// echo $prod_data_id;
							$qry = "select * from product_master where id = '$prod_data_id'";
							$prod_run = mysqli_query($connection, $qry);
							$prod_data = mysqli_fetch_assoc($prod_run);
							// print_r($prod_data['name']);
						?>
							<tr class="product_cart" data-value="<?php echo  $prod_data['price'] ?>" data-prod_id="<?php echo $prod_data['id'] ?>">
								<td class="align-middle"><img src="img/<?php echo $prod_data['image'] ?>" alt="" style="width: 50px;"><?php echo  $prod_data['name'] ?></td>
								<td class="align-middle p_price">$<?php echo  $prod_data['price'] ?></td>
								<td class="align-middle">
									<div class="input-group quantity mx-auto" style="width: 100px;">
										<div class="input-group-btn">
											<button class="btn btn-sm btn-primary btn-minus qun_val_btn">
												<i class="fa fa-minus"></i>
											</button>
										</div>
										<input type="text" class="form-control form-control-sm bg-secondary text-center quantity_val" value="<?php echo $data[$key]['qan'] ?>">
										<div class="input-group-btn">
											<button class="btn btn-sm btn-primary btn-plus qun_val_btn">
												<i class="fa fa-plus"></i>
											</button>
										</div>
									</div>
								</td>
								<td class="align-middle each-total">$<?php echo  $prod_data['price'] ?></td>
								<td class="align-middle"><button class="btn btn-sm btn-primary" onclick="del_cart_prod(<?php echo $prod_data['id'] ?>)"><i class="fa fa-times"></i></button></td>
							</tr>
						<?php } ?>
					</tbody>
				<?php }
				if ($_SESSION['cart_num'] == 0) { ?>
					<tbody class="align-middle">
						<tr>
							<td colspan="5">No data Found!</td>
						</tr>
						<tr>
							<td colspan="5"><a href="index.php">Continue Shopping</a></td>
						</tr>
					</tbody>
				<?php } ?>
			</table>
		</div>
		<div class="col-lg-4">
			<form class="mb-5" action="">
				<div class="input-group">
					<input type="text" class="form-control p-4" placeholder="Coupon Code">
					<div class="input-group-append">
						<button class="btn btn-primary">Apply Coupon</button>
					</div>
				</div>
			</form>
			<div class="card border-secondary mb-5">
				<div class="card-header bg-secondary border-0">
					<h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
				</div>
				<div class="card-body">
					<div class="d-flex justify-content-between mb-3 pt-1">
						<h6 class="font-weight-medium ">Subtotal</h6>
						<h6 class="font-weight-medium sub_total"></h6>
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
					<a  href="checkout.php" class="btn btn-block btn-primary my-3 py-3 btn-checkout p_check">Proceed To Checkout</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Cart End -->

<?php
include "footer.php";
?>

<script>
	$(document).ready(function() {

		var qun_text = $(document).find('.quantity_val');
		for (let i = 0; i < qun_text.length; i++) {
			qun_val(qun_text.eq(i));
		}

		sub_total(shipp);

	})

	$(document).on('change', '.quantity_val', function() {
		qun_val(this);
		update_qun(this);
		sub_total(shipp);
	})
	$(document).on('click', '.qun_val_btn', function() {
		qun_val(this);
		update_qun(this);
		sub_total(shipp);

	})

	function update_qun(par) {
		let prod_id = $(par).parents('tr').data('prod_id');
		let qun = $(par).parents('td').children().children('.quantity_val').val();

		$.ajax({
			type: 'post',
			url: 'update_cart_qun_ajax.php',
			data: {
				id: prod_id,
				qun: qun
			},
			success: function(res) {}

		})
	}

	function qun_val(par) {
		// value = $(par).parents('td').siblings('.p_price').text().substring(1);
		let value = $(par).parents('tr').data('value');
		let quantity = $(par).parents('td').children().children('.quantity_val').val()
		if (quantity == 0) {
			let prod_id = $(par).parents('tr').data('prod_id');
			// console.log(prod_id);
			del_cart_prod(prod_id);
			return;
		}
		let total = $(par).parents('td').siblings('.each-total').text('$' + (value * quantity));
	}


	function del_cart_prod(id) {
		var tr_row = $(document).find('tr[data-prod_id=' + id + ']');
		// console.log(tr_row);
		$.ajax({
			type: 'post',
			url: "del_prod_cart.php",
			data: {
				id: id
			},
			success: function(res) {
				// console.log(tr_row);
				console.log(res);
				tr_row.remove();
				$(document).find('.cart_num').text(res);
				sub_total(shipp)
			}
		})
	}

	// $('.p_check').click(function(){
	// 	window.localStorage.setItem('status', '1');
	// })
</script>