<?php 
session_start();
require 'connection.php';

// var_dump($_SESSION['loggedin']);
if(empty($_SESSION['loggedin'])){
    header('location:login.php');
    die();
}

$id = $_GET["id"];

//$select = $conn -> query("SELECT * FROM `category` WHERE `id` = '$id' ") -> fetchAll();
function getCategoriesAll(){
    global $conn;
    $stmt = $conn -> prepare("SELECT * FROM `category` ");
    $stmt -> execute();
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function getCategories($id){
    global $conn;
    $stmt = $conn -> prepare("SELECT * FROM `category` WHERE `id` = :id ");
    $stmt -> bindParam(":id", $id);
    $stmt -> execute();
    
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
$category = getCategoriesAll();
$categories = getCategories($id);

// print_r($categories);
// die("dead");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Category</title>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

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
                            <h1 class="m-0">Edit Category</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Edit category</li>
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
                <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?php foreach($categories as $row) { ?>
                <form id="myform" action="" method="post">
                    <div class="card-body">
                    <div class="form-group">
                        
                        <input type="hidden" name="id"  value="<?php echo $row['id']; ?>" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>Name of the category</label>
                        <input type="text" name="category_name" value="<?php echo $row['category_name']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="category_description" value="<?php echo $row['category_description']; ?>" class="form-control" >
                    </div>

                    <!-- For the sub category which will be change   -->
                    <input type="checkbox" name="parent" id="parent" onchange="show_parent_category()">
                    <label for="parent" >Check it if you want to make it a Sub Category </label><br>
                    
                    <!-- The magic happens on this div -->
                    <div class="form-group" id="parent_categories"  style="display:none;">
                            <label for="parent_id">Name of the parent category </label>
                        
                            <select name="parent_id" class="form-control">
                            <option value="0">Select parent category</option>
                            <?php foreach ($category as $cat){ ?>
                                
                                <option value="<?php echo $cat['id'] ?>">
                                <?php echo $cat['category_name'] ?>
                                </option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" name ="submit" value="submit" id="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </section>
            </div>
        </div>
    
    </div>
    <!-- /.content-wrapper -->
    <!-- ./wrapper -->
<!-- Jquery && AJAX -->
<script>
    $(document).ready(function() {
        $('#myform').submit(function(e) {
            e.preventDefault();
            var data1 = $(this).serialize();
            var category = new Category(); 
            var add = category.edit_category(data1); 
            
            $.ajax({
                type: 'POST',
                url: 'queires.php', 
                data: add,
                dataType: 'json',
                success: function(response) {
                     //Below are all the server side errors so :(
                     if (response.success) {
                         Swal.fire({
                             icon: 'success',
                             title: 'Success',
                             text: 'Sucessfully Updated',
                             showCancelButton: false,
                             confirmButtonColor: '#3085d6',
                             confirmButtonText: 'Back to Category table'
                            }).then((result) => {
                           if (result.isConfirmed) {
                             var url = "category_show.php";
                             $(location).attr('href',url);
                           }
                         })  
                     } else if (response.error1 == 200){
                         Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: "Please fill all the details"
                         })
                     } else if(response.error2 == 200){
                         Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'Fill out the name'
                         })
                     } else if(response.error3 == 200){
                        Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'fill out the description'
                         })
                     }
                }
            });
        });
    });

    //function which will use to call or whatever to send the data in oop's style
    function Category() {
        this.edit_category = function(data) {
            return {
            action: 'edit_category',
            data: data
            };
        };
    }
//function to make make it a Sub category
    function show_parent_category(){
        const parent_chekbox = document.getElementById('parent');
        const parent_categories = document.getElementById('parent_categories');
        if(parent_chekbox.checked){
            parent_categories.style.display = "block";
        }else{
            parent_categories.style.display = "none";
        }
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