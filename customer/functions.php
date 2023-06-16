<?php 
//Tou know why this used :<
function get_inventory_level($id){
    global $conn;
    $stmt = $conn -> prepare("SELECT `inventory` FROM `products` WHERE `id` = :id");
    $stmt -> bindParam(":id", $id);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result['inventory'];
}

//To show the images And this function will show first images which was uploaded
function img($o){
    $temp = array();
                           
    $temp = explode(" & ", $o);
    $temp   = array_filter($temp);
    
    $images = array();
    foreach($temp as $image){
        $images[]="upload/".trim( str_replace(array('[',']') ,"" ,$image ) );
    }

    return    '<img src="../admin/'. $images[0] . '" width="100%" height="auto%"  class="loaded" data-was-processed="true">';
}

function img_all($o){
    $temp = array();
                           
    $temp = explode(" & ", $o);
    $temp   = array_filter($temp);
    
    $images = array();
    foreach($temp as $image){
        $images[]="../admin/upload/".trim( str_replace(array('[',']') ,"" ,$image ) );
    }

    return  $images;
}

//Function To set New price based on discount
function price($old,$dis){
    $old_price = $old;
    $discount = $dis;   
    $new_price = $old_price - ($old_price * ($discount/100));
    return $new_price;
}

//function to show the products based on id
function viewproduct($id){
    global $conn;
    $stmt = $conn -> prepare("SELECT * FROM `products` WHERE `id` = :id");
    $stmt -> bindParam(":id", $id);
    $stmt -> execute();
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $row;
}

//View products based on slug
function getSlug($slug){
    global $conn;
    $stmt = $conn -> prepare("SELECT * FROM `products` WHERE `slug` = :slug ");
    $stmt -> bindParam(":slug", $slug);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $result;
}

// to Fetch the tags from the data base
function tags($input){
    $array = explode("," , $input);
    return $array;
}

//To check whter the products are new or not
function is_new($created_at) {
    $timestamp = strtotime($created_at);
    
    $cutoff_timestamp = strtotime('-5 days');
    
    if($timestamp >= $cutoff_timestamp) {
        return true;
    } else {
        return false;
    }
}




class products{
  
    // to show new products on the HomePage
    function newproduct(){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM `products` WHERE created_at >= :cutoff_date ORDER BY rand() LIMIT 0,10");

        $cutoff_date = date('Y-m-d', strtotime('-7 days')); 
        $stmt -> bindParam(":cutoff_date", $cutoff_date);
        $stmt -> execute();
        $new_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $new_products;
    }

    function saleproduct(){
        global $conn;

        $stmt = $conn -> query("SELECT * FROM `products` WHERE `discount` > '50' ORDER BY rand() LIMIT 0,10");

        // $cutoff_date = date('Y-m-d', strtotime('-7 days')); 
        // $stmt -> bindParam(":cutoff_date", $cutoff_date);
        $stmt -> execute();
        $saleproduct = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $saleproduct;
    }

