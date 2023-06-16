<?php 
session_start();

if(empty($_SESSION['login'])){
	header('location:login');
}

if(!isset($_POST)){
    header('location:index');
}
require 'connection.php';
require 'functions.php';
// var_dump($_SESSION['cart']); echo "<br>";

// var_dump($_SESSION);
if($_POST['razorpay_payment_id'] && $_POST['razorpay_order_id'] && $_POST['razorpay_signature']){
    $paymentid = $_POST['razorpay_payment_id'];
    $orderid = $_POST['razorpay_order_id'];
    $signatureid = $_POST['razorpay_signature'];
    $id = $_SESSION['id'];
    $address =  $_SESSION['address'];
	$cart = $_SESSION['cart'];

	//mini process to obtain the order/ product_id
	$order = implode(", ", array_map(function($item){
		return $item['id'];
	}, $cart));

	//mini process to obtain the Quantity
	$quantity = implode(", ", array_map(function($item){
		return $item['quantity'];
	}, $cart));
	
	
	//can find this Class in function.php 
	$update_inventory = new products(); 
	$update_inventory -> update_quantity($order, $quantity);


	//can be found in function.php
    $add = new orders(); 
    $add -> addtodatabase($id, $orderid, $order, $quantity, $paymentid, $signatureid);

    unset($_SESSION['cart']);
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from softali.net/victor/wookie/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 05:58:45 GMT -->
<head>
		<meta charset="utf-8">
	<title>Payment Successfull</title>
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

	
	<!-- Sweet alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script src="javascript/some2.js"></script>

	<style>
		.tt-shopcart-table-02 .tt-btn-close:before {
			content: "\ea21";
			color: aliceblue;
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
	<div class="container-indent">
		<div class="container">
			<h1 class="tt-title-subpages noborder">YOUR ORDER HAS BEEN CONFIRMED</h1>
			<div class="tt-login-form">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="tt-item">
							<H5>Order Details</H5>
							<div class="row">
                                
                                <div class="form-group col-12 ">
                                    <h5 class="p-0"> Order ID:-</h5>
                                    <h6><?= $orderid  ?></h6>
                                </div>
                                <div class="form-group col-12 ">
                                    <h5 class="p-0"> Payment ID:-</h5>
                                    <h6><?= $paymentid  ?></h6>
                                </div>
                                <div class="form-group col-12 ">
                                    <h5 class="p-0"> Shipping Address-</h5>
                                    <h6><?= $address  ?></h6>
                                </div>


                                <a class="btn mx-auto col-3" href="index">Back to Homepage</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- FOOTER -->
<?php include 'majors/footer.php' ?>

<script>


</script>


<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')</script>
<script defer src="js/bundle.js"></script>
<a href="#" class="tt-back-to-top" id="js-back-to-top">BACK TO TOP</a>
</body>

<!-- Mirrored from softali.net/victor/wookie/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 05:58:45 GMT -->
</html>
