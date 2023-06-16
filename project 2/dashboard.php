<?php
require "connection.php";
// session_start();


// if(!isset($_SESSION["loggedin"])){
//     header('location:login.php');
//     die();
// }


class user {
    function register($fname,$lname, $email, $phone_no){

        try {
            require "connection.php";
            // $email = filter_val($mail, FILTER_VALIDATE_EMAIL);
            //  Using Prepared statement in PDO 
            // insert query
            $stm1= $conn -> query("SELECT COUNT(*) FROM `users` WHERE `email` = '$email'")->fetchAll();
            // $stm1 -> bindValue(':email', $email, PDO::PARAM_INT);
            // $stm1 -> execute();
            // $num_rows = $stm1 -> fetchColumn();
            $count=$stm1[0][0];

            // $data = $pdo->query("SELECT * FROM `users`")->fetchAll();
            
            if($count == 0){
                $sql = $conn -> prepare("INSERT INTO `users`(`id`, `fname`, `lname`, `email`, `phone_no`) VALUES (NULL, :fname, :lname, :email, :phone_no)");
                $sql -> bindParam(':fname',$fname);
                $sql -> bindParam(':lname',$lname);
                $sql -> bindParam(':email',$email);
                $sql -> bindParam(':phone_no',$phone_no);
        
                $sql -> execute();
            
                return $sql;
            }else{
                echo "This email has already been regestered";
            }
            
        }catch (PDOEXCEPTION $e){
                echo $e -> getMessage() ;
            }
    }

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
if($_SERVER['REQUEST_METHOD'] == "POST"){
   
    if(!empty($_REQUEST["fname"]) && !empty($_REQUEST["lname"]) && !empty($_REQUEST["email"])){
        $register = $user -> register($_REQUEST["fname"], $_REQUEST["lname"],$_REQUEST["email"], $_REQUEST["phone_no"]);
        if($register){
            echo "Successfully registered";
        }else{
            echo "Unsuccessfull to register";
        }
    }else {
        echo "Enter a Valid Phone no";
    }

}else{
    echo "The data cannot be added";
}


$select = $user -> select();

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    <style>
        th, tr, td{
            border: 1px solid black;   
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <label for="">First Name:-</label>
        <input type="text" name="fname" required> <br>

        <label for="">Last Name:-</label>
        <input type="text" name="lname" id="" required><br>

        <label for="">Email:-</label>
        <input type="email" name="email" required> <br>

        <label for="">Phone No:-</label>
        <input type="number" name="phone_no" required > <br>

        <input type="submit" value="Submit">
    </form>


    <table>
        <thead>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone No</th>
        </thead>

        <tbody>
            <?php while($rows = $select->fetch(PDO::FETCH_ASSOC)){ ?>
                
            <tr >
                <td><?php echo $rows["id"] ?></td>
                <td><?php echo $rows["fname"] ?></td>
                <td><?php echo $rows["lname"] ?></td>
                <td><?php echo $rows["email"] ?></td>
                <td><?php echo $rows["phone_no"] ?></td>
            </tr>
            <?php } ?>
         </tbody>
    </table>


    <div>
        <form action="signout.php" method="POST">
            <input type="submit" value="Sign Out">
        </form>
    </div>
</body>

</html>