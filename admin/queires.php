<?php  

require 'connection.php';
error_reporting(0);
$action = $_POST['action'];
$data = $_POST['data'];
$admin = new admin();

//Do you want a new admin or not?????? 
if ($action == 'new_admin'){
   $admin -> registration();
}

// Well this is for new category addition
if ($action == 'add_category') {
    $admin -> addcategory();
}

// Well this is for edittion of the category get it.(edit - tion)
if ($action == 'edit_category') {
    $admin -> editcategory();
}

//And this isto delete the category
if ($action == 'delete_category'){
    $id = $_POST['id'];
    $admin -> deletecategory($id);
}

if($action == 'coupon_create'){
    $validation_rules = array(
        'code' => array(
            'required' => true,
            'error_message' => 'Enter the code.'
        ),
        'discount' => array(
            'required' => true,
            'error_message' => 'Please fill discount.'
        ),
        'min_value' => array(
            'required' => true,
            'error_message' => 'Please fill minimum value.'
        ),
        'expire' => array(
            'required' => true,
            'error_message' => 'Please fill expire date'
        ),

    );

    parse_str($data, $formdata);
    
    $code = $formdata['code'];
    $discount = $formdata['discount'];
    $min_value = $formdata['min_value'];
    $expire = $formdata['expire'];

    $input_fields = array('code' => $code, 'discount' => $discount, 'min_value' => $min_value, 'expire' => $expire);
     
    $validation = new validation();
    $errors = $validation -> validate_input($input_fields,$validation_rules); // this function is present here

    if($errors){
        $response = array('error_empty' => 400, 'error_list' => $errors);
       header('Content-Type: application/json');
       echo json_encode($response);
    }else{
        $admin -> coupon_create();
    }
}

class admin{
    function registration(){
        global $conn;
        global $data;

        parse_str($data, $formdata);
        $name = $formdata['name'];
        $mail = $formdata['email'];
        $email = filter_var($mail, FILTER_VALIDATE_EMAIL);
        $password = $formdata['password'];
        $cpassword = $formdata['cpassword'];
    
        if($password == $cpassword){
            //when any of the feilds are empty these all will help.
            // In short VALIDATION SERVER SIDE :)
            if(empty($name)){
                $response = array('name_error' => 'The name is empty');
                header('Content-Type: application/json');
                echo json_encode($response);
    
            }else if(empty($email)){
                $response = array('email_error' => 'The email is empty');
                header('Content-Type: application/json');
                echo json_encode($response);
    
            }else if(empty($password)){
                $response = array('password_error' => 'The password is empty');
                header('Content-Type: application/json');
                echo json_encode($response);
    
            }else if(!empty($name) && !empty($email) && !empty($password)){
                $stmt1 = $conn -> query("SELECT COUNT(*) FROM `admin` WHERE `email` = '$email' AND `password` = '$password'")->fetchAll();
    
                $count = $stmt1[0][0];
               
                if($count == 0){
    
                    $stmt2 = $conn -> query("INSERT INTO `admin`(`email`, `password`, `name`) VALUES ('$email','$password','$name')");
    
                    $response = array('success' => $stmt2);
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }else{
                    $response = array('failed' => 'You already exists');
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
        }else{
            $response = array('error_cp' => 'password and confirm password are different');
                    header('Content-Type: application/json');
                    echo json_encode($response);
        }
    }

    function addcategory(){
        global $conn;
        global $data;

        parse_str($data, $formdata);
        $name = $formdata['category_name'];
        $description = $formdata['category_description'];
        $parent_id = $formdata['parent_id'];


        if(empty($name) && empty($description)) {
          $response = array('error1' => true);
          echo json_encode($response);
        
        }else if(empty($name)){
              $response = array('error2' => true);
              echo json_encode($response);

        }else if(empty($description)){
            $response = array('error3' =>true);
            echo json_encode($response);

        }else{
            $sql = "INSERT INTO `category`(`id`, `category_name`, `parent_id`,`category_description`) VALUES(Null,    :category_name, :parent_id, :category_description)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category_name', $name);
            $stmt->bindParam(':parent_id', $parent_id);
            $stmt->bindParam(':category_description', $description);
            $stmt->execute();
            
            // Send a response to the AJAX request
            $response = array('success' => true);
            echo json_encode($response);
        }
    }

    function editcategory(){
        global $conn;
        global $data;

        parse_str($data, $formdata);
        $name = $formdata['category_name'];
        $description = $formdata['category_description'];
        $id = $formdata['id'];
        $parent_id = $formdata['parent_id'];
        
        if(empty($name) && empty($description)) {
          $response = array('error1' => 200);
          header('Content-Type: application/json');
          echo json_encode($response);
        
        }else if(empty($name)){
              $response = array('error2' => 200);
              header('Content-Type: application/json');
              echo json_encode($response);
        
        }else if(empty($description)){
              $response = array('error3' => 200);
              header('Content-Type: application/json');
              echo json_encode($response);
        
        }else{
            
            $sql = "UPDATE  category SET `category_name` = :category_name ,`parent_id` = :parent_id,  `category_description` = :category_description WHERE `id` = '$id' ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category_name', $name);
            $stmt->bindParam(':parent_id', $parent_id);
            $stmt->bindParam(':category_description', $description);
            $stmt->execute();
            
            // Send a response to the AJAX request
            $response = array('success' => true);
            echo json_encode($response);
        }
    }

    function deletecategory($id){
        
        global $conn;
        // Delete the record from the database
        $sql = "DELETE FROM `category` WHERE id = $id";
        $conn->query($sql);
    }

    function coupon_create(){
        global $conn;
        global $data;
    
       
            parse_str($data, $formdata);
    
            $code = $formdata['code'];
            $discount = $formdata['discount'];
            $min_value = $formdata['min_value'];
            $expire = $formdata['expire'];
    
            $stmt = $conn->prepare("INSERT INTO `coupon` (`id`, `code`, `mini_value`, `discount`, `expiry`) VALUES (null, :code, :mini_value, :discount, :expiry)");
    
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':mini_value', $min_value);
            $stmt->bindParam(':discount', $discount);
            $stmt->bindParam(':expiry', $expire);
            $stmt->execute();
    
            $response = array('success' => 200);
            header('Content-Type: application/json');
            echo json_encode($response);
       
    }
    
}

class validation {
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
                    }
                }
            }
        }
    
        return $errors;
    }
}

  
?>