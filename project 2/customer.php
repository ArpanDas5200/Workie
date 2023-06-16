<?php
require "connection.php";


class user {
    function select(){
        try{
            require "connection.php";
            $stm = $conn -> prepare("SELECT * FROM `users`");
            $stm -> execute();
            return $stm;
        }catch(PDOEXCEPTION $e){echo $e -> getMessage();}
    }
}
$user = new user();



$select = $user -> select();

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css"> 
     <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

     
</head>

<body>
   
    <table id="myTable" class="table table-hover " style="width:100%; ">
        <thead>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone No</th>
        </thead>

        <tbody>
            <?php while($rows = $select->fetch(PDO::FETCH_ASSOC)){ ?>
                
            <tr>
                <td> <?php echo $rows["id"] ?></td>
                <td> <?php echo $rows["fname"] ?></td>
                <td> <?php echo $rows["lname"] ?></td>
                <td> <?php echo $rows["email"] ?></td>
                <td> <?php echo $rows["phone_no"] ?></td>
            </tr>
            <?php } ?>
         </tbody>
       
    </table>


    <script type="text/javascript">
            $(document).ready(function () {
            //   alert("testing mic one ");
                $('#myTable').DataTable();
            });
    </script>
   
</body>

</html>