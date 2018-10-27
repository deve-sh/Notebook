<?php
session_start();
include 'inc/checker.php';
include 'inc/config.php';
include 'inc/salt.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<?php include 'inc/style.php'; ?>
</head>
<body>
	<div id='installcontainer'>
	<?php
	  if($_SESSION['notelog']==false || $_SESSION['noteuserid']=='')
	  {
	?>

	<form id='installer' action="" method="POST" enctype='multipart/form-data'>
		<h3>Register</h3>
		<input type="text" placeholder="Name" name="name" required/>
		<br/><br/>
		<input type="text" onkeyup="check(this.value)" id='email' onkeydown="check(this.value)" placeholder="Email" name="username" required/>
		<br><br>
		<input type="password" name="password" placeholder="Password" required/>
		<br><br>
		Profile Photo : 
		<input type="file" name="image">
		<Br/><br>
		<button type="submit" class='successfulinstall'>Register</button>
		<br><br>
		<div id='errormessage'>
	</form>
	<?php
	$name=$_POST['name'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$target_dir = "files/";

	if($username!="" && $password!="" && $name!="")
	{

		// Stopping any malicious attempts.
		
		$name=mysqli_real_escape_string($dbcon,$_POST['name']);
	    $username=mysqli_real_escape_string($dbcon,$_POST['username']);
	    $password=mysqli_real_escape_string($dbcon,$_POST['password']);

		$check1=mysqli_num_rows(mysqli_query($dbcon,"SELECT * FROM ".$subscript."users WHERE email='$username'"));

		if($check1>0)
		{
			echo "<br>User already registered. Try another Email Address.<br>";
			$uploadOk=0;
		}
		else
		{
			$usersalt=$salt;
			$password=crypt($password,$usersalt);
			$password=md5($password);

			if(basename($_FILES['image']['name'])=="")
			{
				$target_file="files/default.png";
				$uploadOk=1;
			}
			else
			{
				$filename=explode('.',basename($_FILES['image']['name']));

				$extension=$filename[1];
				$filename=$filename[0];

				$target_file=uniqid();
				$target_file=crypt($target_file,$salt);
				$target_file=md5($target_file);

				$target_file='files/'.$target_file.$filename.'.'.$extension;

				// Generating a completely random filename. UNBREAKABLE!!!

				$target_file=str_replace(' ','_',$target_file);
	   	        
	   	        // Replace all white spaces with an underscore to remove errors.

				$uploadOk = 1;
				$imageFileType = strtolower($extension);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["image"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				}
				// Check if file already exists
				if (file_exists($target_file)) {
				    $target_file=crypt($target_file,$salt);
				    $target_file=md5($target_file);
				    // Recycle hashing.
				}
				// Check file size
				if ($_FILES["image"]["size"] > 5000000) {
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
				    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				    	echo "";
				    } else {
				        echo "Sorry, there was an error uploading your file. Kindly Try Again.";
				    }
				}

			}

			if($uploadOk==1)
			{
				$inserter=mysqli_query($dbcon,"INSERT INTO ".$subscript."users(name,email,salt,password,image) VALUES('$name','$username','$usersalt','$password','$target_file')");

				if($inserter)
				{
					echo "<br>Registration Successful!";
					header("refresh:2;url=index.php");
					exit();
				}
				else
				{
					echo "<br>Registration Unsuccessful.";
				}		
			}
			else
			{
				echo "<br>Registration Failed.";
			}
		}
    ?>
	<?php
		}
	}
	else
	{    
		// Redirect in case the user is already logged in.
			header("refresh:0;url=index.php");
			exit();
	}
	?>
	</div>
</form>
<script type="text/javascript" src="js/register.js"></script>
</body>
</html>
