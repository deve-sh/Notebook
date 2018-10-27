<?php
   session_start();
   include 'inc/config.php';
   include 'inc/salt.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<?php include 'inc/style.php'; ?>
</head>
<body>
	<?php 
	if($_SESSION['noteuserid']!="" && $_SESSION['notelog']==true)
	{
	    include 'sidenav.php'; ?>
		<!-- MENU -->
		<div id='menu'>
					<div class="left"><span class='menuheading'>Notebook!</span></div>
					<div class="right" style="padding: 20px;">
						<?php
						   if($_SESSION['notelog']==true && $_SESSION['noteuserid']!="")
						   {
						   	  echo "<a href='diffsearch.php' target='_blank'><i class=\"fas fa-search\"></i></a>&nbsp&nbsp<a href='userloggedin.php' title='Notes'><i class=\"fas fa-th\"></i></a>&nbsp&nbsp&nbsp<a href='javascript:void(0)'><i class=\"far fa-address-card\" onclick='openusercard()' title='User Info'></i></a>&nbsp&nbsp<a href='changephoto.php' title='Change Photo'><i class=\"fas fa-image\"></i></a> &nbsp&nbsp<a href='logout.php' title='Logout'><i class=\"fas fa-door-open\"></i></a>";
						   }
					    ?>
			</div>
			</div>
		<!-- MENU ENDS, NOTES START -->
		<div id='notes' style="background: #ffffff;">
		<div id='noteset'>
		<div align="center"><form action="" method="post">
			<br><br><input type='password' name='newpassword' placeholder="New Password" class='searchbar' required/>&nbsp&nbsp
			<button type="submit" name="submit" style="border:none;" class="addbutton">Change</button>
			<br>
		</form></div>
		<div align="center">
			<br><div class="divider"></div><br>
		<?php
		    $newpass=$_POST['newpassword'];

		    if($newpass!="")
		    {
		    	$newpass=mysqli_real_escape_string($dbcon,$newpass);

		    	$newpass=crypt($newpass,$salt);
		    	$newpass=md5($newpass);

		    	$usersalt=$salt;

		    	$updater=mysqli_query($dbcon,"UPDATE ".$subscript."users SET password='$newpass',salt='$usersalt' WHERE userid='".$_SESSION['noteuserid']."'");

		    	if($updater)
		    	{
		    		echo "<br><br>Password updated. Kindly Login again.";
		    		header("refresh:3;url=logout.php");
		    		exit();
		    	}
		    	else
		    	{
		    	    echo "<br><br>Password count not be updated. Kindly Try Again.";
		    	}
		    }
	    ?>
		</div>
	</div>
    <?php
    }
    else
    {
    	header("refresh:0;url=index.php");
    	exit();
    }
    ?>
<!--SCRIPTS-->
<script type="text/javascript" src="js/postchange.js"></script>
<script type="text/javascript" src="js/titlechange.js"></script>
<script type="text/javascript" src="js/deleter.js"></script>
<script type="text/javascript" src="js/noteadder.js"></script>
<script type="text/javascript" src="js/sizesetter.js"></script>
<script type="text/javascript" src="js/essonthesearcher.js"></script>
<script type="text/javascript" src="js/usercard.js"></script>
</body>
</html>