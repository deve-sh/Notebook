<?php
      session_start();
?>

<!-- MENU STARTS HERE -->

<div id='menu'>
	<div class="left"><span class='menuheading'>Notebook!</span></div>
	<div class="right">
		<?php
		   if($_SESSION['notelog']==true && $_SESSION['noteuserid']!="")
		   {
		   	  echo "<a class='searchicon' href='diffsearch.php' target='_blank'><i class=\"fas fa-search\"></i></a><input class='essonthesearcher' type='text' placeholder='Search' onchange='searchfunc(".$_SESSION['noteuserid'].",this.value)'></span>&nbsp&nbsp&nbsp<a href='javascript:void(0)'><i class=\"far fa-address-card\" onclick='openusercard()' title='User Info'></i></a>&nbsp&nbsp<a href='changepass.php' title='Change Password'><i class=\"fas fa-user-shield\"></i></a> &nbsp&nbsp<a href='changephoto.php' title='Change Photo'><i class=\"fas fa-image\"></i></a> &nbsp&nbsp<a href='logout.php' title='Logout'><i class=\"fas fa-door-open\"></i></a>";
		   	  ?>
	</div>
  </div>
<?php
   }
?>
<!-- MENU ENDS, NOTES BEGIN -->