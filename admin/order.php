<?php 
session_start();


// var_dump($_SESSION['loggedin']);
if(empty($_SESSION['loggedin'])){
    header('location:login.php');
    die();
}

require 'connection.php';
class Orders {
    function select(){
      require 'connection.php';// ask question that this why after removing the orders.status i am getting nothing in status field
      $stm = $conn -> prepare("SELECT *, orders.status  
      FROM orders
      INNER JOIN customers ON orders.customer_id = customers.id;");
      $stm -> execute();
      $result = $stm -> fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
}
$user = new Orders();
$select = $user -> select();
// echo "<pre>";
//                             print_r($select);
//                             die();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Orders</title>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
            
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="myTable"  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Customer Name</th>
                    <th>Order Id</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Payment ID</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                    <tbody>
                        <?php foreach($select as $rows){ ?>
                        <tr>
                            
                           
                            <td><?= $rows['firstname']; ?></td>
                            <td><?= $rows['order_id']; ?></td>
                            <td><?= $rows['order']; ?></td>
                            <td><?= $rows['quantity']; ?></td>
                            <td><?= $rows['payment_id']; ?></td>
                            <td><?= $rows['address']; ?></td>
                            <td><?= $rows['status']; ?></td>
                            <td><button class="btn btn-danger btn-delete" data-id="<?= $rows['orderid']; ?>">Delete</button></td>
                           
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog"              aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-delete-modal-label">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    Are you sure you want to delete this Order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#myTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true, 
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');
  });

  $(document).ready(function() {
        $('#myTable').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        $('#confirm-delete-modal').modal('show');
        $('#confirm-delete-btn').click(function() {
        
            $.ajax({
                url: 'queries_product.php',
                method: 'POST',
                data: { id: id, action: 'order_delete' },
                success: function(response) {
                    if(response.delete == 200){
                    // Reload the table to reflect the changes
                    $('#myTable').load('order.php .content');
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Successfully deleted',
                        showConfirmButton: false,
                        timer: 1050
                    })
                }
                // Hide the confirmation modal
                $('#confirm-delete-modal').modal('hide');
                }
            });
        });
        });
    });
</script>
</body>
</html>
