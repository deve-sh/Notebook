<?php
   session_start();

   include 'checker.php';

   if($_SESSION['installing']!=true)
   	  header("refresh:0;url=index.php");
   else
   {
   	?>
   	   <!DOCTYPE html>
   	   <html>
   	   <head>
   	   	<title>Installing Script</title>
   	   	<?php include '../inc/installstyle.php'; ?>
   	   </head>
   	   <body>
   	   <div id='installcontainer'>
   	   	<div id='installer'>
   	   <?php
   	       $host=$_POST['host'];
   	       $username=$_POST['username'];
   	       $password=$_POST['password'];
   	       $dbname=$_POST['dbname'];
   	       $subscript=$_POST['subscript'];

   	       if($subscript=="")
   	       {
   	       	$subscript="notebook_";
   	       }

   	       $count=0;

   	       if($host!="" && $username!="" && $password!="" && $dbname!="" && $subscript!="")
   	       {

   	       	/* Database Connection First */

   	       	  $dbcon=mysqli_connect($host,$username,$password,$dbname) or die("<br><br>Could not connect to database.");
   	       	  
   	       	  if($dbcon)
   	       	  {
   	       	      $query1="DROP TABLE IF EXISTS ".$subscript."notes";

	   	       	  $query2="DROP TABLE IF EXISTS ".$subscript."users";

	   	       	  $query3="CREATE TABLE ".$subscript."users(userid integer primary key auto_increment,name text not null,email varchar(255) unique not null,salt varchar(200) not null,password varchar(255) not null,image varchar(255))";

	   	       	  $query4="CREATE TABLE ".$subscript."notes(noteid integer primary key auto_increment,userid integer references ".$subscript."users(userid) on delete cascade on update set null,title text,content text not null),note_date timestamp";

	   	       	  $exec1=mysqli_query($dbcon,$query1);

	   	       	  if($exec1)
	   	       	  {
	   	       	  	echo "<br><br>Deleting Previously Existing Notes Table.";
	   	       	  	$count++;
	   	       	  }

	   	       	  $exec2=mysqli_query($dbcon,$query2);
	   	       	  
	   	       	  if($exec2)
	   	       	  {
	   	       	  	echo "<br><br>Deleting Previously Existing Users Table.";
	   	       	  	$count++;
	   	       	  }

	   	       	  $exec3=mysqli_query($dbcon,$query3);

	   	       	  if($exec3)
	   	       	  {
	   	       	  	echo "<br><br>Creating User Table.";
	   	       	  	$count++;
	   	       	  }

	   	       	  $exec4=mysqli_query($dbcon,$query4);

	   	       	  if($exec4)
	   	       	  {
	   	       	  	echo "<br><br>Creating Notes Table.";
	   	       	  	$count++;
	   	       	  }

	   	       	  if($count==4)
	   	       	  {
	   	       	  	echo "<br><br>The script was successfully installed. <br><br>
	   	       	  	<a href='../index.php'><button class='successfulinstall'>Check out your script</button></a>";
	   	       	  }
	   	       	  else
	   	       	  {
	   	       	  	echo "<br><br>Could not install the script.<br><br>
	   	       	  	Kindly Try Again.";
	   	       	  }
   	       	  }
   	       	  
                 // Writing files now.

                 $file1=fopen("../inc/confirm.txt","w");

                 fwrite($file1,"1");

                 fclose($file1);

                 // Configuration Setting Strings

                 $configstring="<?php\n\n error_reporting(0);\n\n   \$host=\"".$host."\";\n    \$username=\"".$username."\";\n    ";
                 $configstring.="\$password=\"".$password."\";\n    \$dbname=\"".$dbname."\";\n    ";
                 $configstring.="\$subscript=\"".$subscript."\";\n    ";
                 $configstring.="\$dbcon=mysqli_connect(\$host,\$username,\$password,\$dbname);\n?>";

                 $file2=fopen("../inc/config.php", "w");

                 fwrite($file2,$configstring);

                 fclose($file2);

   	       }
   	       else
   	       {
   	       	echo "<br><br>Kindly enter the values again.";
   	       }
   	     ?>
   	     </div>
   	   </div>
   	   </body>
   	   </html>
   	<?
   }
?>