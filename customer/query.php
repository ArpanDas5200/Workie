<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

session_start();
error_reporting(0);
require 'connection.php';
require 'functions.php';

$action = $_POST['action'];
$data = $_POST['data'];


if($action == "login"){
    $login = new customer();
    $login -> login();
}

if($action == "register"){
    //rules for my Form validation dynamic and SERVER style 
    $validation_rules = array(
        'firstname' => array(
            'required' => true,
           'regex' => true,
            'error_message' => 'Please fill your First-name.',
            'error_message2' => 'Please fill your First-name properly.'
        ),
        'lastname' => array(
            'required' => true,
            'regex' => true,
            'error_message' => 'Your Last name is empty.',
            'error_message2' => 'Fill your last name properly.'
        ),
        'email' => array(
            'required' => true,
            'email' => true,
            'error_message' => 'You have to fill your email.',
            'error_message2' => 'You have to properly fill your email.'
        ),
        'password' => array(
            'required' => true,
            'error_message' => 'You have to fill your password.'
        ),
        'phoneno' => array(
            'required' => true,
            'phone' => true,
            'error_message' => 'You have to give your phone number.',
            'error_message2' => 'You have to properly fill your number.'
        ),
        'address' => array(
            'required' => true,
            'error_message' => 'Your Address field is empty.'
        ),
        'postcode' => array(
            'required' => true,
            'error_message' => 'Your post-code field is empty.'
        ),
        'state' => array(
            'required' => true,
            'regex' => true,
            'error_message' => 'Your state field is empty.',
            'error_message2' => 'Fill your state name properly.'
        ),
        'country' => array(
            'required' => true,
            'regex' => true,
            'error_message' => 'Your country field is empty.',
            'error_message2' => 'Fill your country name properly.'
        ),
        
    );
    
    //We need DATA
    parse_str($data, $formdata);
    $firstname = $formdata['firstname'];
    $lastname = $formdata['lastname'];
    $mail = $formdata['email'];
    $email = filter_var($mail, FILTER_VALIDATE_EMAIL);
    $hash = $formdata['password'];
    $password = md5($hash);
    $phoneno = $formdata['phoneno'];
    $address = $formdata['address'];
    $state = $formdata['state'];
    $postcode = $formdata['postcode'];
    $country = $formdata['country'];


    $input_fields = array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => $hash, 'phoneno' => $phoneno, 'address' => $address, 'state' => $state, 'postcode' => $postcode, 'country' => $country) ;
    
   
   $register = new customer();
   $errors = $register -> validate_input($input_fields,$validation_rules); // this function is present here

   if($errors){
    $response = array('error_empty' => 400, 'error_list' => $errors);
   header('Content-Type: application/json');
   echo json_encode($response);
   }else{
        $register -> register();
   }
    
}

if($action == "filter"){
    $filter = new customer();
    $something = $filter -> filter();  
}

if($action == 'modal'){
    $modal = new query();
    $modal -> modal($data);
}

if($action == 'get_otp' || $action == 'verify_otp'){
    $emailverification = new emailverification();
    $emailverification -> emailVerificationProcess($action,$data,$password);
}

if($action == 'addcart'){
    $inventory = get_inventory_level($data); // You can find this function on function.php
    $cart = new cart();
    $cart -> addtocart($data,$inventory);
}

if($action == 'subtractcart'){
    $inventory = get_inventory_level($data); // You can find this function on function.php
    $cart = new cart();
    $cart -> decrease_to_cart($data,$inventory);
}

if($action == 'remove'){
    $cart = new cart();
    $cart -> removeproduct($data);
}

if($action == 'coupon'){
    $coupon = new coupon();
    $amount = $_POST['amount'];
    $coupon -> coupon($data,$amount);
}


