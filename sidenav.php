<?php
session_start();
$curuser=mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM ".$subscript."users WHERE userid='".$_SESSION['noteuserid']."'"));
if($_SESSION['noteuserid']!="" && $_SESSION['notelog']==true)
   {
   	?>
   	<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeusercard()">&times;</a>
		  <br>
		  <div align="center" style="padding: 15px;">
		  	<h3 style="font-family: Montserrat;">User Info</h3>
		  	<br>
		  	<img src=<?php echo $curuser['image']; ?> id='userphoto'>
		  </div>
		  <div align="center" style="padding: 15px;"><div class="menuheading" style="color: #343434;"><?php echo $curuser['name']; ?></div>
		  <br>
		  <div class="divider"></div>
		  <br>
		  <div style="color: #545454;">
		  No of Notes : <?php $num=mysqli_num_rows(mysqli_query($dbcon,"SELECT * FROM ".$subscript."notes WHERE userid='".$curuser['userid']."'")); echo $num; ?>
		  <br><br>
		  <br>
		  <a href='logout.php'><span class="addbutton" style="margin-left: -25px;">Logout</span></a>
		</div>
		</div>
    </div>
   	<?php
   }
?>