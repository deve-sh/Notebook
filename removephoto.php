<?php
session_start();
include 'inc/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Removing Profile Photo ... </title>
</head>
<body>
	<?php
	   if($_SESSION['notelog']==true && $_SESSION['noteuserid']!="")
	   {
	   	  $finder=mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM ".$subscript."users WHERE userid='".$_SESSION['noteuserid']."'"));

	   	  if(strcmp($finder['image'],"files/default.png")!=0)
	   	  {
	   	  	$updater=mysqli_query($dbcon,"UPDATE ".$subscript."users SET image='files/default.png' WHERE userid='".$_SESSION['noteuserid']."'");
	   	  }
	   	  header("refresh:0;url=userloggedin.php");
	   }
	   else
	   {
	   	  header("refresh:0;url=index.php");
	   	  exit();
	   }
	?>
</body>
</html>