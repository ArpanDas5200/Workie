<?php 

parse_str($data, $some);
$id = $some['id'];
require 'connection.php';
$sql = "DELETE FROM `category` WHERE `id` = '$id' ";
$stmt = $conn->prepare($sql);
$stmt -> execute();
header('location:category_show.php');
?>