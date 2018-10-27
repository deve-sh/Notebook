<?php
   session_start();
   include 'checker.php';
   $_SESSION['installing']=true;
   // include 'checker.php'; // Redirect if script is already installed.
?>
<!DOCTYPE html>
<html>
<head>
	<title>Install Script</title>
	<?php include '../inc/installstyle.php'; ?>
</head>
<body>
   <div id='installcontainer' style="background: #efefef url('../files/background.jpeg');" align="center">
   	 <form action="installer.php" method="post" id='installer'>
   	 	<br>
   	 	<h1>Install Script</h1>
   	 	<br>
   	 	<input type="text" name='host' placeholder="Host" align="center" required/>
   	 	<br><br>
   	 	<input type="text" name="username" placeholder="Host Username" align="center" required/>
   	 	<br><br>
   	 	<input type="password" name="password" placeholder="Password">
   	 	<br><br>
   	 	<input type='text' name="subscript" placeholder="Subscript For Table Names (Default : notebook_)">
   	 	<br><br>
   	 	<input type="text" name="dbname" placeholder="Database Name">
   	 	<br><br>
   	 	<button type="submit" class="successfulinstall">INSTALL</button>
   	 </form>
   </div>
</body>
</html>
