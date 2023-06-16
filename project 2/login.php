<?php 
session_start();

if(isset($_SESSION["loggedin"])){

    header('location:dashboard.php');
    die();
}

$error_emailorpassword = NULL;
$error_empty = NULL;

require 'connection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $mail = $_POST['email'];
    $email = filter_var($mail, FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

   if(!empty($mail) && !empty($password)){
    try{
        // process to slect the admin
        $select = $conn -> prepare("SELECT * FROM `admin` WHERE `email` = :email AND `password` = :password");

        $select -> bindValue(':email', $email);
        $select -> bindValue(':password', $password);
        $select -> execute(); 
        
        $result = $select -> fetch(PDO::FETCH_ASSOC);
        
        
        if($result){
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $result['email'];

            header('location:dashboard.php');
        }else{
            $error_emailorpassword = TRUE; // Email or password is wrong
        }
    }catch(PDOEXCEPTION $e){echo $e -> getMessage();}
   } else{ $error_empty = True; } //when both email or password is empty
   

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        .div1 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 95vh;
        }
        
        .div2 h3 {
            text-align: center;
        }
        
        .div2 form {
            border: 2px solid black;
            padding: 20px 20px;
        }
        
        .div3,
        .div4 {
            margin-bottom: 10px;
        }
        
        .div5 {
            display: flex;
            justify-content: center;
        }
        
        .div5 input {
            padding: 5px 20px;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="div1">
        <div class="div2">
            <div class="error">
                <?php if($error_empty){echo "Either your email or password is empty";}  
                    if($error_emailorpassword){echo "Either your mail or password is wrong";}
                ?>
            </div>
            <h3>LOGIN</h3>
            <form method="post" action="">
                <div class="div3">
                    <label for="">Email:-</label>
                    <input type="text" name="email">
                </div>

                <div class="div4">
                    <label for="">Password:-</label>
                    <input type="password" name="password" id="">
                </div>

                <div class="div5">
                    <input type="submit" value="Sign In">
                </div>
            </form>
        </div>
    </div>
</body>

</html>