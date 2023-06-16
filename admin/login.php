<?php  
session_start();

error_reporting(0);
// $login = $_SESSION['logged'];

// var_dump($_SESSION['logged']);
if(!empty($_SESSION['loggedin'])){
    header('location:index.php');
    die();
}


// // For Error this is another method to show
// $email_pass_error = FALSE;
// $email_error = FALSE;
// $password_error = FALSE;
// $nope = FALSE;

require 'connection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $mail = $_POST['email'];
    $email = filter_var($mail, FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    $some = new adlogin();
    $result = $some -> login($email,$password);
}
class adlogin{
function login($email,$password){
    global $conn;
    if(empty($_POST['email']) && empty($_POST['password'])){
        //echo "<script> alert('Both your email and password is empty.') <script>";
        //$email_pass_error = TRUE;
        return '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
             <strong>Please enter email and password</strong>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
     }
     elseif(($email == "" || $email == null) && ($password != "" || $password != null) ){
         // echo "<script> alert('Your email cannot be left empty') <script>";
         // $email_error = TRUE;
         return  '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
         <strong>Please enter email</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

     }elseif(($email != "" || $email != null) && ($password == "" || $password == null) ){
         // echo "<script> alert('Your password cannot be left empty') <script>";
        //   $password_error = TRUE;
        return  '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
          <strong>Please enter your password</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
 
     }else{
        $stmt = $conn ->query("SELECT COUNT(*) FROM `admin` WHERE `email` = '$email' AND `password` = '$password'") -> fetchAll();

        $stmt2 = $conn ->query("SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$password'") -> fetchAll();
        
        $count = $stmt[0][0];
        if($count > 0){
            $name = $stmt2[0][2];
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $name;
            header('location:index.php');
        }else{
            // echo "<script> alert('you are not register with us') <script>";
            //$nope = TRUE;
            return '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
            <strong>Sorry you are not registered</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <script src="plugins/jquery/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- jQuery -->
    <title>Admin | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
</head>
<body>
 <!-- Errors-->

 <div class="hold-transition login-page">
    <div>
        <?php 
            // if($result = $password_error ){
            //     echo '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
            //     <strong>Please enter your password</strong>
            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            // }
            // if($result = $email_pass_error){
            //     echo '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
            //     <strong>Please enter email and password</strong>
            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            // }
            // if($result = $email_error){
            //     echo '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
            //     <strong>Please enter email</strong>
            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            // }
            // if($result = $nope){
            //     echo '<div  class="alert alert-danger alert-dismissible fade show" role="alert" >
            //     <strong>Sorry you are not registered</strong>
            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            // }
            echo $result;
            ?>
    </div> 
    <!-- /.errors -->
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your work</p>

                <form action="" method="post" >
                <div id="error_message" class="alert alert-danger" style="display: none;">  </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                  Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" name="submit" value="Sign In" id="signin"> 
                          
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <script>
       /* $(document).ready(function() {

            $(document).on('click', '#signin', function(event) {
                // $('#signin').on(''. {

                var emailValue = $('input[name="email"]').val();
                var passwordValue = $('input[name="password"]').val();

                // If both fields are empty
                if (emailValue == '' && passwordValue == '') {
                    alert('Please enter your email and password');
                    // event.preventDefault();
                } else if (emailValue != '' && passwordValue == '') {
                    alert('Please enter your password');
                    // event.preventDefault();
                } else if (emailValue == '' && passwordValue != '') {
                    alert('Please enter your email');
                    // event.preventDefault();
                }
            });

            // $("#btn").live("click", function() {
            //     var email = $("#email").val();
            //     var password = $("#password").val();
            //     $.ajax({
            //         type: "POST",
            //         url: "login.php",
            //         data: "email=" + email + '&password=' + password,
            //     });
            // });
        });*/
    </script>
    <!-- Bootstrap 4 
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
   
</body>
</html>