<?php 
session_start();

if(empty($_SESSION['login'])){
	header('location:login');
}
error_reporting(0);
require 'connection.php';
require 'functions.php';
// var_dump($_SESSION);



//can find the below functions in function.php
$products = new products();
$new_products = $products -> newproduct();
$sale_products = $products -> saleproduct();
$most_viewed = $products -> most_viewed();




// echo "<pre>";
// print_r($most_viewed);
// die();

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from softali.net/victor/wookie/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 05:58:45 GMT -->
<head>
		<meta charset="utf-8">
	<title>Wokiee </title>
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
	<script src="javascript/some2.js"></script>

	
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

<div id="tt-pageContent">
	<!-- FIRST SECTION CARASOUL PART -->
	<div class="container-indent nomargin">
		<div class="container-fluid">
			<div class="row">
				<div class="slider-revolution revolution-default">
					<div class="tp-banner-container">
						<div class="tp-banner revolution">
							<ul>
								<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off" data-title="Slide">
									<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAB4AAAAMgAQMAAAD4P+14AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAPdJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABg9uBAAAAAAADI/7URVFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVWFPTgQAAAAAADyf20EVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVpDw4JAAAAAAT9f+0JIwAAAAAAAAAAALAJ8T4AAZAZiOkAAAAASUVORK5CYII=" data-lazyload="images/slides/01/slide-01.jpg"  alt="slide1"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" >
									<div class="tp-caption tp-caption1 lft stb"
										data-x="center"
										data-y="center"
										data-hoffset="0"
										data-voffset="0"
										data-speed="600"
										data-start="900"
										data-easing="Power4.easeOut"
										data-endeasing="Power4.easeIn">
										<div class="tp-caption1-wd-1 tt-base-color">New Fashions</div>
										<div class="tp-caption1-wd-2">Every<br>Month</div>
										<div class="tp-caption1-wd-3">More than 250 Brands and Exclusive offfers every week</div>
										<div class="tp-caption1-wd-4"><a href="listing-left-column.html" target="_blank" class="btn btn-xl" data-text="SHOP NOW!">SHOP NOW!</a></div>
									</div>
								</li>
								<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off"  data-title="Slide">
									<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAB4AAAAMgAQMAAAD4P+14AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAPdJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABg9uBAAAAAAADI/7URVFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVWFPTgQAAAAAADyf20EVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVpDw4JAAAAAAT9f+0JIwAAAAAAAAAAALAJ8T4AAZAZiOkAAAAASUVORK5CYII=" data-lazyload="images/slides/01/slide-02.jpg"  alt="slide1"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" >
									<div class="tp-caption tp-caption1 lft stb"
										data-x="center"
										data-y="center"
										data-hoffset="0"
										data-voffset="0"
										data-speed="600"
										data-start="900"
										data-easing="Power4.easeOut"
										data-endeasing="Power4.easeIn">
										<div class="tp-caption1-wd-1 tt-white-color">Ready To</div>
										<div class="tp-caption1-wd-2 tt-white-color">Use Unique<br>Demos</div>
										<div class="tp-caption1-wd-3 tt-white-color">Optimized for speed, website that sells</div>
										<div class="tp-caption1-wd-4"><a href="listing-left-column.html" target="_blank" class="btn btn-xl" data-text="SHOP NOW!">SHOP NOW!</a></div>
									</div>
								</li>

								<!-- <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off"  data-title="Slide">
									<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAB4AAAAMgAQMAAAD4P+14AAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAPdJREFUeNrswYEAAAAAgKD9qRepAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABg9uBAAAAAAADI/7URVFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVWFPTgQAAAAAADyf20EVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVpDw4JAAAAAAT9f+0JIwAAAAAAAAAAALAJ8T4AAZAZiOkAAAAASUVORK5CYII=" data-lazyload="video/blank.png"  alt="slide1"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" >
									<div class="tp-caption tp-fade fadeout fullscreenvideo"
										data-x="0"
										data-y="0"
										data-speed="600"
										data-start="0"
										data-easing="Power4.easeOut"
										data-endspeed="1500"
										data-endeasing="Power4.easeIn"
										data-autoplay="true"
										data-autoplayonlyfirsttime="false"
										data-nextslideatend="true"
										data-forceCover="1"
										data-dottedoverlay="twoxtwo"
										data-aspectratio="16:9">
										<video class="video-js vjs-default-skin" preload="none"
											poster='video/video_img.jpg' data-setup="{}">
											<source src='video/video.mp4' type='video/mp4'>
										</video>
									</div>
									<div class="tp-caption  tp-fade"
										data-x="right"
										data-y="bottom"
										data-voffset="-60"
										data-hoffset="-90"
										data-speed="600"
										data-start="900"
										data-easing="Power4.easeOut"
										data-endeasing="Power4.easeIn">
										<div class="video-play">
											<a class="icon-f-29 btn-play" href="#"></a>
											<a class="icon-f-28 btn-pause" href="#"></a>
										</div>
									</div>
									<div class="tp-caption lfb lft text-center"
										data-x="center"
										data-y="center"
										data-voffset="-20"
										data-hoffset="0"
										data-speed="600"
										data-start="900"
										data-easing="Power4.easeOut"
										data-endeasing="Power4.easeIn">
										<div class="tp-caption1-wd-1 tt-base-color">Oberlo</div>
										<div class="tp-caption1-wd-2 tt-white-color">Find Products for<br>Shop Store</div>
										<div class="tp-caption1-wd-3 tt-white-color">Oberlo allows you to easily import dropshipped products directly into your ecommerce store</div>
										<div class="tp-caption1-wd-4"><a href="listing-left-column.html" target="_blank" class="btn btn-xl" data-text="SHOP NOW!">SHOP NOW!</a></div>
									</div>
								</li> -->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- SECOND SECTION TO SELECT WHAT KIND OF CATEGORY   -->	
	<div class="container-indent0">
		<div class="container-fluid">
			<div class="row tt-layout-promo-box">
				<div class="col-sm-12 col-md-6">
					<div class="row">
						<div class="col-sm-6">
							<a href="listing-left-column.html" class="tt-promo-box tt-one-child hover-type-2">
								<img src="images/loader.svg" data-src="images/promo/index-promo-img-01.jpg" alt="">
								<div class="tt-description">
									<div class="tt-description-wrapper">
										<div class="tt-background"></div>
										<div class="tt-title-small">SALE</div>
									</div>
								</div>
							</a>
							<a href="listing-left-column.html" class="tt-promo-box tt-one-child hover-type-2">
								<img src="images/loader.svg" data-src="images/promo/index-promo-img-02.jpg" alt="">
								<div class="tt-description">
									<div class="tt-description-wrapper">
										<div class="tt-background"></div>
										<div class="tt-title-small">NEW</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-sm-6">
							<a href="listing-left-column.html" class="tt-promo-box tt-one-child hover-type-2">
								<img src="images/loader.svg" data-src="images/promo/index-promo-img-03.jpg" alt="">
								<div class="tt-description">
									<div class="tt-description-wrapper">
										<div class="tt-background"></div>
										<div class="tt-title-small">WOMEN</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="row">
						<div class="col-sm-6">
							<a href="listing-left-column.html" class="tt-promo-box tt-one-child hover-type-2">
								<img src="images/loader.svg" data-src="images/promo/index-promo-img-04.jpg" alt="">
								<div class="tt-description">
									<div class="tt-description-wrapper">
										<div class="tt-background"></div>
										<div class="tt-title-small">MEN</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-sm-6">
							<a href="listing-left-column.html" class="tt-promo-box tt-one-child hover-type-2">
								<img src="images/loader.svg" data-src="images/promo/index-promo-img-05.jpg" alt="">
								<div class="tt-description">
									<div class="tt-description-wrapper">
										<div class="tt-background"></div>
										<div class="tt-title-small">ACCESSORIES</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-sm-12">
							<a href="listing-left-column.html" class="tt-promo-box tt-one-child">
								<img src="images/loader.svg" data-src="images/promo/index-promo-img-06.jpg" alt="">
								<div class="tt-description">
									<div class="tt-description-wrapper">
										<div class="tt-background"></div>
										<div class="tt-title-small">SHOES</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- THIRD SECTION "NEW ARRIVALS" -->
	<div class="container-indent">
		<div class="container container-fluid-custom-mobile-padding">

			<div class="tt-block-title">
				<h1 class="tt-title">NEW ARRIVALS</h1>
				<div class="tt-description">NEW WEEK, NEW FASHIONS</div>
			</div>

			<div class="row tt-layout-product-item carousel">
				<?php for($i = 0; $i < count($new_products); $i++) {?>
				<div class="p-2">
					<div class="tt-product thumbprod-center">
						<div class="tt-image-box">
							<a href="#" class="tt-btn-quickview product_modale" data-toggle="modal" data-target="#ModalquickView"	data-tooltip="Quick View" data-id="<?= $new_products[$i]['id']; ?>" data-tposition="left" onclick = "modal(this);"></a>

							<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>

							<a href = "#" class = "tt-btn-compare" data-tooltip = "Add to Compare" data-tposition = "left" ></a>
							
							<a href="product_view?slug=<?= $new_products[$i]['slug'] ?>&productid=<?= $new_products[$i]['id']; ?> ">
								<span class="tt-img"><?= img($new_products[$i]['image']) ?></span>
								<span class="tt-label-location">
								<?php if(is_new($new_products[$i]['created_at'])) {
									echo '<span class="tt-label-new p-1">New</span>';
								}
								if($new_products[$i]['discount'] != 0){  
									echo '<span class="tt-label-sale p-1">Sale'. $new_products[$i]['discount'] .'%</span>';
								}
								if($new_products[$i]['inventory'] == 0) {
									echo '<span class="tt-label-our-stock p-1">Out of stock</span>';
								}
								?>
								</span>
							</a>

						</div>
						<div class="tt-description">
							<div class="tt-row">
								<ul class="tt-add-info">
									<li><a href="#"><?= $new_products[$i]['product_parent'] ?></a></li>
								</ul>
							</div>
							<h2 class="tt-title"><a href="product_view?productid=<?= $new_products[$i]['id']; ?> &slug=<?= $new_products[$i]['slug'] ?>"><?= $new_products[$i]['name'] ?></a></h2>

							<!-- SALE Price -->
							<?php if($new_products[$i]['discount'] != 0) { 
										echo '<div class="tt-price">
                                            <p class="my-0">Old Price: <span class="old-price">$'. $new_products[$i]['price'] .'</span></p>
											<p class="my-0">New Price: <span class="new-price">$
                                               '. price($new_products[$i]['price'],$new_products[$i]['discount']) .'
                                            </span></p>  
										</div>';
										}else{ 
											echo '<div class="tt-price">
                                            <p class="my-0">Price: <span class="new-price">$'. $new_products[$i]['price'] .'</span></p>
 
										</div>';
							}?>

							<div class="tt-product-inside-hover">
								<div class="tt-row-btn">
									<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal" v data-id="<?= $new_products[$i]['id'] ?>" data-target="#modalAddToCartProduct" onclick = "add_to_cart(this);">ADD TO CART</a>
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

	<!-- FOURTH SECTION "SALE PRODUCTS" -->
	<div class="container-indent">
		<div class="container container-fluid-custom-mobile-padding">
			
			<div class="tt-block-title">
				<h1 class="tt-title">GREAT SALE</h1>
				<div class="tt-description">ALL PRODUCTS MORE THAN 50% OFF</div>
			</div>
			
			<div class="row tt-layout-product-item carousel">
				<?php for($i = 0; $i < count($sale_products); $i++) {?>
				<div class="p-2">
					<div class="tt-product thumbprod-center">
						<div class="tt-image-box">
							<a href="#" class="tt-btn-quickview product_modale" data-toggle="modal" data-target="#ModalquickView"	data-tooltip="Quick View" data-id="<?= $sale_products[$i]['id']; ?>" data-tposition="left" onclick = "modal(this);"></a>

							<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>

							<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare" data-tposition="left"></a>
							
							<a href="product_view?slug=<?= $sale_products[$i]['slug'] ?>&productid=<?= $sale_products[$i]['id']; ?> ">
								<span class="tt-img"><?= img($sale_products[$i]['image']) ?></span>
								<!-- LABELS -->
								<span class="tt-label-location">
								<?php 
								if(is_new($new_products[$i]['created_at'])) {
									echo '<span class="tt-label-new p-1">New</span>';
								} 								
								if($sale_products[$i]['discount'] != 0){  
									echo '<span class="tt-label-sale p-1">Sale '. $sale_products[$i]['discount'] .'%</span>';
								}
								if($sale_products[$i]['inventory'] == 0) {
									echo '<span class="tt-label-our-stock p-1">Out of stock</span>';
								}
								?>
								</span>
							</a>

						</div>
						<div class="tt-description">
							<div class="tt-row">
								<ul class="tt-add-info">
									<li><a href="#"><?= $sale_products[$i]['product_parent'] ?></a></li>
								</ul>
							</div>
							<h2 class="tt-title"><a href="product_view?productid=<?= $sale_products[$i]['id']; ?> &slug=<?= $sale_products[$i]['slug'] ?>"><?= $sale_products[$i]['name'] ?></a></h2>

							<!-- SALE Price -->
							<?php if($sale_products[$i]['discount'] != 0) { 
										echo '<div class="tt-price">
                                            <p class="my-0">Old Price: <span class="old-price">$'. $sale_products[$i]['price'] .'</span></p>
											<p class="my-0">New Price: <span class="new-price">$
                                               '. price($sale_products[$i]['price'],$sale_products[$i]['discount']) .'
                                            </span></p>  
										</div>';
										}else{ 
											echo '<div class="tt-price">
                                            <p class="my-0">Price: <span class="new-price">$'. $sale_products[$i]['price'] .'</span></p>
 
										</div>';
							}?>

							<div class="tt-product-inside-hover">
								<div class="tt-row-btn">
									<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal" data-id="<?= $sale_products[$i]['id'] ?>" data-target="#modalAddToCartProduct" onclick = "add_to_cart(this);">ADD TO CART</a>
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

	<!-- FIFTH SECTION  -->
	<div class="container-indent">
		<div class="container-fluid-custom">
			<div class="row tt-layout-promo-box">
				<div class="col-sm-6 col-md-4">
					<a href="listing-left-column.html" class="tt-promo-box">
						<img src="images/loader.svg" data-src="images/promo/index-promo-img-07.jpg" alt="">
						<div class="tt-description">
							<div class="tt-description-wrapper">
								<div class="tt-background"></div>
								<div class="tt-title-small">FALL-WINTER CLEARANCE SALES</div>
								<div class="tt-title-large">GET UP TO <span class="tt-base-color">50% OFF</span></div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-sm-6 col-md-4">
					<a href="all_products" class="tt-promo-box">
						<img src="images/loader.svg" data-src="images/promo/index-promo-img-08.jpg" alt="">
						<div class="tt-description">
							<div class="tt-description-wrapper">
								<div class="tt-background"></div>
								<div class="tt-title-small">SUMMER VACATION <span class="tt-base-color">2023</span></div>
								<div class="tt-title-large">NEW PLACES TO VISIT</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-sm-6 col-md-4">
					<a href="listing-left-column.html" class="tt-promo-box">
						<img src="images/loader.svg" data-src="images/promo/index-promo-img-09.jpg" alt="">
						<div class="tt-description">
							<div class="tt-background"></div>
							<div class="tt-description-wrapper">
								<div class="tt-background"></div>
								<div class="tt-title-small">NEW COLLECTION</div>
								<div class="tt-title-large"><span class="tt-base-color">HANDBAGS</span></div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- FIFTH SECTION "MOST VIEWED PRODUCTS" -->
	<div class="container-indent">
		<div class="container container-fluid-custom-mobile-padding">

			<div class="tt-block-title">
				<h1 class="tt-title">MOST VIEWED PRODUCTS</h1>
				<div class="tt-description">MOST LIKED PRODUCTS</div>
			</div>

			<div class="row tt-layout-product-item carousel">
				<?php for($i = 0; $i < count($most_viewed); $i++) {?>
				<div class="p-2">
					<div class="tt-product thumbprod-center">
						<div class="tt-image-box">
							<a href="#" class="tt-btn-quickview product_modale" data-toggle="modal" data-target="#ModalquickView"	data-tooltip="Quick View" data-id="<?= $most_viewed[$i]['id']; ?>" data-tposition="left" onclick = "modal(this);"></a>

							<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>

							<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare" data-tposition="left"></a>
							
							<a href="product_view?slug=<?= $most_viewed[$i]['slug'] ?>&productid=<?= $most_viewed[$i]['id']; ?>">
								<span class="tt-img "><?= img($most_viewed[$i]['image']) ?></span>
								<span class="tt-label-location">
								<?php  if(is_new($new_products[$i]['created_at'])) {
									echo '<span class="tt-label-new p-1">New</span>';
								}
								if($most_viewed[$i]['discount'] != 0){ 
									echo '<span class="tt-label-sale p-1">Sale '. $most_viewed[$i]['discount'] .'%</span>';
								} 
								if($most_viewed[$i]['inventory'] == 0) {
									echo '<span class="tt-label-our-stock p-1">Out of stock</span>';
								}
								?>
								</span>
							</a>

						</div>
						<div class="tt-description">
							<div class="tt-row">
								<ul class="tt-add-info">
									<li><a href="#"><?= $most_viewed[$i]['product_parent'] ?></a></li>
								</ul>
							</div>
							<h2 class="tt-title"><a href="product_view?productid=<?= $most_viewed[$i]['id']; ?> &slug=<?= $most_viewed[$i]['slug'] ?>"><?= $most_viewed[$i]['name'] ?></a></h2>

							<!-- SALE Price -->
							<?php if($most_viewed[$i]['discount'] != 0) { 
										echo '<div class="tt-price">
                                            <p class="my-0">Old Price: <span class="old-price">$'. $most_viewed[$i]['price'] .'</span></p>
											<p class="my-0">New Price: <span class="new-price">$
                                               '. price($most_viewed[$i]['price'],$most_viewed[$i]['discount']) .'
                                            </span></p>  
										</div>';
										}else{ 
											echo '<div class="tt-price">
                                            <p class="my-0">Price: <span class="new-price">$'. $most_viewed[$i]['price'] .'</span></p>
 
										</div>';
							}?>

							<div class="tt-product-inside-hover">
								<div class="tt-row-btn">
									<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal" data-id="<?= $most_viewed[$i]['id'] ?>" data-target="#modalAddToCartProduct" onclick = "add_to_cart(this);">ADD TO CART</a>
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

	<!-- SIXTH SECTION "LATEST FROM BLOG" -->
	<div class="container-indent">
		<div class="container">
			<div class="tt-block-title">
				<h2 class="tt-title">LATES FROM BLOG</h2>
				<div class="tt-description">THE FRESHEST AND MOST EXCITING NEWS</div>
			</div>
			<div class="tt-blog-thumb-list">
				<div class="row">
					<div class="col-12 col-sm-6 col-md-6 col-lg-4">
						<div class="tt-blog-thumb">
							<div class="tt-img"><a href="blog-single-post.html" target="_blank"><img src="images/loader.svg" data-src="images/blog/blog-post-img-06.jpg" alt=""></a></div>
							<div class="tt-title-description">
								<div class="tt-background"></div>
								<div class="tt-tag">
									<a href="blog-single-post.html">FASHION</a>
								</div>
								<div class="tt-title">
									<a href="blog-single-post.html">DOLORE EU FUGIATNULLA PARIATUR</a>
								</div>
								<p>
									Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
								</p>
								<div class="tt-meta">
									<div class="tt-autor">
										by <a href="#">ADRIAN</a> on January 14, 2017
									</div>
									<div class="tt-comments">
										<a href="#"><i class="tt-icon icon-f-88"></i>7</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4">
						<div class="tt-blog-thumb">
							<div class="tt-img"><a href="blog-single-post.html" target="_blank"><img src="images/loader.svg" data-src="images/blog/blog-post-img-04.jpg" alt=""></a></div>
							<div class="tt-title-description">
								<div class="tt-background"></div>
								<div class="tt-tag">
									<a href="blog-single-post.html">FASHION</a>
								</div>
								<div class="tt-title">
									<a href="blog-single-post.html">INCIDIDUNT UT LABORE ET DOLORE</a>
								</div>
								<p>
									Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
								</p>
								<div class="tt-meta">
									<div class="tt-autor">
										by <a href="#">ADRIAN</a> on January 14, 2017
									</div>
									<div class="tt-comments">
										<a href="#"><i class="tt-icon icon-f-88"></i>7</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4">
						<div class="tt-blog-thumb">
							<div class="tt-img"><a href="blog-single-post.html" target="_blank"><img src="images/loader.svg" data-src="images/blog/blog-post-img-02.jpg" alt=""></a></div>
							<div class="tt-title-description">
								<div class="tt-background"></div>
								<div class="tt-tag">
									<a href="blog-single-post.html">FASHION</a>
								</div>
								<div class="tt-title">
									<a href="blog-single-post.html">INCIDIDUNT UT LABORE ET DOLORE</a>
								</div>
								<p>
									Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
								</p>
								<div class="tt-meta">
									<div class="tt-autor">
										by <a href="#">ADRIAN</a> on January 14, 2017
									</div>
									<div class="tt-comments">
										<a href="#"><i class="tt-icon icon-f-88"></i>7</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- SEVENTH SECTION "@FOLLOW US ON" -->
	<div class="container-indent">
		<div class="container-fluid">
			<div class="tt-block-title">
				<h2 class="tt-title"><a target="_blank" href="https://www.instagram.com/wokieeshop/">@ FOLLOW</a> US ON</h2>
				<div class="tt-description">INSTAGRAM</div>
			</div>
			<div class="row">
				<div id="instafeed" class="instafeed-fluid" data-access-token="IGQVJXX1hydHVETWFEMGIzeFFmYzIyU1ZAjTHREakhBU1ZAHU0JOZAXJmSWtfbUotMnNHVGxUTUxXckIwVUlhVk1QTEhfQXliNkVoejlILS1Kem40NU1fSWszOTZAhT0dOZAWZAqLXZA1QWxKSHNhSTdpRmN5WQZDZD" data-limitimg="6"></div>
			</div>
		</div>
	</div>

	<!-- EIGTH SECTION "FREE SHIPPING" -->
	<div class="container-indent">
		<div class="container">
			<div class="row tt-services-listing">
				<div class="col-xs-12 col-md-6 col-lg-4">
					<a href="#" class="tt-services-block">
						<div class="tt-col-icon">
							<i class="icon-f-48"></i>
						</div>
						<div class="tt-col-description">
							<h4 class="tt-title">FREE SHIPPING</h4>
							<p>Free shipping on all US order or order above $99</p>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-4">
					<a href="#" class="tt-services-block">
						<div class="tt-col-icon">
							<i class="icon-f-35"></i>
						</div>
						<div class="tt-col-description">
							<h4 class="tt-title">SUPPORT 24/7</h4>
							<p>Contact us 24 hours a day, 7 days a week</p>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-4">
					<a href="#" class="tt-services-block">
						<div class="tt-col-icon">
							<i class="icon-e-09"></i>
						</div>
						<div class="tt-col-description">
							<h4 class="tt-title">30 DAYS RETURN</h4>
							<p>Simply return it within 24 days for an exchange.</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- FOOTER -->
<footer id="tt-footer">

	<!-- FIRST SECTION FOR JOIN US -->
	<div class="tt-footer-default tt-color-scheme-02">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-9">
					<div class="tt-newsletter-layout-01">
						<div class="tt-newsletter">
							<div class="tt-mobile-collapse">
								<h4 class="tt-collapse-title">
									BE IN TOUCH WITH US:
								</h4>
								<div class="tt-collapse-content">
									<form id="newsletterform" class="form-inline form-default" method="post" novalidate="novalidate" action="#">
										<div class="form-group">
											<input type="text" name="email" class="form-control" placeholder="Enter your e-mail">
											<button type="submit" class="btn">JOIN US</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-auto">
					<ul class="tt-social-icon">
						<li><a class="icon-g-64" target="_blank" href="http://www.facebook.com/"></a></li>
						<li><a class="icon-h-58" target="_blank" href="http://www.facebook.com/"></a></li>
						<li><a class="icon-g-66" target="_blank" href="http://www.twitter.com/"></a></li>
						<li><a class="icon-g-67" target="_blank" href="http://www.google.com/"></a></li>
						<li><a class="icon-g-70" target="_blank" href="https://instagram.com/"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- SECTION SECTION FOOTER -->
	<div class="tt-footer-col tt-color-scheme-01">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-2 col-xl-3">
					<div class="tt-mobile-collapse">
						<h4 class="tt-collapse-title">
							CATEGORIES
						</h4>
						<div class="tt-collapse-content">
							<ul class="tt-list">
								<li><a href="listing-collection.html">Women</a></li>
								<li><a href="listing-collection.html">Men</a></li>
								<li><a href="listing-collection.html">Accessories</a></li>
								<li><a href="listing-collection.html">Shoes</a></li>
								<li><a href="listing-collection.html">New Arrivals</a></li>
								<li><a href="listing-collection.html">Clearence</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-2 col-xl-3">
					<div class="tt-mobile-collapse">
						<h4 class="tt-collapse-title">
							MY ACCOUNT
						</h4>
						<div class="tt-collapse-content">
							<ul class="tt-list">
								<li><a href="account_order.html">Orders</a></li>
								<li><a href="page404.html">Compare</a></li>
								<li><a href="page404.html">Wishlist</a></li>
								<li><a href="login.html">Log In</a></li>
								<li><a href="registeration">Register</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 col-xl-3">
					<div class="tt-mobile-collapse">
						<h4 class="tt-collapse-title">
							ABOUT
						</h4>
						<div class="tt-collapse-content">
							<p>
								Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, seddo eiusmod tempor incididunt ut labore etdolore.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 col-xl-3">
					<div class="tt-newsletter">
						<div class="tt-mobile-collapse">
							<h4 class="tt-collapse-title">
								CONTACTS
							</h4>
							<div class="tt-collapse-content">
								<address>
									<p><span>Address:</span> 2548 Broaddus Maple Court Avenue, Madisonville KY 4783, United States of America</p>
									<p><span>Phone:</span> +777 2345 7885;  +777 2345 7886</p>
									<p><span>Hours:</span> 7 Days a week from 10 am to 6 pm</p>
									<p><span>E-mail:</span> <a href="mailto:info@mydomain.com">info@mydomain.com</a></p>
								</address>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- THIRD SECTION "ALL RIGHTS RESERVED" -->
	<div class="tt-footer-custom">
		<div class="container">
			<div class="tt-row">
				<div class="tt-col-left">
					<div class="tt-col-item tt-logo-col">
						<!-- logo -->
						<a class="tt-logo tt-logo-alignment" href="index-2.html">
							<img  src="images/loader.svg"  data-src="images/custom/logo.png" alt="">
						</a>
						<!-- /logo -->
					</div>
					<div class="tt-col-item">
						<!-- copyright -->
						<div class="tt-box-copyright">
							&copy; Wokiee 2020. All Rights Reserved
						</div>
						<!-- /copyright -->
					</div>
				</div>
				<div class="tt-col-right">
					<div class="tt-col-item">
						<!-- payment-list -->
						<ul class="tt-payment-list">
							<li><a href="page404.html"><span class="icon-Stripe"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span>
			                </span></a></li>
							<li><a href="page404.html"> <span class="icon-paypal-2">
			                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
			                </span></a></li>
							<li><a href="page404.html"><span class="icon-visa">
			                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
			                </span></a></li>
							<li><a href="page404.html"><span class="icon-mastercard">
			                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span>
			                </span></a></li>
							<li><a href="page404.html"><span class="icon-discover">
			                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span>
			                </span></a></li>
							<li><a href="page404.html"><span class="icon-american-express">
			                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span>
			                </span></a></li>
						</ul>
						<!-- /payment-list -->
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>


<!-- modal (AddToCartProduct) 
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
</div>-->

<!-- modal (quickViewModal) -->
<div class="modal  fade"  id="ModalquickView" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
			</div>
			<div class="modal-body">
				<div class="tt-modal-quickview ">
				
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
	$(".carousel").slick({
		infinite: true,
  		slidesToShow: 4,
  		slidesToScroll: 3,
		adaptiveHeight: true,
		autoplay: true,
		autoplaySpeed: 2100,
		responsive: [
   		{
      		breakpoint: 1024,
      		settings: {
      			slidesToShow: 3,
      			slidesToScroll: 2,
      			infinite: true,
      			dots: true,
				adaptiveHeight: true
      		}
    	},
    	{
    		breakpoint: 600,
    		settings: {
    			slidesToShow: 2,
    			slidesToScroll: 2,
				adaptiveHeight: true
    		}
		}
  		]		
	});

	// $(".product_modale").click(function(e){
	// 	e.preventDefault();
	// 	var productid = $(this).data("id");
	// 	// alert(productid);
	// 	$.ajax({
	// 		url: "query.php",
	// 		type: "post",
	// 		datatype: 'json',
	// 		data: {action: 'modal', data: productid},
	// 		success: function(response){
	// 			if(response[0].status == "200"){
	// 				//Function to set images 
	// 				function img(o) {
	// 					let temp = [];
						
	// 					temp = o.split(" & ");
	// 					temp = temp.filter(Boolean);

	// 					let images = [];
	// 					temp.forEach(image => {images.push("../admin/upload/" + image.replace(/[\[\]]/g, "").trim());});
						
	// 					return images;
	// 				}
					
	// 				//Function To set New price based on discount
	// 				function price(old, dis) {
	// 					var old_price = old;
	// 					var discount = dis;
	// 					var new_price = old_price - (old_price * (discount / 100));
	// 					return parseFloat(new_price).toFixed(2);
	// 				}
	// 				var data = response[0].data;
	// 				var html = "";
	// 				var images = img(data['image']);

	// 				html += '<div class="row">';
	// 					//Left side of the modal to show images
	// 					html += '<div class="col-12 col-md-7 col-lg-6">';
	// 						html += '<div class="tt-mobile-product-slider arrow-location-center sliders">';
							
	// 							html += '<div class="slides-show">';
	// 							for(var i=0; i < images.length; i++){
	// 								html += '<div>'
	// 									html += '<img src = "' + images[i] + '" style="height: auto; width: 100%;" alt = "images">';
	// 								html += '</div>';	
	// 							}
	// 							html += '</div>';	

	// 						html += '</div>';
	// 					html += '</div>';
						

	// 					//Right side of the modal to show tha datas
	// 					html += '<div class="col-12 col-md-7 col-lg-6">';
	// 						html += '<div class="tt-product-single-info">';
	// 							html += '<div class="tt-add-info">';
	// 								html += '<ul>';
	// 									html += '<li><span>Availability:</span> ' + data['inventory'] + ' in Stock</li>';
	// 								html += '</ul>';
	// 							html += '</div>';
	// 						html += '<h2 class="tt-title">'+ data['name'] +'</h2>';

	// 						//This section is for price Showing 
	// 						//If discount is not avaliable then  
	// 						if(data['discount'] == 0){
	// 						html += '<div class="tt-price">';
	// 							html += '<span class="new-price">$' + data['price'] + '</span> ';
	// 						html += '</div>';
	// 						}else{
	// 							html += '<div class="tt-price">';
	// 								html += '<span class="old-price">$' + data['price'] + '</span> ';
	// 								html += '<span class="new-price">$' + data['finalprice'] + '</span></span> ';
	// 							html += '</div>';
	// 						}

	// 						//matching the above we showing the other resukts
	// 						if(data['discount'] == 0){
	// 							html += '<span class="">Discount is not avalible on this product</span><br>';
	// 						}else{
	// 							html += '<span class="">Discount:- ' + data['discount'] + ' % OFF || </span></span>';
	// 						}

	// 						//Delivery charges 
	// 						if(data['deliverycharges'] == 0){
	// 							html += '';
	// 						}else{
	// 							html += '<span class="">Delivery Charges:- $' + data['deliverycharges'] + '</span></span>';
	// 						}
	// 						//END of this section is for price Showing 

	// 						//Start Of the review DIV
	// 						html += '<div class="tt-review">';
	// 							html += '<div class="tt-rating">';
	// 								html += '<i class="icon-star"></i>';
	// 								html += '<i class="icon-star"></i>';
	// 								html += '<i class="icon-star"></i>';
	// 								html += '<i class="icon-star-half"></i>';
	// 								html += '<i class="icon-star-empty"></i>';
	// 							html += '</div>';
	// 						html += '</div>';

	// 						//Description of the product
	// 						html += '<div class="tt-wrapper">' + data['description'] + '</div>';

	// 						// To enter the required amount
	// 						html += '<div class="tt-wrapper">';
	// 							html += '<div class="tt-row-custom-01">';
	// 								html += '<div class="col-item">';
	// 									html += '<div class="tt-input-counter style-01">';
	// 										html += '<span class="minus-btn"></span>';
	// 										html += '<input type="text" value="1" size="5">';
	// 										html += '<span class="plus-btn"></span>';
	// 									html += '</div>';
	// 								html += '</div>';

	// 								html += '<div class="col-item">';
	// 									html += '<a href="#" class="btn btn-lg"><i class="icon-f-39"></i>ADD TO CART</a>';
	// 								html += '</div>';
	// 							html += '</div>';
	// 						html += '</div>';
	// 						// End of this 

	// 					html += '</div>';
	// 				html += '</div>';
	// 				//End of the review DIV
					
	// 				$(".tt-modal-quickview").html(html);
	// 				$('.slides-show').slick({
	// 					slidesToShow: 1,
	// 					slidesToScroll: 1,
	// 					arrows: false,
	// 					fade: true,
	// 					infinite: true,
	// 					autoplay: true,
	// 					autoplaySpeed: 2500,
	// 					dots: true,
	// 					adaptiveHeight: true							
	// 				});
					
	// 				}
	// 			}
	// 	});
	// });

</script>
<script src="external\jquery\jquery.min.js"></script>

<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')</script>
<script defer src="js/bundle.js"></script>
<a href="#" class="tt-back-to-top" id="js-back-to-top">BACK TO TOP</a>
</body>

<!-- Mirrored from softali.net/victor/wookie/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 05:58:45 GMT -->
</html>