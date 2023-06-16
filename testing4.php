<?php 



function outputCategoryOption($categories, $indent = '', $parent_id = null) {
  foreach ($categories as $category) {
      $selected = '';
      if (isset($_POST['parent_id']) && $_POST['parent_id'] == $category['id']) {
          $selected = 'selected';
      }
      echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $indent . $category['category_name'] . '</option>';

      if (isset($categories[$category['id']])) {
          outputCategoryOption($categories[$category['id']], $indent . '&nbsp;&nbsp;&nbsp;&nbsp;', $category['id']);
      }
  }
}

$servername = "localhost";
$dbname = "users";
$usersname = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=users",$usersname, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e){
    Echo "failed" . $e ->getMessage();
}

$con = new mysqli("localhost", "root", "", "users");

try {
    $sql = "SELECT id, category_name, parent_id FROM category ORDER BY category_name";
    $stmt = $conn->query($sql);
    $stmt = $conn->prepare("SELECT c1.*, c2.category_name as parent_name 
    FROM category c1 
    LEFT JOIN category c2 ON c1.parent_id = c2.id 
    ORDER BY c2.category_name, c1.category_name");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
 
    $groupedCategories = [];
    foreach ($categories as $category) {
        $groupedCategories[$category['parent_id']][] = $category;
    }
      echo "<pre>";
      print_r($groupedCategories);
      die();
    outputCategoryOption($groupedCategories);
  } catch (PDOException $e) {
    // TODO: Handle database errors
  }


?>

<div class="col-6 col-md-4 tt-col-item">
								<div class="tt-product thumbprod-center">
									<div class="tt-image-box">
										<a href="#" class="tt-btn-quickview" data-toggle="modal" data-target="#ModalquickView"	data-tooltip="Quick View" data-tposition="left"></a>
										<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>
										<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare" data-tposition="left"></a>
										<a href="product.html">
											<span class="tt-img"><img src="images/loader.svg" data-src="images/product/product-45.jpg" alt=""></span>
											<span class="tt-img-roll-over"><img src="images/loader.svg" data-src="images/product/product-45-01.jpg" alt=""></span>
										</a>
										<div class="tt-countdown_box">
											<div class="tt-countdown_inner">
												<div class="tt-countdown"
													data-date="2020-12-08"
													data-year="Yrs"
													data-month="Mths"
													data-week="Wk"
													data-day="Day"
													data-hour="Hrs"
													data-minute="Min"
													data-second="Sec"></div>
											</div>
										</div>
									</div>
									<div class="tt-description">
										<div class="tt-row">
											<ul class="tt-add-info">
												<li><a href="#">T-SHIRTS</a></li>
											</ul>
											<div class="tt-rating">
												<i class="icon-star"></i>
												<i class="icon-star"></i>
												<i class="icon-star"></i>
												<i class="icon-star"></i>
												<i class="icon-star"></i>
											</div>
										</div>
										<h2 class="tt-title"><a href="product.html">Flared Shift Dress</a></h2>
										<div class="tt-price">
											$124
										</div>
										<div class="tt-option-block">
											<ul class="tt-options-swatch">
												<li><a class="options-color tt-color-bg-03" href="#"></a></li>
												<li><a class="options-color tt-color-bg-04" href="#"></a></li>
												<li><a class="options-color tt-color-bg-05" href="#"></a></li>
											</ul>
										</div>
										<div class="tt-product-inside-hover">
										<div class="tt-row-btn">
											<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal" data-target="#modalAddToCartProduct">ADD TO CART</a>
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
							<div class="col-6 col-md-4 tt-col-item">
								<div class="tt-product thumbprod-center">
									<div class="tt-image-box">
										<a href="#" class="tt-btn-quickview" data-toggle="modal" data-target="#ModalquickView"	data-tooltip="Quick View" data-tposition="left"></a>
										<a href="#" class="tt-btn-wishlist" data-tooltip="Add to Wishlist" data-tposition="left"></a>
										<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare" data-tposition="left"></a>
										<a href="product.html">
											<span class="tt-img"><img src="images/loader.svg" data-src="images/product/product-14.jpg" alt=""></span>
											<span class="tt-img-roll-over"><img src="images/loader.svg" data-src="images/product/product-14-01.jpg" alt=""></span>
										</a>
									</div>
									<div class="tt-description">
										<div class="tt-row">
											<ul class="tt-add-info">
												<li><a href="#">T-SHIRTS</a></li>
											</ul>
											<div class="tt-rating">
												<i class="icon-star"></i>
												<i class="icon-star"></i>
												<i class="icon-star"></i>
												<i class="icon-star"></i>
												<i class="icon-star"></i>
											</div>
										</div>
										<h2 class="tt-title"><a href="product.html">Flared Shift Dress</a></h2>
										<div class="tt-price">
											$124
										</div>
										<div class="tt-product-inside-hover">
										<div class="tt-row-btn">
											<a href="#" class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal" data-target="#modalAddToCartProduct">ADD TO CART</a>
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