class customer{
    //this is for login-ation of the customer
    function login(){
        global $data;
        global $conn;

        parse_str($data, $formdata);
        $name = $formdata['name'];
        $email = filter_var($name, FILTER_VALIDATE_EMAIL);
        $hash = $formdata['password'];
        $password = md5($hash);

        if($email == null && $hash == null){
            $response = array('both_error' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);

        }elseif(empty($email)){
            $response = array('email_error' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);

        }elseif($hash == null){
            $response = array('password_error' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
        }
        else{

            $stmt2 = $conn -> prepare("SELECT * FROM `customers` WHERE `email` = :email");
            $stmt2 -> bindParam(':email', $name);
            $stmt2 -> execute();
            $result2 = $stmt2 -> fetch(PDO::FETCH_ASSOC);
            $temp1 = $result2['password'];
            $temp2 = $result2['email'];

            if($email == $temp2 && $password != $temp1 ){

                $response = array('password_incorrect' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
                //echo "<br>";
               // $query_email = implode('',$temp1);
            }elseif($email != $temp2){
                $response = array('failed' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
            }else{

                //Main query to enter the page
                $stmt3 = $conn -> prepare("SELECT * FROM `customers` WHERE `email` = :email AND `password` = :password ");
                $stmt3 -> bindParam(':email', $name);
                $stmt3 -> bindParam(':password', $password );
                $stmt3 -> execute();
                $result3 = $stmt3 -> fetch(PDO::FETCH_ASSOC);

                if($result3 == true){
                    $_SESSION['login'] = TRUE;
                    $_SESSION['email'] = $result3['email'];
                    $_SESSION['phoneno'] = $result3['phone_no'];
                    $_SESSION['user_name'] = $result3['firstname'];
                    $_SESSION['address'] = $result3['address'];
                    $_SESSION['status'] = $result3['status'];
                    $_SESSION['id'] = $result3['id'];

                    $response = array('success' => 200);
                    header('Content-Type: application/json');
                    echo json_encode($response);

                }else{
                    $response = array('failed' => 400);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
        }
    }

    // this is for regestration of the new customer
    function register(){
        //global $data;
        global $conn;
        
        // parse_str($data, $formdata);
        global $firstname;
        global $lastname ;
        global $mail ;
        global $email ;
        global $password; 
        global $phoneno ;
        global $address ;
        global $state ;
        global $postcode; 
        global $country ;
        
        // Will only enter if every field is filled
        //if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($hash) && !empty($phoneno) && !empty($address) && !empty($state) && !empty($postcode) && !empty($country)){
            // Server side validation that no more than 2 email and phone_no should be allowed to exist
            $stmt = $conn -> prepare("SELECT `email` FROM `customers` WHERE `email` = :email");
            $stmt -> bindParam(':email', $email);
            $stmt -> execute();
            $count1 = $stmt -> rowCount();
            
            $stmt3 = $conn -> prepare("SELECT `phone_no` FROM `customers` WHERE `phone_no` =:phoneno");
            $stmt3 -> bindParam(':phoneno', $phoneno);
            $stmt3 -> execute();
            $count2 = $stmt3 -> rowCount();
            //  print_r($count1);
            //     print_r($count2);
            //     die();
            
            // Conditions for that
            if($count1 > 0){
                $response = array('sameemail' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
                
            }else if($count2 > 0){
                $response = array('samephoneno' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
                
            }else if($count1 == 0  && $count2 == 0){
                
                $otp = "0";
                $status = 'unverified';
                
                $stmt2 = $conn -> prepare("INSERT INTO `customers`(`id`, `firstname`, `lastname`, `email`, `password`, `otp`, `status`, `phone_no`, `address`, `state`, `postcode`, `country`) VALUES (NULL, :firstname, :lastname, :email, :password, :otp, :statu, :phoneno, :address, :state, :postcode, :country)");
                
                $stmt2 -> bindParam(':firstname', $firstname);
                $stmt2 -> bindParam(':lastname', $lastname);
                $stmt2 -> bindParam(':email', $email);
                $stmt2 -> bindParam(':password', $password);
                $stmt2 -> bindParam(':otp', $otp);
                $stmt2 -> bindParam(':statu', $status);
                $stmt2 -> bindParam(':phoneno', $phoneno);
                $stmt2 -> bindParam(':address', $address);
                $stmt2 -> bindParam(':state', $state);
                $stmt2 -> bindParam(':postcode', $postcode);
                $stmt2 -> bindParam(':country', $country);
                
                $stmt2 -> execute();
               
                
                if($stmt2){
                    $response = array('success' => 200);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }else{
                    $response = array('failed' => 400);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }

       // }else{
            // $response = array('empty' => 400);
            // header('Content-Type: application/json');
            // echo json_encode($response);
        //}
        
    }

    //Validation of the form submission dynamic style
    function validate_input($input_fields, $validation_rules){
        $errors = array();
        
        
        foreach ($input_fields as $field_name => $field_value) {
            
            // Check if the field has a validation rule
            if (isset($validation_rules[$field_name])) {
                $rules = $validation_rules[$field_name];
                
                // Apply each validation rule to the field value
                foreach ($rules as $rule_name => $rule_value) {
                    switch ($rule_name) {
                        case 'required':
                            if ($rule_value && empty($field_value)) {
                                $errors[$field_name] = $rules['error_message'];
                            }
                            break;
                        case 'regex':
                            if (!preg_match('/^[a-zA-Z\s]*$/', $field_value)) {
                                $errors[$field_name] = $rules['error_message2'];
                            }
                            break;
                        case 'email':
                            if ($rule_value && !filter_var($field_value, FILTER_VALIDATE_EMAIL)) {
                                $errors[$field_name] = $rules['error_message2'];
                            }
                            break;
                        case 'phone':
                            if ($rule_value && !preg_match('/^[0-9+\-\(\)\s]*$/', $field_value)) {
                                $errors[$field_name] = $rules['error_message2'];
                            }
                            break;
                       
                    }
                }
            }
        }
    
        return $errors;
    }

    //to filter category and price
    function filter(){
        global $conn;
        //print_r($_POST['sort']);
        
        $sql = "SELECT * FROM `products` WHERE `product_parent_id` != '' ";
        if(isset($_POST['category'])){
            $category = implode("','", $_POST['category']);
            $sql .= " AND `product_parent_id` IN('" . $category . "') ";
        }
        
        //for the price Filter
        if(!empty($_POST['price'])){
            $arr2 = implode(",",$_POST['price']);
            //if user has selected between 0-100
            if(!empty($arr2) && $arr2 == "price1" ){
                $sql .= " AND `finalprice` <= 100";
            
            }elseif(!empty($arr2) && $arr2 == "price2" ){// if user has selected betwwen 100-200
                $sql .= " AND `finalprice` BETWEEN 100 AND 200 ";
           
            }elseif(!empty($arr2) && $arr2 == "price3" ){// if user has selected betwwen 200-300
                $sql .= " AND `finalprice` BETWEEN 200 AND 300 ";

            }elseif(!empty($arr2) && $arr2 == "price1,price2"){// if user has selected both options < 200
                $sql .= " AND `finalprice` <= 200 ";

            }elseif(!empty($arr2) && $arr2 == "price2,price3"){// if user has selected second and third option 
                $sql .= " AND `finalprice` BETWEEN 100 AND 300 ";

            }elseif(!empty($arr2) && $arr2 == "price1,price3"){// if user has selected second and third option 
                $sql .= " AND (`finalprice` BETWEEN 0 AND 100 OR `finalprice` BETWEEN 200 AND 300) ";

            }elseif(!empty($arr2) && $arr2 == "price1,price2,price3"){// if user has selected three/all options < 300
                $sql .= " AND `finalprice` <= 300 ";
            }
        }

        // to sort high to low and vice-versa
        if(!empty($_POST['sort']) && empty($_POST['recent'])){

            $arr3 = implode(",",$_POST['sort']);
            if(!empty($arr3) && $arr3 == "lowtohigh"){
                $sql .= " ORDER BY `products`.`finalprice` ASC ";

            }elseif(!empty($arr3) && $arr3 == "hightolow"){
                $sql .= " ORDER BY `products`.`finalprice` DESC ";

            }
        }

        //for the Recent one and setting the SQL format
        if(!empty($_POST['recent'])){
            if(!empty($_POST['recent']) && $arr3 == "lowtohigh"){
                $sql .= " ORDER BY `products`.`price` ASC, `products`.`created_at` DESC ";

            }elseif(!empty($_POST['recent']) && $arr3 == "hightolow"){
                $sql .= " ORDER BY `products`.`price` DESC, `products`.`created_at` DESC ";

            }else{
                $sql .= " ORDER BY `products`.`created_at` DESC";
            }
        }

        if(!isset($_POST['category']) && empty($_POST['price']) && empty($_POST['sort']) && empty($_POST['recent'])){
            $sql .= "ORDER BY rand() LIMIT 0,6";
        }
       
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $num_rows = count($results);

        //$html = "";
        if($num_rows > 0){
            $response = array('status' => 200, 'data' => $results);
            header('Content-Type: application/json');
            echo json_encode($response);
           
        }else{
            // $html .= "No data found";
            $response = array('status' => 400, 'data' => "NO data is found");
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        // $response = array('html' => $html);
        // header('Content-Type: application/json');
        // echo json_encode($response);
    }

}

class query{
    function modal($id){
        // global $data;
        global $conn;
        //parse_str($data, $formdata);
        // $id = $formdata['data'];
        
        $stmt = $conn -> prepare("SELECT * FROM `products` WHERE `id` = :id");
        $stmt -> bindParam(":id", $id);
        $stmt -> execute();
        $row2 = $stmt -> fetch(PDO::FETCH_ASSOC);
        
        $response = array('status' => 200, 'data' => $row2);
        header('Content-Type: application/json');
        echo json_encode(array($response));
    }
}

class emailverification{
    function emailVerificationProcess($action,$data){
        global $conn;
         $status1 = "unverified";
         $status2 = "verified";
        switch ($action) {
            
            case "get_otp":
                $email = $data;

                //..................to check if there is same email or not + this email[data] is coming from some2.js when the customer have entered their registered email................

                //for the verified customers
                $stmt = $conn -> prepare("SELECT * FROM `customers` WHERE `email` = :email AND `status` = :sus");
                $stmt -> bindParam(":email", $email);
                $stmt -> bindParam(":sus", $status2);
                $stmt -> execute();
                $count = $stmt -> rowCount();

                //For the unverfied customers
                $stmt2 = $conn -> prepare("SELECT * FROM `customers` WHERE `email` = :email AND `status` = :sus");
                $stmt2 -> bindParam(":email", $email);
                $stmt2 -> bindParam(":sus", $status1);
                $stmt2 -> execute();
                $count2 = $stmt2 -> rowCount();

                if($count == 0 && $count2 == 1){

                    $otp = rand(100000, 999999); 
                    // $_SESSION['session_otp'] = $otp;
                    $message = "Your one time email verification code is " . $otp . ". Never share this password with anyone.";
                    $sub = "Email verification from  Wokiee";
                    $headers = "From : " . "arpandds@gmail.com";
                    $mail = new PHPMailer(true);

                    try {
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
                        $mail->addAddress($email); // Add recipient email
                        // $mail->addReplyTo('arpandas.dds@gmail.com', 'Wokiee');
                
                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = $sub;
                        $mail->Body    = $message;
                
                        // Send email
                        $send = $mail->send();
                        if($send){
                            // //when the Customer have entered email first time and unverified
                            // if($count == 0 && $count2 == 0){

                            //     $stmt = $conn -> prepare("INSERT INTO `customers` (`email`, `otp`, `status`) VALUES (:email, :otp, :sus)");
                            //     $stmt -> bindParam(":email", $email);
                            //     $stmt -> bindParam(":otp", $otp);
                            //     $stmt -> bindParam(":sus", $status1);
                            //     $stmt -> execute();
                            
                            //     $response = array('status' => 200);
                            //     header('Content-Type: application/json');
                            //     echo json_encode($response);

                            // }else
                            if($count2 == 1) { // When the customer have entered the email and unverified
                            
                                $stmt = $conn -> prepare("UPDATE `customers` SET `otp` = :otp, `status` = :statu  WHERE `email` = :email");
                                $stmt -> bindParam(":email", $email);
                                // $stmt -> bindParam(":password", $hash);
                                $stmt -> bindParam(":otp", $otp);
                                $stmt -> bindParam(":statu", $status2);
                                
                                $stmt -> execute();
                            
                                $response = array('status' => 200);
                                header('Content-Type: application/json');
                                echo json_encode($response);
                            }
                        }

                    } catch (Exception $e) {
                        $response = array('status' => 400);
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    }

                }elseif($count == 0 && $count2 == 0){ // When the email is not found in the database of customers.
                    $response = array('emailnotfound' => 400);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }else {
                    $response = array('pre_verified' => 200);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
                break;
 
                
            case "verify_otp":
                $otp = $_POST['data'];
                $email = $_POST['email'];
                // print_r($email);
                $stmt = $conn -> prepare("SELECT * FROM `customers` WHERE `email` = :email AND `otp` = :otp");
                $stmt -> bindParam(":email", $email);
                $stmt -> bindParam(":otp", $otp);
                $stmt -> execute();
                $row = $stmt -> rowCount();
              

                if ($row == 1){// When otp is right
                    $stmt = $conn -> prepare("UPDATE `customers` SET  `status` = :sus  WHERE `email` = :email");
                    $stmt -> bindParam(":email", $email);
                    $stmt -> bindParam(":sus", $status2);
                    $stmt -> execute();
                    

                    $response = array('verified' => 200);
                    header('Content-Type: application/json');
                    echo json_encode($response);

                }else{// When the OTP is Entered wrong
                    $response = array('verified' => 500);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
                break;
        }
    }
}

class cart{
    function addtocart($id, $inventory, $quantity = 1 ){
               
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['id'] == $id) {
                // print_r("1");
                // To check the stocks
                if ($product['quantity'] + $quantity > $inventory) {
                    // print_r("2");
                    $response = array('stocks' => 400);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }
                // print_r("3");
              
                $product['quantity'] += $quantity;
                // print_r($product['quantity']);
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            // print_r("4");
            // To check the stocks
            if ($quantity > $inventory) {
                // print_r("5");
                $response = array('stocks' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
                return;
            }
            // print_r("6");
            $_SESSION['cart'][] = array('id' => $id, 'quantity' => $quantity);
        }
        // print_r("7");
        $response = array('success' => 200);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    function decrease_to_cart($id, $inventory, $quantity = -1){
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['id'] == $id) {
                // print_r("1");
                // To check the stocks
                if ($product['quantity'] + $quantity > $inventory) {
                    // print_r("2");
                    $response = array('stocks' => 400);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }
                // print_r("3");
              
                $product['quantity'] += $quantity;
                // print_r($product['quantity']);
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            // print_r("4");
            // To check the stocks
            if ($quantity > $inventory) {
                // print_r("5");
                $response = array('stocks' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
                return;
            }
            // print_r("6");
            $_SESSION['cart'][] = array('id' => $id, 'quantity' => $quantity);
        }

        $empty = false;
        foreach ($_SESSION['cart'] as $index => &$product) {
            //  print_r("7");
            if ($product['quantity'] <= 0) {
                //  print_r("8");
                unset($_SESSION['cart'][$index]);
                $empty = true;
            }
        }

        // print_r("7");
        $response = array('success' => 200);
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function removeproduct($id){

        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] == $id) {
            unset($_SESSION['cart'][$index]);
            $response = array('success' => 200);
            header('Content-Type: application/json');
            echo json_encode($response);
            }
        }
        
          
    }

}

class coupon{
    function coupon($coupon,$amount){
        global $conn;
        $dates = date('Y-m-d');

        if(empty($coupon)){
            $response = array('coupon' => 400);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{

            $stmt = $conn -> prepare("SELECT * FROM `coupon` WHERE `code` = :coupon AND `mini_value` <= :amount AND `expiry` >= :dates ");

            $stmt -> bindParam(":coupon", $coupon);
            $stmt -> bindParam(":amount", $amount);
            $stmt -> bindParam(":dates", $dates);
            $stmt -> execute();
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);

            if($result){
                $_SESSION['coupon'] = "applied";

                $discount = $result['discount'];
                $final_price = round($amount - ($amount * ($discount/100)), 2);

                $response = array('code' => 200, 'final_price' => $final_price);
                header('Content-Type: application/json');
                echo json_encode($response);
            }else{
                $response = array('code' => 400);
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    }
}
?>