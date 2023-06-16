<?php

$username = 'root';
$password = '';
$connection = new PDO('mysql:host=localhost;dbname=mydb', $username, $password);
if (isset($_POST["action"])) {
    //######################-----For Insert new Record-----#########################//
    if ($_POST["action"] == "Create") {
        $statement = $connection->prepare("INSERT INTO  customers_registration (first_name, last_name, email, password, cpassword, mobileno) 
        VALUES (:first_name, :last_name, :email, :password, :cpassword, :mobileno)");
        $result = $statement->execute(
            array(
                ':first_name' => $_POST["nfname"],
                ':last_name' => $_POST["nlname"],
                ':email' => $_POST["nemail"],
                ':password' => $_POST["npassword"],
                ':cpassword' => $_POST["ncpassword"],
                ':mobileno' => $_POST["nmobileno"]
            )
        );
        if (!empty($result)) {
            echo 'Data Inserted';
        }
    }
    //######################-----For display All Records-----#########################//
    if ($_POST["action"] == "Load") {
        $statement = $connection->prepare("SELECT * FROM customers_registration ORDER BY id DESC");
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        $output .= '
<table style="align:center" class="table table-bordered">
<tr>
<th width="5%">Id</th>
 <th width="15%">First Name</th>
 <th width="15%">Last Name</th>
 <th width="30%">Email</th>
 <th width="15%">Password</th>
 <th width="15%">Confirm-Password</th>
 <th width="10%">Mobile No</th>
 <th width="5%">Update</th>
 <th width="5%">Delete</th>
</tr>
';
        if ($statement->rowCount() > 0) {
            foreach ($result as $row) {
                $output .= '
<tr>
<td>' . $row["id"] . '</td>
 <td>' . $row["first_name"] . '</td>
 <td>' . $row["last_name"] . '</td>
 <td>' . $row["email"] . '</td>
 <td>' . $row["password"] . '</td>
 <td>' . $row["cpassword"] . '</td>
 <td>' . $row["mobileno"] . '</td>
 <td><button type="button" id="' . $row["id"] . '" class="btn btn-warning btn-xs update">Update</button></td>
 <td><button type="button" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete">Delete</button></td>
</tr>
';
            }
        } else {
            $output .= '
<tr>
 <td align="center">Data not Found</td>
</tr>
';
        }
        $output .= '</table>';
        echo $output;
    }
    //######################-----For open popup And Fetch Single Record after click on Update-----#########################//
    if ($_POST["action"] == "Select") {
        $output = array();
        $statement = $connection->prepare(
            "SELECT * FROM customers_registration    
WHERE id = '" . $_POST["id"] . "' 
LIMIT 1"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output["first_name"] = $row["first_name"];
            $output["last_name"] = $row["last_name"];
            $output["email"] = $row["email"];
            $output["password"] = $row["password"];
            $output["cpassword"] = $row["cpassword"];
            $output["mobileno"] = $row["mobileno"];
        }
        echo json_encode($output);
    }
    //######################-----For Update Record-----#########################//
    if ($_POST["action"] == "Update") {
        $statement = $connection->prepare(
            "UPDATE customers_registration 
SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, cpassword = :cpassword,
mobileno = :mobileno WHERE id = :id
"
        );
        $result = $statement->execute(
            array(
                ':first_name' => $_POST["nfname"],
                ':last_name' => $_POST["nlname"],
                ':email' => $_POST["nemail"],
                ':password' => $_POST["npassword"],
                ':cpassword' => $_POST["ncpassword"],
                ':mobileno' => $_POST["nmobileno"],
                ':id'   => $_POST["id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
    //######################-----For Delete Record-----#########################//
    if ($_POST["action"] == "Delete") {
        $statement = $connection->prepare(
            "DELETE FROM customers_registration WHERE id = :id"
        );
        $result = $statement->execute(
            array(
                ':id' => $_POST["id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Deleted';
        }
    }
    //######################-----For Search Record-----#########################//
    if ($_POST["action"] == "Search") {

        $connect = mysqli_connect("localhost", "root", "", "mydb");
        $output = '';
        if (isset($_POST["query"])) {
            $search = mysqli_real_escape_string($connect, $_POST["query"]);
            $query = "SELECT * FROM customers_registration 
  WHERE first_name LIKE '%" . $search . "%'
  OR email LIKE '%" . $search . "%'
  OR mobileno LIKE '%" . $search . "%'
  OR id LIKE '%" . $search . "%'
 ";
        } else {
            $query = "SELECT * FROM customers_registration ORDER BY id";
        }
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '
    <table style="align:center" class="table table-bordered">
    <tr>
    <th width="5%">Id</th>
     <th width="15%">First Name</th>
     <th width="15%">Last Name</th>
     <th width="30%">Email</th>
     <th width="15%">Password</th>
     <th width="15%">Confirm-Password</th>
     <th width="10%">Mobile No</th>
     <th width="5%">Update</th>
     <th width="5%">Delete</th>
    </tr>
 ';
            while ($row = mysqli_fetch_array($result)) {
                $output .= '
        <tr>
        <td>' . $row["id"] . '</td>
         <td>' . $row["first_name"] . '</td>
         <td>' . $row["last_name"] . '</td>
         <td>' . $row["email"] . '</td>
         <td>' . $row["password"] . '</td>
         <td>' . $row["cpassword"] . '</td>
         <td>' . $row["mobileno"] . '</td>
         <td><button type="button" id="' . $row["id"] . '" class="btn btn-warning btn-xs update">Update</button></td>
         <td><button type="button" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete">Delete</button></td>
        </tr>
  ';
            }
            echo $output;
        } else {
            echo '<tr><td colspan="5">Data Not Found</td></tr>';
        }
    }
}
?>