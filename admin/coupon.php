<?php 
session_start();
require 'connection.php';

// var_dump($_SESSION['loggedin']);
if(empty($_SESSION['loggedin'])){
    header('location:login.php');
}

// print_r($categories);
// die("dead");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coupon Creation</title>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- jQuery -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--Jquery validation must use this -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .error-message{
            color: red;
        }
    </style>
    
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require 'header/top_nav.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require 'header/side_nav.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Create a Coupon</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Coupon</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6 mx-auto">
                        <div class="card card-primary">

                    <form id="myform" action="" method="post">
                        <div class="card-body">
                         
                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="code"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Minimum value you want to apply</label>
                                <input type="number" name="min_value"  class="form-control" placeholder="If you don't want to have minimum value then enter 0">
                            </div>

                            <div class="form-group">
                                <label>Discount in %</label>
                                <input type="number" name="discount"  class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>Date for the code to expire</label>
                                <input type="date" name="expire"  class="form-control" >
                            </div>

                            <div class="card-footer p-0">
                                <button type="submit" name ="submit" value="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
            </section>
        </div>
    
    </div>
    <!-- /.content-wrapper -->
    <!-- ./wrapper -->
<!-- Jquery && AJAX -->
<script>
    $(document).ready(function() {
        $('#myform').submit(function(e) {
            e.preventDefault();
            // $('#myform').validate({
            //     errorClass: "error-message",
            //     rules: {
            //         code: "required",
            //         min_value: "required",
            //         discount: "required",
            //         expire: "required"
            //     },
            //     messages: {
            //         code: "Please the coupon code ",
            //         min_value: "You have to enter the some value",
            //         discount: "Enter the discount",
            //         expire: "Enter the exipration date"
            //     } 
            // });
            // var val = $("#myform").valid();
            // if(val){
                var data1 = $(this).serialize();
                var category = new Category(); 
                var add = category.edit_category(data1); 
                
                $.ajax({
                    type: 'POST',
                    url: 'queires.php', 
                    data: add,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Sucessfully Inserted',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Back to where it started',
                                cancelButtonText: 'No, I have more to make'
                                }).then((result) => {
                                if (result.isConfirmed) {

                                    var url = "index.php";
                                    $(location).attr('href',url);

                                }else if (result.dismiss === Swal.DismissReason.cancel){
                                    location.reload(true);
                                }
                            }) 
                        }else if(response.error_empty == 400){
                            message = "";
                            $.each(response.error_list,function(i,value){
                                message += value + '\n';
                            })
                            Swal.fire({
                            icon: 'error',
                            title: 'There are some problems with your form filling skills',
                            text: message
                            })
                        }
                    },error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + textStatus);
                    }
                });

            // }
        });
    });

    //function which will use to call or whatever to send the data in oop's style
    function Category() {
        this.edit_category = function(data) {
            return {
            action: 'coupon_create',
            data: data
            };
        };
    }


</script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>