    function most_viewed(){
        global $conn;

        $stmt = $conn -> query("SELECT products.*
        FROM products
        INNER JOIN product_visits
        ON products.id = product_visits.product_id
        ORDER BY product_visits.visit_count DESC LIMIT 0,10");
        $stmt -> execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    //After placing order this function will ensure that it has been deducted from the inventory
    function update_quantity($order, $quantity){
        global $conn;

        $order1 = explode(',' , $order);
        $quantity1 = explode(',', $quantity);

        foreach($order1 as $i => $product_id){
            $quantity2 = $quantity1[$i];
            $stmt = $conn -> prepare("UPDATE `products` SET `inventory` = `inventory` - :quantity WHERE `id` = :product_id;");
            $stmt -> bindParam(":quantity", $quantity2);
            $stmt -> bindParam(":product_id", $product_id);
            $stmt -> execute();
        }
    }
}



// to check wheather that ip user exists in the user_visits
function ip_exists($product_id, $user_ip){
    global $conn;
    
	$stmt = $conn->prepare("SELECT user_ip, product_id FROM `user_visits` WHERE user_ip = :user_ip AND `product_id` = :product_id");
    $stmt->bindParam(':user_ip', $user_ip);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    $result =  $stmt -> fetch(PDO::FETCH_ASSOC);
    
    // try{
    // // if the ip of the user exist then it will update the data into the user_visits
    if($result ) {

       $stmt2 = $conn-> prepare("UPDATE `user_visits` SET `visit_count` = visit_count+1 WHERE `product_id` = :product_id AND `user_ip` = :user_ip");
        $stmt2 -> bindParam(":product_id", $product_id);
        $stmt2 -> bindParam(":user_ip", $user_ip);
        $stmt2 -> execute();
        // print_r($stmt2);
        // die("result wala");
        
    } else {// if not then he/she is a new visitor therefore update the product_visits
       
        $stmt3 = $conn-> prepare("UPDATE `product_visits` SET `visit_count` = visit_count+1 WHERE `product_id` = :product_id ");
        $stmt3 -> bindParam(":product_id", $product_id);
        $stmt3 -> execute();
        // print_r($stmt3);
        // die("product_visit wala");
        // echo($stmt3 -> rowCount());
        // echo "<br>";
        
        $count1 = '1';
        $stmt4 = $conn -> prepare("INSERT INTO `user_visits` ( `product_id`, `user_ip`, `visit_count`) VALUES ( :product_id2, :user_ip2, :count1)");
        // $stmt4 -> bindParam(":id", null);
        $stmt4 -> bindParam(":product_id2", $product_id);
        $stmt4 -> bindParam(":user_ip2",$user_ip);
        $stmt4 -> bindParam(":count1", $count1);
        $stmt4 -> execute();

        // echo ($stmt4 -> rowCount());
        // die("dead");
    }
// } catch(PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }
}

class All{
    
    function show(){
        global $conn;
        $stmt = $conn -> prepare("SELECT * FROM `products` ORDER BY rand() LIMIT 0,6");
        $stmt -> execute();
        return $stmt;
    }

	function category_show(){
		global $conn;
		$stmt2 = $conn -> prepare("SELECT * FROM `category`");
		$stmt2 -> execute();
		return $stmt2;
	}

    function search($search){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM `products` WHERE `product_parent` LIKE '%$search%' OR `name` LIKE '%$search%'");

        // $stmt = $conn->prepare("SELECT * FROM `products` WHERE `product_parent` LIKE ? OR `name` LIKE ?");
        // $searchParam = "%" . $search . "%";
        // $stmt->bindParam("ss", $searchParam, $searchParam);

        $stmt -> execute();
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

class orders{
    function addtodatabase($id, $orderid, $order, $quantity, $paymentid, $signatureid ){
        global $conn;

        // $stmt = $conn -> prepare("SELECT * FROM `orders` WHERE `order_id` = :orderid, `payment_id` = :paymentid, `signature_id` = :signatureid)");

        // $stmt -> bindParam(":id", $id);
        // $stmt -> bindParam(":orderid", $orderid);
        // $stmt -> bindParam(":paymentid", $paymentid);
        // $stmt -> bindParam(":signatureid", $signatureid);

        // $stmt -> execute();
        // $row = $stmt -> fetch(PDO::ASSOC);

        // if($row ){
           $status = "incomplete";
            $stmt2 = $conn -> prepare("INSERT INTO `orders`(`orderid`, `customer_id`, `order_id`, `order`, `quantity`, `payment_id`, `signature_id`, `status`, `add_on`) VALUES (null, :id, :orderid, :order, :quantity, :paymentid, :signatureid, :status, NOW())");

            $stmt2 -> bindParam(":id", $id);
            $stmt2 -> bindParam(":orderid", $orderid);
            $stmt2 -> bindParam(":order", $order);
            $stmt2 -> bindParam(":quantity", $quantity);
            $stmt2 -> bindParam(":paymentid", $paymentid);
            $stmt2 -> bindParam(":signatureid", $signatureid);
            $stmt2 -> bindParam(":status", $status);
            // $stmt2 -> bindParam(":datetime", $datetime);

            $stmt2 -> execute();
        // }
    }
 
}


?>