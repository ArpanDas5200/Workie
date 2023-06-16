<?php
session_start();


// var_dump($_SESSION['loggedin']);
if(empty($_SESSION['loggedin'])){
    header('location:login.php');
    die();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Registration Page</title>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new Admin</p>

      <form id="myform" action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Full name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="cpassword" placeholder="Retype password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required >
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     <!-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->

      <a href="index.php" class="text-center">I am already an admin</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- Jquery &&S AJAX -->
<script>
    $(document).ready(function(){
        $('#myform').on('submit', function(e){
            e.preventDefault();
            var data1 = $(this).serialize();
            var registration = new Registration(); 
            var add = registration.new_admin(data1); 
             $.ajax({
                type: 'POST',
                url: 'queires.php',
                data: add,
                datatype: 'json',
                success: function(response) {
                    // handle the response data
                    // json_decode($response);
                    // var_dump(json_decode($response));

                    //Below are all the server side errors so :(
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Sucessfully registered',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Back to admin panel'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            var url = "index.php";
                            $(location).attr('href',url);
                          }
                        })  
                    } else if (response.failed){
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Looks like you already exists'
                        })
                    } else if(response.error_cp){
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Your password and confirm password didnt matched.'
                        })
                    } else if(response.name_error){
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.name_error
                        })
                    }else if(response.email_error){
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.email_error
                        })
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.password_error
                        })
                    }
                 },
                    error: function(xhr, status, error) 
                    {// handle AJAX errors
                    console.log(xhr.responseText);}
                }) 
         });
    });

    function Registration() {
        this.new_admin = function(data) {
            return {
            action: 'new_admin',
            data: data
            };
        };
    }

</script>





<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
