<?php 
session_start();

if(empty($_SESSION['login'])){
	header('location:login');
}
require 'connection.php';
require 'functions.php';
require 'config.php';
require 'razorpay-php/Razorpay.php';


// var_dump($_SESSION['cart']); echo "<br>";

// var_dump($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from softali.net/victor/wookie/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 05:58:45 GMT -->
<head>
		<meta charset="utf-8">
	<title>Shopping Cart </title>
	<meta name="keywords" content="HTML5 Template">
	<meta name="description" content="Wokiee - Responsive HTML5 Template">
	<meta name="author" content="wokiee">
	<link rel="shortcut icon" href="favicon.ico">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<!-- Slick  cdn -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/style.css">
	<!-- Styles for SLick Carosal -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">

	<!--Jquery validation must use this -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<!-- Sweet alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script src="javascript/some2.js"></script>

	<style>
		.tt-shopcart-table-02 .tt-btn-close:before {
			content: "\ea21";
			color: aliceblue;
		}
		.error-message{
			color: red;
		}

	</style>
	
</head>
<body>

<div id="loader-wrapper">
	<div id="loader">
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
	</div>
</div>
<!-- header -->
<?php include 'majors/header.php' ?>

<!-- main Content of the page -->

<div id="tt-pageContent">
	<?php if(!empty($_SESSION['cart'])) { ?>
		<div class="container-indent">
			<div class="container">
				<h1 class="tt-title-subpages noborder">SHOPPING CART</h1>
				
				<div class="tt-shopcart-table-02">
					<table id ="cart">
						<thead>
							<tr>
								<th style="text-align: center;">Preview</th>
								<th>Name Of the Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th style="float: right;">Final Price</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<!-- To shoow all the products in the cart -->
							<?php 
								$total = 0;
								foreach ($_SESSION['cart'] as $item) {
									$product = viewproduct($item['id']); //function che baka
									$subtotal = $product['finalprice'] * $item['quantity'];
									$total += $subtotal;
							?>

								<tr>
									<td>
										<div class="tt-product-img">
											<?= img($product['image']) ?>
										</div>
									</td>

									<td>
										<h2 class="tt-title">
											<a href="product_view?slug=<?php echo $product['slug']; ?>&productid=<?php echo $product['id']; ?>"><?= $product['name'] ?></a>
										</h2>

										<!-- <ul class="tt-list-description">
											<li>Size: 22</li>
											<li>Color: Green</li>
										</ul>

										<ul class="tt-list-parameters">
											<li>
												<div class="tt-price">
													$124
												</div>
											</li>
											<li>
												<div class="detach-quantity-mobile"></div>
											</li>
											<li>
												<div class="tt-price subtotal">
													$124
												</div>
											</li>
										</ul> -->
									</td>

									<td>
										<div class="tt-price">
											<?=  $product['finalprice'] ?>
										</div>
									</td>

									<td>
										<div class="detach-quantity-desctope">
											<div class="tt-input-counter style-01">
												<span class="minus-btn" data-id = "<?= $product['id'] ?>" onclick="cartminus(this);" ></span>
												<input type="text" id="quantity" value="<?= $item['quantity'] ?>" size="400">
												<span class="plus-btn" data-id = "<?= $product['id'] ?>" onclick = "cartplus(this);"></span>
											</div>
										</div>
									</td>

									<td>
										<div class="tt-price subtotal">
											<?= $subtotal ?>
										</div>
									</td>
									<td>
										<button type="button" class="tt-btn-close remove btn btn-outline-info" data-id="<?php echo $product['id']; ?>"></button>
									</td>
								</tr>
							
							<?php } ?>
						</tbody>
					</table>

					<div class="tt-shopcart-btn d-flex ali justify-content-around">
						<div class="">
							<a class="btn-link" href="index"><i class="icon-e-19"></i>CONTINUE SHOPPING</a>
						</div>
						
						<div>
							<form id="coupon" class="m-0">
								<label for="coupon_code">Enter your coupon code:</label>
								<input type="text" id="coupon_code" name="coupon_code" >
								<input type="submit" id="coupon_button" value="Apply Coupon">
							</form>
						</div>

						<div class="">
							<a class="btn-link" href="clearcart"><i class="icon-h-02"></i>CLEAR SHOPPING CART</a>
							<a class="btn-link" href="shoppingcart"><i class="icon-h-48"></i>UPDATE CART</a>
						</div>
					</div>
				</div>

				<div class="tt-shopcart-col">
					<div class="row">
						<!-- extra charges -->
						<div class="col-md-6 col-lg-4">
							<div class="tt-shopcart-box">
								<h4 class="tt-title">
									ESTIMATE SHIPPING AND TAX
								</h4>
								<p>Enter your destination to get a shipping estimate.</p>
								<form class="form-default">
									<div class="form-group">
										<label for="address_country">COUNTRY <sup>*</sup></label>
										<select id="address_country" class="form-control">
											<option>Austria</option>
											<option>Belgium</option>
											<option>Cyprus</option>
											<option>Croatia</option>
											<option>Czech Republic</option>
											<option>Denmark</option>
											<option>Finland</option>
											<option>France</option>
											<option>Germany</option>
											<option>Greece</option>
											<option>Hungary</option>
											<option>Ireland</option>
											<option>France</option>
											<option>Italy</option>
											<option>Luxembourg</option>
											<option>Netherlands</option>
											<option>Poland</option>
											<option>Portugal</option>
											<option>Slovakia</option>
											<option>Slovenia</option>
											<option>Spain</option>
											<option>United Kingdom</option>
										</select>
									</div>
									<div class="form-group">
										<label for="address_province">STATE/PROVINCE <sup>*</sup></label>
										<select id="address_province" class="form-control">
											<option>State/Province</option>
										</select>
									</div>
									<div class="form-group">
										<label for="address_zip">ZIP/POSTAL CODE <sup>*</sup></label>
										<input type="text" name="name" class="form-control" id="address_zip" placeholder="Zip/Postal Code">
									</div>
									<a href="#" class="btn btn-border">CALCULATE SHIPPING</a>
									<p>
										There is one shipping rate available for Alabama, Tanzania, United Republic Of.
									</p>
									<ul class="tt-list-dot list-dot-large">
										<li><a href="#">International Shipping at $20.00</a></li>
									</ul>
								</form>
							</div>
						</div>

						<!-- note -->
						<div class="col-md-6 col-lg-4">
							<div class="tt-shopcart-box">
								<h4 class="tt-title">
									NOTE
								</h4>
								<p>Add special instructions for your order...</p>
								<form class="form-default">
									<textarea class="form-control" rows="7"></textarea>
								</form>
							</div>
						</div>
						
						<!-- Grand Price -->
						<div class="col-md-6 col-lg-4">
							<div class="tt-shopcart-box tt-boredr-large">
								<table class="tt-shopcart-table01">
									<tbody>
										<tr>
											<th>SUBTOTAL</th>
											<td id="myTD">$<?= $total ?></td>
										</tr>
									</tbody>
									<!-- <tfoot>
										<tr>
											<th>GRAND TOTAL</th>
											<td>$324</td>
										</tr>
									</tfoot> -->
								</table>
								<a href="#" class="btn btn-lg checkout" id="rzp-button1" ><span class="icon icon-check_circle"></span>PROCEED TO CHECKOUT</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<div class="container-indent">
		<div class="container-indent nomargin">
		<div class="tt-empty-cart">
			<span class="tt-icon icon-f-39"></span>
			<h1 class="tt-title">SHOPPING CART IS EMPTY</h1>
			<p>You have no items in your shopping cart.</p>
			<a href="index" class="btn">CONTINUE SHOPPING</a>
		</div>
	</div>
		</div>
	<?php } ?>
