<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';


require 'connection.php';
// print_r();
// die();
$action = $_POST['action'];

if($action == 'add'){
    $product_parent = $_POST['product_parent'];
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_stock = $_POST['product_stock'];
    $product_price = $_POST['product_price'];
    $product_discount = $_POST['product_discount'];
    $deliverycharges = $_POST['deliverycharges'];
    $product_tags = $_POST['product_tags'];

    //to make a slug this function is used
    $slug = new Slug();
    $final_slug =  $slug -> slugify($product_name);

    //To make the files upload we used this and returnsan array
    $images = new Products();
    $myimage = $images -> upload();

  
    //If there is discount then only it will execute other wise 
    if($product_discount != 0){
        $finalprice = discount($product_price,$product_discount);
    }else{ 
        $finalprice = $product_price;
    }

    //Before this we were Cleaning the uploaded files to make sure only jpg and jpeg will get out in form of string.
    if($myimage){
        //Our main insertion query
        $add = new Products();
        $add -> addProduct($product_parent, $product_name, $product_desc, $product_stock, $product_price,$product_discount, $finalprice, $myimage, $final_slug, $product_tags, $deliverycharges);
    }


    // }else{
    //     $response = array('error_type' => true);
    //     header('Content-Type: application/json');
    //     echo json_encode($response);
    // }


}

if($action == 'delete'){
    $id = $_POST['id'];
    $del = new Products();
    $del -> deleteproduct($id);
}
if($action == 'order_delete'){
    $id = $_POST['id'];
    $del = new Order();
    $del -> delete($id);

}

// Slugify function-++---++++*/*/**/ */
class Slug{
    public $product_name;
    function slugify($product_name) {

        // Convert the string to lowercase
        $string = strtolower($product_name);
        
        // Remove any non-alphanumeric characters
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        
        // Remove any leading or trailing hyphens
        $string = trim($string, '-');
      
        // Return the clean slug
        return $string;
    }      
}

//To perform discount based on % give it back
function discount($old_price, $discount){  
    $new_price = $old_price - ($old_price * ($discount/100));
    return $new_price;
}

class Products{
    public $product_name;
    public $product_desc;
    public $product_stock;
    public $product_price;
    public $product_discount;
    public $finalprice;
    public $myimage;
    public $final_slug;
    public $product_tags;

    //For the uploadation of the file in SERVER
    function upload(){

        $total_count = count($_FILES['product_images']['name']);
        $uploaded_files = $_FILES['product_images'];
        $allowed_extensions = array('jpg', 'jpeg');
        $filePaths = array(); 

        foreach ($uploaded_files['name'] as $key => $value) {
            $file_extension = strtolower(pathinfo($value, PATHINFO_EXTENSION));
           
            
            if (!in_array($file_extension, $allowed_extensions)) {
                // The uploaded file has an invalid extension
                $response = array('file_extension_invalid' => true);
                header('Content-Type: application/json');
                echo json_encode($response);
                break;
               
            } else {
                // The uploaded file has a valid extension
                $tmpFilePath = $_FILES['product_images']['tmp_name'][$key];
                $newFilePath = "upload/" . $_FILES['product_images']['name'][$key];
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {

                    // Store the file path in the $filePaths array
                    $filePaths[] = $_FILES['product_images']['name'][$key];
                }
            }
        }

        // If all files have valid extensions, returning the file paths
        if (count($filePaths) == $total_count) {
            return implode(" & ", $filePaths);
        }
    }

