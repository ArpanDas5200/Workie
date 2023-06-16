<?php   
session_start();
error_reporting(0);
if(empty($_SESSION['login'])){
	header('location:login');
}

require 'connection.php';
require 'functions.php';


$search = isset($_GET['q']) ? trim($_GET['q']) : '';

$search = filter_var($search, FILTER_SANITIZE_STRING);
if (!empty($search)) {
	$product = new All();
	$products_all = $product -> search($search);
	// print_r($cat);
	// die("dead");
	$cat = $product -> category_show();
}else{
	$product = new All();
	$products_all = $product -> show();
	$cat = $product -> category_show();
}

// print_r($products_all);
// die("dead");
?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from softali.net/victor/wookie/html/listing-left-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:29:58 GMT -->
<head>
		<meta charset="utf-8">
	<title>Wokiee - All Products</title>
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

	<script src="javascript/some2.js"></script>
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
  
<!-- HEADER -->
<?php require 'majors/header.php' ?> 

<div class="tt-breadcrumb">
	<div class="container">
		<ul>
			<li><a href="index">Home</a></li>
			<li><a href="all_products">All Products</a></li>
		</ul>
	</div>
</div>

<!-- MAIN CONTENT OF THE WEBPAGE -->
<div id="tt-pageContent">
	<div class="container-indent">
		<div class="container">
			<div class="row">

				<?php if(!empty($products_all)){ ?>
					
					<!-- FILTER SECTION LEFT SIDE/LEFT NAV -->
					<div class="col-md-4 col-lg-3 col-xl-3 leftColumn aside" id="js-leftColumn-aside">
						<div class="tt-btn-col-close">
							<a href="#">Close</a>
						</div>
						<div class="tt-collapse open tt-filter-detach-option">
							<div class="tt-collapse-content">
								<div class="filters-mobile">
									
								</div>
							</div>
						</div>
						
						<div class="tt-collapse open mb-2" >
							
								<ul class="tt-list-row filter">	
									<li class="list-group-item">
										<div class="form-check">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input product_filter" value="recent" name="" id="recent"> Recents
											</label>
										</div>
									</li>
								</ul>
						</div>
	
						<!-- PRODUCT CATEGORIES -->
						<div class="tt-collapse open mb-2" >
							<h3 class="tt-collapse-title p-0">PRODUCT CATEGORIES</h3>
							<div class="tt-collapse-content">
								<ul class="tt-list-row filter">
									<?php while($row = $cat -> fetch(PDO::FETCH_ASSOC)) {  ?>
									<li class="list-group-item">
										<div class="form-check">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input product_filter" value="<?= $row['id'] ?>" name="" id="category"> <?= $row['category_name'] ?>
											</label>
										</div>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
	
						<!-- FILTER BY PRICE -->
						<div class="tt-collapse open mb-2">
							<h3 class="tt-collapse-title p-0">FILTER BY PRICE</h3>
							<div class="tt-collapse-content">
								<ul class="tt-list-row filter">
									<li class="list-group-item">
										<div class="form-check">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input product_filter" value="price1" name="" id="price"> $0 — $100
											</label>
										</div>
									
										<div class="form-check">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input product_filter" value="price2" name="" id="price"> $100 — $200
											</label>
										</div>
	
										<div class="form-check">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input product_filter" value="price3" name="" id="price"> $200 — $300
											</label>
										</div>
	
										
									</li>
								</ul>
							</div>
						</div>
	
						<!-- SORT BY PRICE -->
						<div class="tt-collapse open mb-2" >
							<h3 class="tt-collapse-title p-0">SORT BY PRICE</h3>
							<div class="tt-collapse-content">
								<ul class="tt-list-row filter">
									<li class="list-group-item">
										<div class="form-check">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input product_filter" value="lowtohigh" name="" id="sort"> Low - HIGH
											</label>
										</div>
	
										<div class="form-check">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input product_filter" value="hightolow" name="" id="sort"> HIGH - LOW
											</label>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					
					<!-- MAIN PRODUCTS VIEW SECTION -->
					<div class="col-md-12 col-lg-9 col-xl-9">
						<div class="content-indent container-fluid-custom-mobile-padding-02">
	
							<!-- UPPER PART OF ALL PRODUCTS -->
							<div class="tt-filters-options"  id="js-tt-filters-options">
										<h1 class="tt-title title">
											ALL PRODUCTS 
										</h1>
										<div class="tt-btn-toggle">
											<a href="#">FILTER</a>
										</div>
	
										<!-- <div class="tt-sort">
											<select>
												<option value="Default Sorting"></option>
												<option value="Default Sorting">Default Sorting 02</option>
												<option value="Default Sorting">Default Sorting 03</option>
											</select>
											
											</div> -->
										
										<div class="tt-quantity">
											<a href="#" class="tt-col-one" data-value="tt-col-one"></a>
											<a href="#" class="tt-col-two" data-value="tt-col-two"></a>
											<a href="#" class="tt-col-three" data-value="tt-col-three"></a>
											<a href="#" class="tt-col-four" data-value="tt-col-four"></a>
											<a href="#" class="tt-col-six" data-value="tt-col-six"></a>
										</div>
							</div>
	
							<!-- ALL PRODUCTS -->
							<div class="tt-product-listing row" id="filteredData">
								<?php
									foreach($products_all as $rows){
									// while($rows = $products_all -> fetch(PDO::FETCH_ASSOC)) { 
									//  print_r($rows); 
									//  echo "<bre>";
								?>
								<div class="col-6 col-md-4 tt-col-item">
									<div class="tt-product thumbprod-center">
										<div class="tt-image-box">
										  <!--  For quick View Modal   -->
											<a href="#" class="tt-btn-quickview product_modale"  data-toggle="modal" data-target="#ModalquickView" data-id="<?php echo $rows['id']; ?>"  data-tooltip="Quick View" data-tposition="left" onclick = "modal(this);"></a>
	
											 <!--  For Add to wish list button   -->
											<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>
	
											 <!--  To jump specifically on that product   -->
											<a href="product_view?slug=<?php echo $rows['slug']; ?>&productid=<?php echo $rows['id']; ?>" >
											
												<span class="tt-img"><?php echo img($rows['image']); ?></span>
	
												<span class="tt-img-roll-over"><?= img($rows['image']); ?></span>

												
												<span class="tt-label-location">
													<!--  New wala Bagde  -->
													<?php if(is_new($rows['created_at'])) {
														echo '<span class="tt-label-new p-1">New</span>';
													}
														// <!-- Sales wala badge -->
													if($rows['discount'] != 0){  
													echo '<span class="tt-label-sale p-1">Sale '. $rows['discount'] .'%</span>';
													}
													if($rows['inventory'] == 0) {
														echo '<span class="tt-label-our-stock p-1">Out of stock</span>';
													}
													?>
												</span>
											</a>
										</div>
										<div class="tt-description">
											<div class="tt-row">
												<ul class="tt-add-info">
													<li><a href="#" id="productparent"><?= $rows['product_parent']; ?></a></li>
												</ul>
												<!--<div class="tt-rating">
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
													<i class="icon-star"></i>
												</div> -->
											</div>
											
											<h2 class="tt-title"><a href="view_product?slug=<?php $rows['slug'];  ?>"><?= $rows['name']; ?></a></h2>
											
											<!-- SALE Price -->
											<?php if($rows['discount'] != 0) { 
											echo '<div class="tt-price">
												<p class="my-0">Old Price: <span class="old-price">$'. $rows['price'] .'</span></p>
												<p class="my-0">New Price: <span class="new-price">$
												   '. $rows['finalprice'] .'
												</span></p>  
											</div>';
											}else{ 
												echo '<div class="tt-price">
												<p class="my-0">Price: <span class="new-price">$'. $rows['price'] .'</span></p>
	 
											</div>';
											}?>
											
											<!-- This for moblie view style -->
											<div class="tt-product-inside-hover">
												<div class="tt-row-btn">
													<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal" data-target="#modalAddToCartProduct" data-id = "<?= $rows['id'] ?>" onclick = "add_to_cart(this);" >ADD TO CART</a>
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
								<!-- <div class="text-center tt_product_showmore">
								<a href="#" class="btn btn-border">LOAD MORE</a>
								<div class="tt_item_all_js">
									<a href="#" class="btn btn-border01">NO MORE ITEM TO SHOW</a>
								</div>
							</div> -->
						</div>
					</div>
				<?php }else{ ?>
					<div class="col-12">
						<div class="tt-empty-search">
							<span class="tt-icon icon-f-85"></span>
							<h1 class="tt-title">YOUR SEARCH RETURNS NO RESULTS.</h1>
							<p>Search results for <span class="tt-base-dark-color">"<?= $search ?>"</span></p>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<!-- FOOTER -->
<?php require 'majors/footer.php' ?> 

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
<script>
	
	$(document).ready(function(){
		$(".product_filter").click(function(){
			var action = 'filter';
			var recent = get_filter('recent');
			var category = get_filter('category');
			var price = get_filter('price');
			var sort = get_filter('sort');
			// alert("ajax");
			$.ajax({
				url: "query.php",
				type: "post",
				data: {action: action, category: category, price: price, sort: sort, recent: recent},
				success: function(response){
					if(response.status == "200"){
							var all = response.data;
							var html = "";

							$.each(all,function(i, currentData){
								// console.log("id: " + currentData['id']);
								// $(".tt-btn-quickview").data("id" + currentData['id']);
								// $("#productparent").text(currentData['product_parent']);

								html += '<div class="col-6 col-md-4 tt-col-item">';
								html +=	'<div class="tt-product thumbprod-center">';
								html +='<div class="tt-image-box">';
                                    //   <!--  For quick View Modal   -->
									html +=	'<a href="#" class="tt-btn-quickview product_modale1 " data-toggle="modal" data-target="#ModalquickView"  data-id="'+ currentData['id'] +'" data-tooltip="Quick View" data-tposition="left" onclick = "modal(this);"></a>';

                                        //  <!--  For Add to wish list button   -->
										html += '<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>';

                                        //  <!--  To jump specifically on that product   -->
										html += '<a href="product_view?slug='+currentData['slug']+'&productid='+currentData['id']+'">';
										html +=	'<span class="tt-img">'+ img(currentData['image']) +'</span>';

											html += '<span class="tt-label-location">';
											// <!--  New wala Bagde  -->
											if(is_new(currentData['created_at'])) {
												html += '<span class="tt-label-new p-1">New</span>';
											} 

											if(currentData['discount'] != 0){
												html += '<span class="tt-label-sale p-1">Sale ' + currentData['discount'] +'%</span>';
											}
											if(currentData['inventory'] == 0) {
												html += '<span class="tt-label-our-stock p-1">Out of stock</span>';
											}
										html += '</span>';
										html +='</a>';
										html +='</div>';
										html +='<div class="tt-description">';
										html +='<div class="tt-row">';
										html +='<ul class="tt-add-info">';
										html +='<li><a href="#" id="productparent">' +currentData['product_parent']+ '</a></li>';
										html +='</ul>';
										
										html +='</div>';
										html +='<h2 class="tt-title"><a href="view_product?slug='+ currentData['slug'] +'">' + currentData['name']+ '</a></h2>';

										//If discount is there then apply the sale badge
										if(currentData['discount'] != 0){
											html +='<div class="tt-price">';
											html +='<p class="my-0">Old Price: <span class="old-price">$'+ currentData['price']+ '</span></p>';
											html +='<p class="my-0">New Price: <span class="new-price">$' + currentData['finalprice'] + '</span></p>'; 
											html +='</div>';
										}else{
											html +='<div class="tt-price">';
											html +='<p class="my-0">Price: <span class="new-price">$'+ currentData['price']+ '</span></p>';
											html +='</div>';
										}
										// <!-- This for moblie view style -->
										html +='<div class="tt-product-inside-hover">';
										html +='<div class="tt-row-btn">';
										html +='<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal" data-target="#modalAddToCartProduct" onclick = "add_to_cart(this);">ADD TO CART</a>';
										html +='</div>';
										html +='<div class="tt-row-btn">';
										html +='<a href="#" class="tt-btn-quickview" data-toggle="modal" ata-target="#ModalquickView"></a>';
										html +='<a href="#" class="tt-btn-wishlist"></a>';
										html +='<a href="#" class="tt-btn-compare"></a>';
										html +='</div>';
										html +='</div>';
										html +='</div>';
										html +='</div></div>';
										html +='</div>';
							
							});
						   	$("#filteredData").html(html);
							$('.title').text("Filtered Products");

					}else if(response.status == "400"){
						var html = "";
						html += '<div class="col-6 col-md-4 mt-0 tt-col-item">';
						html += response.data ;
						html +='</div>';
						$("#filteredData").html(html);
						$('.title').text("Filtered Products");
					}
				}
			});
		});

		/*$(".product_modale1").click(function(e){
			// e.preventDefault();
			var productid = $(this).data("id");
			alert(productid);
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
						
						//Function To set New price based on discount
						function price(old, dis) {
							var old_price = old;
							var discount = dis;
							var new_price = old_price - (old_price * (discount / 100));
							return parseFloat(new_price).toFixed(2);
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
											html += '<img src = "' + images[i] + '" style="height: auto; width: 100%;" alt = "images">';
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
						
						$(".tt-modal-quickview").html(html);
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
				},error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error: " + jqXHR.status);
        }
			});
		});
		*/

		
		function get_filter(text_id){
			var filter_data = [];
			$('#' + text_id + ':checked').each(function(){
				filter_data.push($(this).val());
			});
			
			return filter_data;
		}

		
	});

</script>



<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')</script>
<script defer src="js/bundle.js"></script>


<a href="#" class="tt-back-to-top" id="js-back-to-top">BACK TO TOP</a>
<script src="separate-include/listing/listing.js"></script>
</body>

<!-- Mirrored from softali.net/victor/wookie/html/listing-left-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Feb 2021 06:30:01 GMT -->
</html>