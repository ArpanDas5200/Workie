<?php
  $host="localhost";
  $username="root";
  $password="";
  $databasename="users";

  $connect=mysqli_connect($host,$username,$password);
  $db=mysqli_select_db($databasename);

  // gets the user IP Address
  $user_ip=$_SERVER['REMOTE_ADDR'];

  $check_ip = mysqli_query("select userip from pageview where page='yourpage' and userip='$user_ip'");
  if(mysqli_num_rows($check_ip)>=1)
  {
	
  }
  else
  {
    $insertview = mysqli_query("insert into pageview values('','yourpage','$user_ip')");
	$updateview = mysqli_query("update totalview set totalvisit = totalvisit+1 where page='yourpage' ");
  }
?>

<html>
<head>
</head>

<body>
  <?php
    $stmt = mysqli_query("select totalvisit from totalview where page='yourpage' ");
  ?>

  <p>This page is viewed <?php echo mysql_num_rows($stmt);?> times.</p>

</body>
</html>