    //To Add in the database named products
    function addProduct($product_parent, $product_name, $product_desc, $product_stock, $product_price,$product_discount, $finalprice, $myimage, $final_slug, $product_tags, $deliverycharges){
        //You know what the, in god's name this is and for what it should be used.
        global $conn;

        //This is for the Parent of the product under which this product will be categorized.
        $select = $conn -> prepare("SELECT `id` FROM `category` WHERE `category_name` = :product_parent");
        $select -> bindParam(':product_parent', $product_parent);
        $select -> execute();
        $result = $select -> rowCount();

        if($result > 0){
            $row = $select->fetch();
            $product_parent_id = $row['id'];

            $stmt = $conn -> prepare("INSERT INTO `products` (`id`,`product_parent`,`product_parent_id`, `name`, `description`, `image`, `slug`, `inventory`, `price`, `discount`, `finalprice`, `deliverycharges` ,`tags`) VALUES (Null, :product_parent, :product_parent_id, :product_name, :product_desc, :myimage, :final_slug, :product_stock, :product_price, :product_discount, :finalprice, :deliverycharges ,:product_tags)");

            $stmt -> bindParam(':product_parent', $product_parent);
            $stmt -> bindParam(':product_parent_id', $product_parent_id);
            $stmt -> bindParam(':product_name', $product_name);
            $stmt -> bindParam(':product_desc', $product_desc);
            $stmt -> bindParam(':myimage', $myimage);
            $stmt -> bindParam(':final_slug', $final_slug);
            $stmt -> bindParam(':product_stock', $product_stock);
            $stmt -> bindParam(':product_price', $product_price);
            $stmt -> bindParam(':product_discount', $product_discount);
            $stmt -> bindParam(':finalprice', $finalprice);
            $stmt -> bindParam(':deliverycharges', $deliverycharges);
            $stmt -> bindParam(':product_tags', $product_tags);
            
            $stmt -> execute();
    
            if($stmt){

                $stmt3 = $conn -> prepare("SELECT `id` FROM `products` WHERE `slug` = :final_slug");
                $stmt3 -> bindParam(":final_slug", $final_slug);
                $stmt3 -> execute();
                $result = $stmt3 ->fetch(PDO::FETCH_ASSOC);
                $id_product = $result['id'];
                // print_r($id_product);   
                // die();
                 $count = '0';
                // to insert the page count by default at the time of creation of the product.
                $stmt2 =  $conn -> prepare("INSERT INTO `product_visits`(`id`, `product_id`, `visit_count`) VALUES (null, :product_id, :visit_count)");
                $stmt2 -> bindParam(":product_id", $id_product);
                $stmt2 -> bindParam(":visit_count", $count);
                $stmt2 -> execute();


                $response = array('success' => true);
                header('Content-Type: application/json');
                echo json_encode($response);
            }
            
            
        }else{
           $response = array('parent_not_exist' => true);
           header('Content-Type: application/json');
           echo json_encode($response);
        }
        
       
    }

    function deleteproduct($id){
        global $conn;
        // parse_str($data, $some);
        // $id = $some['id'];
        $sql = "DELETE FROM `products` WHERE `id` = '$id' ";
        $stmt = $conn->prepare($sql);
        $stmt -> execute();
        
    }
}

class Order{
    function delete($id){
        global $conn;
        $stmt1 = $conn -> prepare("SELECT *, orders.status FROM orders INNER JOIN customers ON orders.customer_id = customers.id WHERE `orderid` = :id");
        $stmt1 -> bindParam(":id", $id);
        $stmt1 -> execute();
        $result = $stmt1 ->fetch(PDO::FETCH_ASSOC);

        $order1 = explode(',' , $result['order']);
        $quantity1 = explode(',', $result['quantity']);

      
        foreach($order1 as $i => $product_id){
            $quantity2 = $quantity1[$i];
            $stmt2 = $conn -> prepare("UPDATE `products` SET `inventory` = `inventory` + :quantity WHERE `id` = :product_id;");
            $stmt2 -> bindParam(":quantity", $quantity2);
            $stmt2 -> bindParam(":product_id", $product_id);
            $stmt2 -> execute();
        }

        $message = "Our admin has decided to cancel your order and you will not get your desired products. Don't know why. 
        
        Have a nice day :)";
        $sub = "Your Order id " .$result['order_id']. "has been cancelled.";
        $headers = "From : " . "arpandds@gmail.com";
        $mail = new PHPMailer(true);

        
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            // $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->Username = 'arpandas.dds@gmail.com';
            $mail->Password = 'zuotdetpbhuojnfo';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
    
            // Recipients
            $mail->setFrom('arpandas.dds@gmail.com', 'Wokiee');
            $mail->addAddress($result['email']); // Add recipient email
            // $mail->addReplyTo('arpandas.dds@gmail.com', 'Wokiee');
    
            // Content
            $mail->isHTML(true);
            $mail->Subject = $sub;
            $mail->Body    = $message;
    
            // Send email
            $send = $mail->send();
        if($send){
            $sql = "DELETE FROM `orders` WHERE `orderid` = '$id' ";
            $stmt3 = $conn->prepare($sql);
            $stmt3 -> execute();
    
            $response = array('delete' => 200);
            header('Content-Type: application/json');
            echo json_encode($response);

        }


    }
}

?>



 