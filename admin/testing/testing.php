<?php 
session_start();


// var_dump($_SESSION['loggedin']);
if(empty($_SESSION['loggedin'])){
    header('location:login.php');
    die();
}

$servername = "localhost";
$dbname = "users";
$usersname = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=users",$usersname, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e){
    Echo "failed" . $e ->getMessage();
}


class Products_all {
    function select(){
            global $conn;
            $stm = $conn -> prepare("SELECT * FROM `products`");
            $stm -> execute();
            return $stm;

    }
}
class Images{
function img($o){
    $temp = array();
                           
    $temp = explode(" & ", $o);
    $temp   = array_filter($temp);
  

    $images = array();
    foreach($temp as $image){
        $images[]="../upload/".trim( str_replace(array('[',']') ,"" ,$image ) );
    }

    return    '<img src="'. $images[0] . '" width="100">'; 
}
}
$some = new Images();



$user = new Products_all();
$select = $user -> select();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All categories</title>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
   <!-- Sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php require "../header/top_nav.php"  ?>
  <!-- /.navbar -->
  <?php require "../header/side_nav.php"  ?>
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Products All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card ">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="myTable"  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   
                    
                    <th>Images</th>
                   
                    
                  </tr>
                  </thead>
                    <tbody>
                        <?php while($rows = $select->fetch(PDO::FETCH_ASSOC)){ ?>
                        <tr>
                            
  
                            
                            <td><?php 
                                $o = $rows['image'];
                                $ima = $some -> img($o);
                                echo $ima; 
                                ?>
                            </td>  
                            
                          




                            
                        
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirm-delete-modal-label">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
      </div>
    </div>
  </div>
</div>
              </div>
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#myTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true, 
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');
  });
        $(document).ready(function() {
          $('#myTable').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            var action = "delete_category";
            $('#confirm-delete-modal').modal('show');
            $('#confirm-delete-btn').click(function() {
            
              $.ajax({
              url: 'queires.php',
              method: 'POST',
              data: { id: id, action: action },
              success: function(response) {
                // Reload the table to reflect the changes
                $('#myTable').load('category_show.php #myTable');
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Successfully deleted',
                showConfirmButton: false,
                timer: 1050
                })
                // Hide the confirmation modal
                $('#confirm-delete-modal').modal('hide');
                }
              });
            });
          });
        });
        


 /* function Category() {
        this.delete_category = function(data) {
            return {
            action: 'delete_category',
            data: data
            };
        };
    }*/
</script>
</body>
</html>