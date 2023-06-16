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
    <title>Add Product</title>
    
    <!-- My scripts -->
    <!-- jquery validation -->

    <!-- jquery -->
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
         <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- jquery validation -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

   
    

    <!-- My scripts -->




    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
        sup{
            color: red;
        }
    </style>
</head>
<script>
    /*function validateForm() {
  let q = document.forms["myform"]["product_name"].value;
  let w = document.forms["myform"]["product_desc"].value;
  let e = document.forms["myform"]["product_stock"].value;
  let r = document.forms["myform"]["product_price"].value;
  let t = document.forms["myform"]["product_discount"].value;
  
  let u = document.forms["myform"]["product_tags"].value;
  if (q == "" && w == "" && e == "" && r == "" && t == ""  && u == "" ) {
    alert("No fields can be left empty");
    return false;
  }
}*/
</script>
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
                            <h1 class="m-0">Add Product</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Add a product</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="products" method="POST" enctype="multipart/form-data">
                            <div class="card-body row p-1 pt-md-2">
                                <div class="col-md-12 d-md-flex">
                                    <div class="form-group col-md-6">
                                        <label>Parent Category in which this product will be shown</label>
                                        <input type="text" name="product_parent" id="product_parent" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="card-body row p-1 pt-md-2">
                                <div class="col-md-12 d-md-flex">
                                    <div class="form-group col-md-6">
                                        <label>Name of the product</label>
                                        <input type="text" name="product_name" id="product_name" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Description</label>
                                        <input type="text" name="product_desc" id="product_desc" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body row p-1">
                                <div class="col-md-12 d-md-flex">
                                    <div class="form-group col-md-6">
                                        <label>Stocks</label>
                                        <input type="number" name="product_stock" id="product_stock"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Price of the Product</label>
                                        <input type="text" name="product_price" id="product_price" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body row p-1">
                                <div class="col-md-12 d-md-flex">
                                    <div class="form-group col-md-6">
                                        <label>Discount in Percentage</label>
                                        <input type="number" name="product_discount" id="product_discount" 
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Delevery Charges</label>
                                        <input type="number" name="deliverycharges" id="deliverycharges" min="0" 
                                            class="form-control">
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="card-body row p-1">
                                <div class="col-md-12 d-md-flex">
                                    <div class="form-group col-md-6">
                                        <label>Product Tags</label>
                                        <input type="text" name="product_tags" id="product_tags" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Images which are to be shown <sup>* Only .jpg and .jpeg formate</sup> </label>
                                        <input type="file" name="product_images[]" id="product_images[]"
                                            class="btn form-control" multiple>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" name="submit" id="add"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>
            </section>
        </div>
    </div>

    </div>
    <!-- /.content-wrapper -->
    <!-- ./wrapper -->
    
    <script>
    $(document).on('click', '#add', function(e) {
        e.preventDefault();
       // alert("it has entered");
        
        $('#products').validate({
            errorClass: "error-message",
            rules: {
                product_parent: "required",
                product_name: "required",
                product_desc: "required",
                product_stock: "required",
                product_price: "required",
                product_discount: { min:0, max:100},
                deliverycharges: {required: true, min:0},
                "product_images[]": "required",
                product_tags: "required"
            },
            messages: {
                product_parent: "Please enter the category in which you want to add",
                product_name: "Please enter your product_name",
                product_desc: "Please enter your Description",
                product_stock: "Please enter your Stocks",
                product_price: "Please enter your Product Price",
                product_discount: {
                    min: "You have to enter a value",
                    max: "The maximum discount value allowed is 100"
                },
                "product_images[]": "You have to Upload atleast one Picture",
                deliverycharges: "Please enter the delivery charges for this product",
                product_tags: "Please enter your tags"
            } 
        });
          var val = $("#products").valid();
          if(val){
            //var data = $("#products").serialize();
            //alert("For the submission of new data type ");

            var dat2 = document.getElementById("products");
            
            var data = new FormData(dat2);
            data.append('action','add');

            // console.log(data);
          
            /*var product = new Product();
            var data1 = product.add_product(data);*/

            $.ajax({
                type: "post",
                url: "queries_product.php",
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                //    console.log(response);
                    // if(response.error_type){
                    //     Swal.fire({
                    //         position: 'top',
                    //         icon: 'warning',
                    //         title: 'Failed to upload the files',
                    //         text: 'ONLY .jpg and .jpeg type files can be uploaded',
                    //         showConfirmButton: false,
                    //         timer: 2000
                    //     })
                     if(response.file_extension_invalid){
                        Swal.fire({
                            position: 'top',
                            icon: 'error',
                            text: 'All files must be of .jpg Or .jpeg',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }else if(response.parent_not_exist){
                        Swal.fire({
                            position: 'top',
                            icon: 'error',
                            text: 'Parent category does not exist',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }else if(response.success) {
                         Swal.fire({
                             icon: 'success',
                             title: 'Success',
                             text: 'Sucessfully Inserted',
                             showCancelButton: true,
                             confirmButtonColor: '#3085d6',
                             cancelButtonColor: '#d33',
                             confirmButtonText: 'Back to where all the products lives',
                             cancelButtonText: 'No, I have more to upload'
                            }).then((result) => {
                            if (result.isConfirmed) {

                             var url = "product_show.php";
                             $(location).attr('href',url);

                            }else if (result.dismiss === Swal.DismissReason.cancel){
                               location.reload(true);
                            }
                        })  
                    }
                }
            });
          }

    });
  


    // function which will use to call or whatever to send the data in oop's style
    /*function Product() {
        this.add_product = function(data) {
            return {
                action: 'add_product',
                data: data
            };
        };
    }*/
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