</div>



<!-- FOOTER -->
<?php include 'majors/footer.php' ?>

<script>

	$(document).ready(function() {
		$('button.remove').click(function() {
			var id = $(this).data('id');
			$.ajax({
			type: 'POST',
			url: 'query.php',
			data: {data: id, action: 'remove'},
			success: function(response) {
				if (response.success == 200	) {
					$('#cart').load('shoppingcart #cart');
				}
			}
			});
		});

		$('.checkout').click(function(e) {
			e.preventDefault();
			
			// var customerid = $_SESSION['id'];
			var email = "<?php echo  $_SESSION['email']; ?>";
			var name = "<?php echo  $_SESSION['user_name'] ; ?>";
			var phoneno = "<?php echo  $_SESSION['phoneno']; ?>";


			var tdText = document.getElementById("myTD").textContent;
			var amount = parseFloat(tdText.replace("$", ""));
			
			console.log("checkout button clicked");
			$.ajax({
				type: 'POST',
				url: 'pay.php',
				data: { amount: amount},
				success: function(response){
					if(response.order == 200){
						var orderid = response.orderid;	

						var options = {
							"key": 'rzp_test_NQYzbHYamBj4OU', 
							"amount": amount * 100, 
							"currency": "INR",
							"name": "Workiee",
							"description": "Test Transaction",
							"image": "images/images.jpg",
							"order_id": orderid, 
							// "redirect": true,
							"callback_url": "payment_sucess" ,
							// "handler": function (response){
							// 	jQuery.ajax({
							// 		type: 'post',
							// 		url: 'payment_sucess.php',
							// 		data: {payment_id: response.razorpay_payment_id, orderid: response.razorpay_order_id, signatureid: response.razorpay_signature },
							// 		success: function(result){
							// 			window.location.href("payment_sucess");

							// 		}
							// 	});
							
							// },
							"prefill": {
								"name": name,
								"email": email,
								"contact": phoneno
							},
							"notes": {
								"address": "Razorpay Corporate Office"
							},
							"theme": {
								"color": "#3399cc"
							}
						};
						
						var rzp1 = new Razorpay(options);
						rzp1.on('payment.failed', function (response){
							// Swal.fire({
							// icon: 'error',
							// text: response.error.description,
							// })
							// alert(response.error.code);
							// alert();
							// alert(response.error.source);
							// alert(response.error.step);
							// alert(response.error.reason);
							// alert(response.error.metadata.order_id);
							// alert(response.error.metadata.payment_id);
						});
						rzp1.open();
						e.preventDefault();
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log("Error: " + jqXHR.status);
				}
			});
		});

		$('#coupon').submit(function(e){
			e.preventDefault();
			// $("#coupon").validate({
			// 	errorClass: "error-message",
			// 	rules:{
			// 		coupon_code: "required",
			// 	},
			// 	messages:{
			// 		coupon_code: " *First Apply The CODE",
			// 	}
			// });
			// var val = $("#coupon").valid();
			// if(val){
				var couponCode = $('#coupon_code').val();
				var tdText = document.getElementById("myTD").textContent;
				var amount = parseFloat(tdText.replace("$", ""));

				$.ajax({
					type: "POST",
					url: "query.php",
					datatype: 'json',
					data: {data: couponCode, action:"coupon", amount: amount},
					success: function(response){
						if(response.code == 200){
							Swal.fire({
								icon: "success",
								position: 'bottom',
                    			toast: true,
								text: "Sucessfully applied the Coupon",
								timer: 2000,
								showConfirmButton: false
                        	})

							var final_price = parseFloat(response.final_price);
							var td = document.getElementById("myTD");
							td.innerHTML = "$" + final_price.toFixed(2);

							var submitBtn = document.getElementById("coupon_button");
							var code = document.getElementById("coupon_code");
							submitBtn.disabled = true;
							code.disabled = true;
						}else if(response.code == 400){
							Swal.fire({
								icon: "error",
								position: 'bottom',
                    			toast: true,
								text: "Invalid Coupon Code or This Code has Expired",
								timer: 2000,
								showConfirmButton: false
                        	})
						}else if(response.coupon == 400){
							Swal.fire({
								icon: "error",
								position: 'bottom',
                    			toast: true,
								text: "First enter a code",
								timer: 2000,
								showConfirmButton: false
                        	})
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log("Error: " + jqXHR.status);
					}
				});
			// }
		});
		
		
	

	});
	// });


</script>


<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')</script>
<script defer src="js/bundle.js"></script>
<a href="#" class="tt-back-to-top" id="js-back-to-top">BACK TO TOP</a>
</body>

<!-- Mirrored from softali.net/victor/wookie/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 05:58:45 GMT -->
</html>
