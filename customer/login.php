<?php
session_start();
require 'connection.php';
$error_email = "";
$error_pass = "";
$not_found = "";

if(!empty($_SESSION['login'])){
    header('location:index');
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from softali.net/victor/wookie/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:32:11 GMT -->
<head>
		<meta charset="utf-8">
	<title>Wokiee - Responsive HTML5 Template</title>
	<meta name="keywords" content="HTML5 Template">
	<meta name="description" content="Wokiee - Responsive HTML5 Template">
	<meta name="author" content="wokiee">
	<link rel="shortcut icon" href="favicon.ico">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/style.css">
    <!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- jquery validation -->
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- Sweet alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


   

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
<?php require 'majors/header.php' ?>
<div class="tt-breadcrumb">
	<div class="container">
		<ul>
			<li><a href="index">Home</a></li>
			<li>Login</li>
		</ul>
	</div>
</div>
<div id="tt-pageContent">
	<div class="container-indent">
		<div class="container">
			<h1 class="tt-title-subpages noborder">ALREADY REGISTERED?</h1>
			<div class="tt-login-form">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div class="tt-item">
							<h2 class="tt-title">NEW CUSTOMER</h2>
							<p>
								By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.
							</p>
							<div class="form-group">
								<a href="registeration" class="btn btn-top btn-border">CREATE AN ACCOUNT</a>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="tt-item">
							<h2 class="tt-title">LOGIN</h2>
							If you have an account with us, please log in.
							<div class="form-default form-top">
								<form id="customer_login" method="POST">
									<div class="form-group">
										<label for="name">USERNAME OR E-MAIL *</label>
										<div class="tt-required">
                                            <?php if($error_email == true){
                                                echo ' <span style ="color:red">* Required Fields</span>';
                                             }else if($error_email ==true && $error_pass == true){
                                                echo '<span style ="color:red">* Required Fields</span>';
                                            }
                                            ?>
                                        </div>
										<input type="email" name="name" class="form-control" id="name" placeholder="Enter Username or E-mail">
									</div>
									<div class="form-group">
										<label for="password">PASSWORD *</label>
                                        <div class="tt-required">
                                            <?php if($error_pass == true){
                                                echo '<span style="color:red">* Required Fields</span>';
                                            }else if($error_email==true && $error_pass==true){
                                                echo '<span style="color:red">* Required Fields</span>';
                                            }
                                            ?>
                                        </div>
										<input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
									</div>
									<div class="row">
										<div class="col-auto mr-auto">
											<div class="form-group">
												<button class="btn btn-border" type="submit" id="login">LOGIN</button>
											</div>
										</div>
										<div class="col-auto align-self-end">
											<div class="form-group">
												<ul class="additional-links">
													<li><a href="#">Lost your password?</a></li>
												</ul>
											</div>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require 'majors/footer.php' ?>

<!-- modal (AddToCartProduct) -->
<div class="modal  fade"  id="modalAddToCartProduct" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
			</div>
			<div class="modal-body">
				<div class="tt-modal-addtocart mobile">
					<div class="tt-modal-messages">
						<i class="icon-f-68"></i> Added to cart successfully!
					</div>
					<a href="#" class="btn-link btn-close-popup">CONTINUE SHOPPING</a>
			        <a href="shopping_cart_02.html" class="btn-link">VIEW CART</a>
			        <a href="page404.html" class="btn-link">PROCEED TO CHECKOUT</a>
				</div>
				<div class="tt-modal-addtocart desctope">
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="tt-modal-messages">
								<i class="icon-f-68"></i> Added to cart successfully!
							</div>
							<div class="tt-modal-product">
								<div class="tt-img">
									<img src="images/loader.svg" data-src="images/product/product-01.jpg" alt="">
								</div>
								<h2 class="tt-title"><a href="product.html">Flared Shift Dress</a></h2>
								<div class="tt-qty">
									QTY: <span>1</span>
								</div>
							</div>
							<div class="tt-product-total">
								<div class="tt-total">
									TOTAL: <span class="tt-price">$324</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<a href="#" class="tt-cart-total">
								There are 1 items in your cart
								<div class="tt-total">
									TOTAL: <span class="tt-price">$324</span>
								</div>
							</a>
							<a href="#" class="btn btn-border btn-close-popup">CONTINUE SHOPPING</a>
							<a href="shopping_cart_02.html" class="btn btn-border">VIEW CART</a>
							<a href="#" class="btn">PROCEED TO CHECKOUT</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- modal (quickViewModal) -->
<div class="modal  fade"  id="ModalquickView" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
			</div>
			<div class="modal-body">
				<div class="tt-modal-quickview desctope">
					<div class="row">
						<div class="col-12 col-md-5 col-lg-6">
							<div class="tt-mobile-product-slider arrow-location-center">
								<div><img src="#" data-lazy="images/product/product-01.jpg" alt=""></div>
								<div><img src="#" data-lazy="images/product/product-01-02.jpg" alt=""></div>
								<div><img src="#" data-lazy="images/product/product-01-03.jpg" alt=""></div>
								<div><img src="#" data-lazy="images/product/product-01-04.jpg" alt=""></div>
								<!--
								//video insertion template
								<div>
									<div class="tt-video-block">
										<a href="#" class="link-video"></a>
										<video class="movie" src="video/video.mp4" poster="video/video_img.jpg"></video>
									</div>
								</div> -->
							</div>
						</div>
						<div class="col-12 col-md-7 col-lg-6">
							<div class="tt-product-single-info">
								<div class="tt-add-info">
									<ul>
										<li><span>SKU:</span> 001</li>
										<li><span>Availability:</span> 40 in Stock</li>
									</ul>
								</div>
								<h2 class="tt-title">Cotton Blend Fleece Hoodie</h2>
								<div class="tt-price">
									<span class="new-price">$29</span>
									<span class="old-price"></span>
								</div>
								<div class="tt-review">
									<div class="tt-rating">
										<i class="icon-star"></i>
										<i class="icon-star"></i>
										<i class="icon-star"></i>
										<i class="icon-star-half"></i>
										<i class="icon-star-empty"></i>
									</div>
									<a href="#">(1 Customer Review)</a>
								</div>
								<div class="tt-wrapper">
									Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
								</div>
								<div class="tt-swatches-container">
									<div class="tt-wrapper">
										<div class="tt-title-options">SIZE</div>
										<form class="form-default">
											<div class="form-group">
												<select class="form-control">
													<option>21</option>
													<option>25</option>
													<option>36</option>
												</select>
											</div>
										</form>
									</div>
									<div class="tt-wrapper">
										<div class="tt-title-options">COLOR</div>
										<form class="form-default">
											<div class="form-group">
												<select class="form-control">
													<option>Red</option>
													<option>Green</option>
													<option>Brown</option>
												</select>
											</div>
										</form>
									</div>
									<div class="tt-wrapper">
										<div class="tt-title-options">TEXTURE:</div>
										<ul class="tt-options-swatch options-large">
											<li><a class="options-color" href="#">
												<span class="swatch-img">
													<img src="images/loader.svg" data-src="images/custom/texture-img-01.jpg" alt="">
												</span>
												<span class="swatch-label color-black"></span>
											</a></li>
											<li class="active"><a class="options-color" href="#">
												<span class="swatch-img">
													<img src="images/loader.svg" data-src="images/custom/texture-img-02.jpg" alt="">
												</span>
												<span class="swatch-label color-black"></span>
											</a></li>
											<li><a class="options-color" href="#">
												<span class="swatch-img">
													<img src="images/loader.svg" data-src="images/custom/texture-img-03.jpg" alt="">
												</span>
												<span class="swatch-label color-black"></span>
											</a></li>
											<li><a class="options-color" href="#">
												<span class="swatch-img">
													<img src="images/loader.svg" data-src="images/custom/texture-img-04.jpg" alt="">
												</span>
												<span class="swatch-label color-black"></span>
											</a></li>
											<li><a class="options-color" href="#">
												<span class="swatch-img">
													<img src="images/loader.svg" data-src="images/custom/texture-img-05.jpg" alt="">
												</span>
												<span class="swatch-label color-black"></span>
											</a></li>
										</ul>
									</div>
								</div>
								<div class="tt-wrapper">
									<div class="tt-row-custom-01">
										<div class="col-item">
											<div class="tt-input-counter style-01">
												<span class="minus-btn"></span>
												<input type="text" value="1" size="5">
												<span class="plus-btn"></span>
											</div>
										</div>
										<div class="col-item">
											<a href="#" class="btn btn-lg"><i class="icon-f-39"></i>ADD TO CART</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- modalVideoProduct -->
<div class="modal fade"  id="modalVideoProduct" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-video">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
			</div>
			<div class="modal-body">
				<div class="modal-video-content">

				</div>
			</div>
		</div>
	</div>
</div>
<!-- modal (ModalSubsribeGood) -->
<div class="modal  fade"  id="ModalSubsribeGood" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
			</div>
			<div class="modal-body">
				<div class="tt-modal-subsribe-good">
					<i class="icon-f-68"></i> You have successfully signed!
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal (newsletter) -->
<!-- <div class="modal  fade"  id="Modalnewsletter" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true"  data-pause=2000>
	<div class="modal-dialog modal-sm">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
			</div>
			<form>
				<div class="modal-body no-background">
					<div class="tt-modal-newsletter">
						<div class="tt-modal-newsletter-promo">
							<div class="tt-title-small">BE THE FIRST<br> TO KNOW ABOUT</div>
							<div class="tt-title-large">WOKIEE</div>
							<p>
								HTML FASHION DROPSHIPPING THEME
							</p>
						</div>
						<p>
							By subscribe, you accept the terms &amp; privacy policy<br>
						</p>
						<div class="subscribe-form form-default">
							<div class="row-subscibe">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Enter your e-mail">
									<button type="submit" class="btn">JOIN US</button>
								</div>
							</div>
							<div class="checkbox-group">
								<input type="checkbox" id="checkBox1">
								<label for="checkBox1">
									<span class="check"></span>
									<span class="box"></span>
									Don’t Show This Popup Again
								</label>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div> -->

<script>
	$(document).on('click', '#login', function(e){
			e.preventDefault();
			/*$("#customer_login").validate({
			rules:{
				name: "required",
				password: "required"
			},
			messages:{
				name: "email cannot be empty",
				password: "Password cannot be empty"
			}
			});

		 var val = $("#customer_login").valid();*/
		//  console.log(val);
			//if(val){
				 var data1 = $("#customer_login").serialize();
				 var find = new Customer();
				 var data = find.find(data1);
				 
				 $.ajax({
					 type: 'post',
					 url: 'query.php',
					 data: data,
					 datatype: 'json',

					 success: function(response){
						 if(response.success == 200){
							 Swal.fire({
								  icon: 'success',
								  title: 'Success',
								  text: 'Welcome',
								  showCancelButton: false,
								  confirmButtonColor: '#3085d6',
								  confirmButtonText: 'Let"s go shopping'
							  }).then((result) => {
								if (result.isConfirmed) {
								 window.location.href = 'index';
								}
							 })
						 }else if(response.failed == 400){
							 Swal.fire({
							  icon: 'error',
							  title: 'Wait a minute, Who are you',
							  text: "You can't enter."
							 })
						 }else if(response.both_error == 400){
							 Swal.fire({
							  icon: 'error',
							  title: 'Oops...',
							  text: "Email and password is empty"
							 })
						 }else if(response.email_error == 400){
							 Swal.fire({
							  icon: 'error',
							  title: 'Oops...',
							  text: "The email is empty"
							 })
						 }else if(response.password_error == 400){
							 Swal.fire({
							  icon: 'error',
							  title: 'Oops...W',
							  text: "The password is empty"
							 })
						 }else if(response.password_incorrect == 400){
							 Swal.fire({
							  icon: 'error',
							  title: 'Wrong',
							  text: "Your password is incorrect"
							})
						}
					}
				});
		
			//};	 
	});

	

	function Customer() {
        this.find = function(data) {
            return {
            action: 'login',
            data: data
            };
        };
    }
   /* $(document).ready(function(){
		alert("asd00");
       /* $("#customer_login").validate({
            alert("aiousdn");
        rules: {
            name: "required",
            password: "required"
        },
        messages: {
            name: "Please fill the email",
            password: "Please fill the password"
        }
    	});

		$("#customer_login").valid();
		

		$('#customer_login').on('click', '#login', function(e){
            e.preventDefault();
            var data1 = $(this).serialize();
            var find = new Customer(); 
            var select = find.find(data1); 
			print_r(select);
            $.ajax({
                type: 'POST',
                url: 'queiries.php', 
                data: select,
                dataType: 'json',
                success: function(response) {
                     //Below are all the server side errors so :(
                     if (response.success) {
                         Swal.fire({
                             icon: 'success',
                             title: 'Success',
                             text: 'Sucessfully registered',
                             showCancelButton: false,
                             confirmButtonColor: '#3085d6',
                             confirmButtonText: 'Back to admin panel'
                         }).then((result) => {
                           if (result.isConfirmed) {
                             location.reload(true);
                           }
                         })  
                     } else if (response.error1){
                         Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: "Please fill all the details"
                         })
                     } else if(response.error2){
                         Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'Fill out the name'
                         })
                     } else{
                        Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'fill out the description'
                         })
                     }
                }
            });
        });
	});*/

	
</script>




<script>window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')</script>
<script defer src="js/bundle.js"></script>


<a href="#" class="tt-back-to-top" id="js-back-to-top">BACK TO TOP</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

<!-- Mirrored from softali.net/victor/wookie/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:32:11 GMT -->
</html>