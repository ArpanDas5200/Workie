<?php  
session_start();
$login = $_SESSION['loggedin'];
if($login == "" || $login == null){
    header('location:login.php');
    die();
}


// if(!isset($_SESSION['logged'])){
//     header('location:login.php');
// }


session_unset();
session_destroy();

header('location:login.php');


?>
