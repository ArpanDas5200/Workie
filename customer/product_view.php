<?php   
session_start();
error_reporting(0);
if(empty($_SESSION['login'])){
	header('location:login.php');
}

require 'connection.php';
require 'functions.php';

// echo "<pre>";
// print_r($_SERVER);
// die();

$product_id = $_GET['productid'];
$user_ip = $_SERVER['REMOTE_ADDR'];

//For the Unique page count
ip_exists($product_id, $user_ip);

if(isset($_GET['slug'])){
    $product_data = getSlug($_GET['slug']);
    $product = new All();
    $products_all = $product -> show(); 
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from softali.net/victor/wookie/html/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:30:20 GMT -->
<head>
		<meta charset="utf-8">
	<title><?= $product_data['name'] ?></title>
	<meta name="keywords" content="HTML5 Template">
	<meta name="description" content="Wokiee - Responsive HTML5 Template">
	<meta name="author" content="wokiee">
	<link rel="shortcut icon" href="favicon.ico">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<!-- Slick for carosal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
	<style>
        body{
            position: relative;
        }
		#custom-product-item .slick-arrow {
			position: absolute;
			top: 50%;
			z-index: 2;
			cursor: pointer;
			font-size: 0;
			line-height: 0;
			background: none;
			border: none;
			width: 38px;
			height: 38px;
			background: #f7f8fa;
			color: #191919;
			font-weight: 500;
			border-radius: 50%;
			transition: all 0.2s linear;
			transform: translate(0%, -50%)
		}
		#custom-product-item{
			opacity: 0;
			transition: opacity 0.2s linear;
		}
		#custom-product-item.tt-show{
			opacity: 1;
		}

		#custom-product-item .slick-arrow:hover {
			background: #2879fe;
			color: #ffffff;
		}

		#custom-product-item .slick-arrow:before {
			font-family: "wokiee";
			font-size: 20px;
			line-height: 1;
		}
		#custom-product-item .slick-prev{
			left: 10px;
		}
		#custom-product-item .slick-prev:before {
			content: "\e90d";
		}
		#custom-product-item .slick-next {
			right: 10px;
		}
		#custom-product-item .slick-next:before {
			content: "\e90e";
		}
		#smallGallery .slick-arrow.slick-disabled,
		#custom-product-item .slick-arrow.slick-disabled{
			opacity: 0;
			pointer-events: none;
		}
        .tt-price h6{
            color: red;
        }
        .sticky{
            position: sticky;
            top: 75px;
        }
		a{
			text-decoration: none;
		}
		.tt-product-single-info .tt-wrapper .btn{
			background: #2879fe;
    		font-family: "Hind", sans-serif;
    		border: none;
    		color: #ffffff;
    		font-size: 14px;
    		line-height: 1;
    		font-weight: 400;
    		letter-spacing: 0.03em;
    		position: relative;
    		outline: none;
    		padding: 6px 31px 4px;
    		display: inline-flex;
    		justify-content: center;
    		align-items: center;
    		text-align: center;
    		height: 40px;
    		cursor: pointer;
    		border-radius: 6px;
    		transition: color 0.2s linear, background-color 0.2s linear;
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

<?php include 'majors/header.php' ?>

<div class="tt-breadcrumb">
	<div class="container">
		<ul>
			<li><a href="index">Home</a></li>
			<li><a href="all_products">Shop</a></li>
			<li><?= $product_data['name'] ?></li>
		</ul>
	</div>
</div>


<div id="tt-pageContent">
	<div class="container-indent">
		<!-- mobile product slider  -->
		<div class="tt-mobile-product-layout visible-xs">
			<div class="tt-mobile-product-slider arrow-location-center" id="zoom-mobile__slider">
                <?php 
                $images_all = img_all($product_data['image']);
                for($i=0; $i < count($images_all); $i++ ){
				echo '<div><img data-lazy="' . $images_all[$i] . '" alt=""></div>';
                }
				?>

                <!-- mobile product video player  -->
				<!--<div>
					<div class="tt-video-block">
						<a href="#" class="link-video"></a>
						<video class="movie" src="video/video.mp4" poster="video/video_img.jpg"></video>
					</div>
				</div> -->
			</div>
			<div id="zoom-mobile__layout">
				<a class="zoom-mobile__close btn" href="#">Back</a>
				<div id="tt-fotorama" data-nav="thumbs" data-auto="false" data-allowfullscreen="false" dataa-fit="cover" ></div>
			</div>
		</div>

		<!-- /desktop product slider  -->
		<div class="container container-fluid-mobile">
			<div class="row">

                <!-- LEft carosal part... To show the Products -->
				<div class="col-6 hidden-xs ">
					<div class="tt-product-vertical-layout sticky">
						<div class="tt-product-single-img">
							<div>
								<button class="tt-btn-zomm tt-top-right"><i class="icon-f-86"></i></button>
								<img class="zoom-product" src='<?= $images_all[0] ?>' alt=""  >
								<div id="custom-product-item">
									<button type="button" class="slick-arrow slick-prev">Previous</button>
									<button type="button" class="slick-arrow slick-next">Next</button>
								</div>
							</div>
						</div>

						<div class="tt-product-single-carousel-vertical">
							<ul id="smallGallery" class="tt-slick-button-vertical  slick-animated-show-js">

                                <?php 
                                for($j=0; $j < count($images_all); $j++){
								echo '<li>
                                    <a class="" href="#" data-image="' . $images_all[$j] . '">
                                        <img src="' . $images_all[$j] . '" alt="">
                                    </a>
                                </li>';
                                }
                                ?>
								

                                <!--  for vieo demonstration
								<li>
									<div class="video-link-product" data-toggle="modal" data-type="youtube" data-target="#modalVideoProduct" data-value="http://www.youtube.com/embed/GhyKqj_P2E4">
										<img src="images/product/product-small-empty.png" alt="">
										<div>
											<i class="icon-f-32"></i>
										</div>
									</div>
								</li>

								<li>
									<div class="video-link-product" data-toggle="modal" data-type="video" data-target="#modalVideoProduct" data-value="video/video.mp4" data-poster="video/video_img.jpg">
										<img src="images/product/product-small-empty.png" alt="" >
										<div>
											<i class="icon-f-32"></i>
										</div>
									</div>
								</li> -->

							</ul>
						</div>
					</div>
				</div>

                <!-- Right Product description part...  -->
				<div class="col-6">
					<div class="tt-product-single-info">
						<div class="tt-add-info">
							<ul>
								<!--<li><span>SKU:</span> 001</li>-->
								<li><span>Availability:</span> <?= $product_data['inventory'] ?> in Stock</li>
							</ul>
						</div>

						<h1 class="tt-title"><?= $product_data['name']; ?></h1>

						<!-- SALE Price -->
						<?php if($product_data['discount'] != 0) { 
								echo	'<div class="tt-price">
                                        	<p class="my-0">Old Price: <span class="old-price">$'. $product_data['price'] .'</span></p>
											<p class="my-0">New Price: <span class="new-price">$'. $product_data['finalprice'] .'</span></p>  
										</div>

										<p class="my-0">Discount: <span class="">'. $product_data['discount'] .' % off</span></p>
										<span class="">Delivery Charges: $'. $product_data['deliverycharges'] .'</span></p>
											';
								}else{ 
									echo	'<div class="tt-price">
												<p class="my-0">Price: <span class="new-price">$'. $product_data['price'] .'</span></p>
											</div>
                                            <span class="">Delivery Charges: $'. $product_data['deliverycharges'] .'</span></span>';
								}?>
						<div class="tt-review">
							<div class="tt-rating">
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star-half"></i>
								<i class="icon-star-empty"></i>
							</div>
							<a class="product-page-gotocomments-js" href="#">(1 Customer Review)</a>
						</div>
						<div class="tt-wrapper">
							Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
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
									<a href="#" class="btn btn-lg" data-id="<?php $product_data['id'] ?>"><i class="icon-f-39"></i>ADD TO CART</a>
								</div>
							</div>
						</div>

						<div class="tt-wrapper">
							<ul class="tt-list-btn">
								<li><a class="btn-link" href="#"><i class="icon-n-072"></i>ADD TO WISH LIST</a></li>
								<li><a class="btn-link" href="#"><i class="icon-n-08"></i>ADD TO COMPARE</a></li>
							</ul>
						</div>
								
						<div class="tt-wrapper">
							<div class="tt-add-info">
								<ul>
									<li><span>Vendor:</span> Polo</li>
									<li><span>Product Type:</span> T-Shirt</li>
									<li><span>Tag:</span>
									<?php 
										$tags = tags($product_data['tags']);

										for($i = 0; $i < count($tags); $i++ ){
											echo '<a href="#">'. $tags[$i] .'</a>, ';
										}

									?> 
									</li>
								</ul>
							</div>
						</div>

						<div class="tt-collapse-block">
                            <!-- Description sectiion -->
							<div class="tt-item">
								<div class="tt-collapse-title">DESCRIPTION</div>
								<div class="tt-collapse-content">
									<?= $product_data['description'] ?>
								</div>
							</div>

                            <!-- Additional information sectiion -->
							<div class="tt-item">
								<div class="tt-collapse-title">ADDITIONAL INFORMATION</div>
								<div class="tt-collapse-content">
									<table class="tt-table-03">
										<tbody>
											<tr>
												<td>Color:</td>
												<td>Blue, Purple, White</td>
											</tr>
											<tr>
												<td>Size:</td>
												<td>20, 24</td>
											</tr>
											<tr>
												<td>Material:</td>
												<td>100% Polyester</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

                            <!-- Review sectiion -->
							<div class="tt-item">
								<div class="tt-collapse-title tt-poin-comments">REVIEWS (3)</div>
								<div class="tt-collapse-content">
									<div class="tt-review-block">
										<div class="tt-row-custom-02">
											<div class="col-item">
												<h2 class="tt-title">
													1 REVIEW FOR VARIABLE PRODUCT
												</h2>
											</div>
											<div class="col-item">
												<a href="#">Write a review</a>
											</div>
										</div>
										<div class="tt-review-comments">
											<div class="tt-item">
												<div class="tt-avatar">
													<a href="#"><img data-src="images/product/single/review-comments-img-01.jpg" alt=""></a>
												</div>
												<div class="tt-content">
													<div class="tt-rating">
														<i class="icon-star"></i>
														<i class="icon-star"></i>
														<i class="icon-star"></i>
														<i class="icon-star-half"></i>
														<i class="icon-star-empty"></i>
													</div>
													<div class="tt-comments-info">
														<span class="username">by <span>ADRIAN</span></span>
														<span class="time">on January 14, 2017</span>
													</div>
													<div class="tt-comments-title">Very Good!</div>
													<p>
														Ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.
													</p>
												</div>
											</div>
											<div class="tt-item">
												<div class="tt-avatar">
													<a href="#"><img data-src="images/product/single/review-comments-img-02.jpg" alt=""></a>
												</div>
												<div class="tt-content">
													<div class="tt-rating">
														<i class="icon-star"></i>
														<i class="icon-star"></i>
														<i class="icon-star"></i>
														<i class="icon-star-half"></i>
														<i class="icon-star-empty"></i>
													</div>
													<div class="tt-comments-info">
														<span class="username">by <span>JESICA</span></span>
														<span class="time">on January 14, 2017</span>
													</div>
													<div class="tt-comments-title">Bad!</div>
													<p>
														Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
													</p>
												</div>
											</div>
											<div class="tt-item">
												<div class="tt-avatar">
													<a href="#"></a>
												</div>
												<div class="tt-content">
													<div class="tt-rating">
														<i class="icon-star"></i>
														<i class="icon-star"></i>
														<i class="icon-star"></i>
														<i class="icon-star-half"></i>
														<i class="icon-star-empty"></i>
													</div>
													<div class="tt-comments-info">
														<span class="username">by <span>ADAM</span></span>
														<span class="time">on January 14, 2017</span>
													</div>
													<div class="tt-comments-title">Very Good!</div>
													<p>
														Diusmod tempor incididunt ut labore et dolore magna aliqua.
													</p>
												</div>
											</div>
										</div>
										<div class="tt-review-form">
											<div class="tt-message-info">
												BE THE FIRST TO REVIEW <span><?= $product_data['name']; ?></span>
											</div>
											<p>Your email address will not be published. Required fields are marked *</p>
											<div class="tt-rating-indicator">
												<div class="tt-title">
													YOUR RATING *
												</div>
												<div class="tt-rating">
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star-half"></i>
													<i class="icon-star-empty"></i>
												</div>
											</div>
											<form class="form-default">
												<div class="form-group">
													<label for="inputName" class="control-label">YOUR NAME *</label>
													<input type="email" class="form-control" id="inputName" placeholder="Enter your name">
												</div>
												<div class="form-group">
													<label for="inputEmail" class="control-label">COUPONE E-MAIL *</label>
													<input type="password" class="form-control" id="inputEmail" placeholder="Enter your e-mail">
												</div>
												<div class="form-group">
													<label for="textarea" class="control-label">YOUR REVIEW *</label>
													<textarea class="form-control"  id="textarea" placeholder="Enter your review" rows="8"></textarea>
												</div>
												<div class="form-group">
													<button type="submit" class="btn">SUBMIT</button>
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
		</div>
	</div> 

    <!-- Social Media Accounts -->
	<div class="container-indent wrapper-social-icon ">
		<div class="container">
			<ul class="tt-social-icon justify-content-center">
				<li><a class="icon-g-64" href="http://www.facebook.com/"></a></li>
				<li><a class="icon-h-58" href="http://www.facebook.com/"></a></li>
				<li><a class="icon-g-66" href="http://www.twitter.com/"></a></li>
				<li><a class="icon-g-67" href="http://www.google.com/"></a></li>
				<li><a class="icon-g-70" href="https://instagram.com/"></a></li>
			</ul>
		</div>
    </div>

    <!-- Related Products -->
	<div class="container-indent">
		<div class="container container-fluid-custom-mobile-padding">
			<div class="tt-block-title text-left">
				<h3 class="tt-title-small">RELATED PRODUCT</h3>
			</div>
			<div class="tt-carousel-products row arrow-location-right-top tt-alignment-img tt-layout-product-item slick-animated-show-js">
                <?php while($rows = $products_all -> fetch(PDO::FETCH_ASSOC) ){?>
                  
				<div class="col-2 col-md-4 col-lg-3">
					<div class="tt-product thumbprod-center">
						<div class="tt-image-box">

							<a href="#" class="tt-btn-quickview product_modale" data-toggle="modal" data-target="#ModalquickView" data-id="<?php echo $rows['id']; ?>"	data-tooltip="Quick View" data-tposition="left"></a>

							<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>

							<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare" data-tposition="left"></a>
							<a href="product_view.?slug=<?php echo $rows['slug']; ?>&productid=<?php echo $rows['id']; ?> ">
								<span class="tt-img"><?php echo img($rows['image'])  ?> </span>
								<span class="tt-label-location">
								<?php if(is_new($rows['created_at'])) {?>
									<span class="tt-label-new p-1">New</span> 
								<?php } ?>
								<?php if($rows['discount'] != 0){  ?> 
									<span class="tt-label-sale p-1">Sale <?= $rows['discount']; ?>%</span>
								<?php } ?>
								</span>
							</a>
						</div>

						<div class="tt-description pb-3" >
							
							<h2 class="tt-title"><a href="product?slug=<?php echo $rows['slug']; ?>"></a><?= $rows['name'] ?></h2>
							<!-- SALE Price -->
							<?php if($rows['discount'] != 0) { 
										echo '<div class="tt-price">
                                            <p class="my-0">Old Price: <span class="old-price">$'. $rows['price'] .'</span></p>
											<p class="my-0">New Price: <span class="new-price">$'. $rows['finalprice'] .'</span></p>  
										</div>';
									}else{ 
										echo '<div class="tt-price">
                                            <p class="my-0">Price: <span class="new-price">$'. $rows['price'] .'</span></p>

										</div>';
									}
									
									?>
							<div class="tt-product-inside-hover">
								<div class="tt-row-btn">
									<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-id="<?php $rows['id'] ?>" data-toggle="modal" data-target="#modalAddToCartProduct">ADD TO CART</a>
								</div>
								<div class="tt-row-btn">
									<a href="#" class="tt-btn-quickview" data-toggle="modal" data-target="#ModalquickView"></a>
									<a href="#" class="tt-btn-wishlist"></a>
									<a href="#" class="tt-btn-compare"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
                <?php } ?>

				
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
				<div class="tt-modal-addtocart des">
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
	$(function() {
    	$.fn.size = function() {
        	return this.length;
    	}
	});
    
	$(".product_modale").click(function(e){
			e.preventDefault();
			var productid = $(this).data("id");
			// alert(productid);
			$.ajax({
				url: "query.php",
				type: "post",
				datatype: 'json',
				data: {action: 'modal', data: productid},
				success: function(response){
					if(response[0].status == "200"){
						//Function to set images 
						function img(o) {
							let temp = [];
							
							temp = o.split(" & ");
							temp = temp.filter(Boolean);

							let images = [];
							temp.forEach(image => {images.push("../admin/upload/" + image.replace(/[\[\]]/g, "").trim());});
							
							return images;
						}
						
						var data = response[0].data;
						var html = "";
						var images = img(data['image']);

						html += '<div class="row">';
							//Left side of the modal to show images
							html += '<div class="col-12 col-md-7 col-lg-6">';
								html += '<div class="tt-mobile-product-slider arrow-location-center sliders">';
								
									html += '<div class="slides-show">';
									for(var i=0; i < images.length; i++){
										html += '<div>'
											html += '<img src = "' + images[i] + '" style="width:100%; height:auto;" alt = "images">';
										html += '</div>';	
									}
									html += '</div>';	

								html += '</div>';
							html += '</div>';
							

							//Right side of the modal to show tha datas
							html += '<div class="col-12 col-md-7 col-lg-6">';
								html += '<div class="tt-product-single-info">';
									html += '<div class="tt-add-info">';
										html += '<ul>';
											html += '<li><span>Availability:</span> ' + data['inventory'] + ' in Stock</li>';
										html += '</ul>';
									html += '</div>';
								html += '<h2 class="tt-title">'+ data['name'] +'</h2>';

								//This section is for price Showing 
								//If discount is not avaliable then  
								if(data['discount'] == 0){
								html += '<div class="tt-price">';
									html += '<span class="new-price">$' + data['price'] + '</span> ';
								html += '</div>';
								}else{
									html += '<div class="tt-price">';
										html += '<span class="old-price">$' + data['price'] + '</span> ';
										html += '<span class="new-price">$' + data['finalprice'] + '</span></span> ';
									html += '</div>';
								}

								//matching the above we showing the other resukts
								if(data['discount'] == 0){
									html += '<span class="">Discount is not avalible on this product</span><br>';
								}else{
									html += '<span class="">Discount:- ' + data['discount'] + ' % OFF || </span></span>';
								}

								//Delivery charges 
								if(data['deliverycharges'] == 0){
									html += '';
								}else{
									html += '<span class="">Delivery Charges:- $' + data['deliverycharges'] + '</span></span>';
								}
								//END of this section is for price Showing 


								//Start Of the review DIV
								html += '<div class="tt-review">';
									html += '<div class="tt-rating">';
										html += '<i class="icon-star"></i>';
										html += '<i class="icon-star"></i>';
										html += '<i class="icon-star"></i>';
										html += '<i class="icon-star-half"></i>';
										html += '<i class="icon-star-empty"></i>';
									html += '</div>';
								html += '</div>';

								//Description of the product
								html += '<div class="tt-wrapper">' + data['description'] + '</div>';

								// To enter the required amount
								html += '<div class="tt-wrapper">';
									html += '<div class="tt-row-custom-01">';
										html += '<div class="col-item">';
											html += '<div class="tt-input-counter style-01">';
												html += '<span class="minus-btn"></span>';
												html += '<input type="text" value="1" size="5">';
												html += '<span class="plus-btn"></span>';
											html += '</div>';
										html += '</div>';

										html += '<div class="col-item">';
											html += '<a href="#" class="btn btn-lg"><i class="icon-f-39"></i>ADD TO CART</a>';
										html += '</div>';
									html += '</div>';
								html += '</div>';
								// End of this 

							html += '</div>';
						html += '</div>';
						//End of the review DIV
						
						$(".desctope").html(html);
						$('.slides-show').slick({
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							fade: true,
							infinite: true,
							autoplay: true,
                			autoplaySpeed: 2500,
							dots: true,
							adaptiveHeight: true
						});
						
						}
					}
			});
		});


</script>
<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')</script>
<script defer src="js/bundle.js"></script>


<a href="#" class="tt-back-to-top" id="js-back-to-top">BACK TO TOP</a>

<script src="separate-include/single-product/single-product.js"></script>
</body>

<!-- Mirrored from softali.net/victor/wookie/html/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:30:25 GMT -->
</html>