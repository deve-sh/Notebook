<?php
   session_start();
   include 'inc/config.php';
   include 'inc/salt.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Photo</title>
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
						   	  echo "<a href='diffsearch.php' target='_blank'><i class=\"fas fa-search\" title='Search'></i></a>&nbsp&nbsp<a href='userloggedin.php' title='Notes'><i class=\"fas fa-th\"></i></a>&nbsp&nbsp&nbsp<a href='javascript:void(0)'><i class=\"far fa-address-card\" onclick='openusercard()' title='User Info'></i></a>&nbsp&nbsp<a href='changepass.php' title='Change Password'><i class=\"fas fa-user-shield\"></i></a> <a href='logout.php' title='Logout'><i class=\"fas fa-door-open\"></i></a>";
						   }
					    ?>
			</div>
			</div>
		<!-- MENU ENDS, NOTES START -->
		<div id='notes' style="background: #ffffff;">
		<div id='noteset'>
		<div align="center">
			<form action="" method="POST" enctype="multipart/form-data">
				<input type="file" class='searchbar' name="photo" required/>
				&nbsp&nbsp<button type="submit" name='submit' style="border:none;" class="addbutton">CHANGE</button>
			</form>
			<br>
			Or...
			<a href='removephoto.php'><div class="addbutton">Remove Current Profile Photo</div></a>
			<br><br>
			<div class="divider"></div>
	<?php
	if(isset($_POST['submit']) && isset($_FILES["photo"]))
	   {
	   	  $uploadOk=1;

	   	  $filename=basename($_FILES["photo"]['name']);

	   	  $filename=explode('.',$filename);
	   	  $extension=$filename[1]; // Extension
	   	  $filename=$filename[0]; // Got filename

	   	  // UNBREAKABLE ENCRYPTED NAME

	   	  $target_file=uniqid();
	   	  $target_file=crypt($target_file,$salt);
	   	  $target_file=md5($target_file);

	   	  $target_file='files/'.$filename.$target_file.'.'.$extension;

	   	  $target_file=str_replace(' ','_',$target_file);
	   	   // Replace all white spaces with an underscore to remove errors.

	   	  $uploadOk = 1;
				$imageFileType = strtolower($extension);
				// Check if image file is a actual image or fake image
				
				    $check = getimagesize($_FILES["photo"]["tmp_name"]);
				    if($check !== false) {
				       $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }

				// Check if file already exists
				if (file_exists($target_file)) {
				    $target_file=crypt($target_file,$salt);
				    $target_file=md5($target_file);
				    // Recycle hashing.
				}
				// Check file size
				if ($_FILES["photo"]["size"] > 5000000) {
				    echo "Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
				    	echo "";
				    } else {
				        echo "Sorry, there was an error uploading your file. Kindly Try Again.";
				    }
				}

			if($uploadOk==1)  // If file was successfully uploaded.
			{
				$memory=mysqli_fetch_assoc(mysqli_query($dbcon,"SELECT * FROM ".$subscript."users WHERE userid='".$_SESSION['noteuserid']."'"));

				$previmage=$memory['image'];

				$updater=mysqli_query($dbcon,"UPDATE ".$subscript."users SET image='$target_file' WHERE userid='".$_SESSION['noteuserid']."'");

				if($updater)
				{
					if(strcmp($previmage,"files/default.png")!=0)
					{
						unlink($previmage);   // Delete previously uploaded file. Cool.
					}

					echo "<br><br>Photo Updated.<br/>";
					header("refresh:2;url=userloggedin.php");
					exit();
				}
				else
				{
					echo "<br>Photo Could Not Be updated.";
				}
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



<!-- SCRIPTS -->
<script type="text/javascript" src="js/postchange.js"></script>
<script type="text/javascript" src="js/titlechange.js"></script>
<script type="text/javascript" src="js/deleter.js"></script>
<script type="text/javascript" src="js/noteadder.js"></script>
<script type="text/javascript" src="js/sizesetter.js"></script>
<script type="text/javascript" src="js/essonthesearcher.js"></script>
<script type="text/javascript" src="js/usercard.js"></script>
</body>
</html>