<?php
session_start();
include 'inc/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<?php include 'inc/style.php'; ?>
</head>
<body>
<?php
   if($_SESSION['noteuserid']!="" && $_SESSION['notelog']==true)
   {
   	include 'sidenav.php';
   	?>
   	   <!-- MENU -->
   	   <div id='menu'>
				<div class="left"><span class='menuheading'>Notebook!</span></div>
				<div class="right" style="padding: 20px;">
					<?php
					   if($_SESSION['notelog']==true && $_SESSION['noteuserid']!="")
					   {
					   	  echo "<a href='userloggedin.php' title='Notes'><i class=\"fas fa-th\"></i></a>&nbsp&nbsp&nbsp<a href='javascript:void(0)'><i class=\"far fa-address-card\" onclick='openusercard()' title='User Info'></i></a>&nbsp&nbsp<a href='changepass.php' title='Change Password'><i class=\"fas fa-user-shield\"></i></a> &nbsp&nbsp<a href='changephoto.php' title='Change Photo'><i class=\"fas fa-image\"></i></a> &nbsp&nbsp<a href='logout.php' title='Logout'><i class=\"fas fa-door-open\"></i></a>";
					   }
				    ?>
		</div>
		</div>
		<!-- MENU ENDS, NOTES START -->
		<div id='notes'>
			<div id='noteset'>
				<br>
				<form method="post" align="center" action="">
					<input type="text" class="searchbar" name="squery" placeholder='Thing to Search' style="padding: 10px; background: #ffffff;" required/>&nbsp&nbsp<button type="submit" class="addbutton" style="border: none; outline: none; font-size: 14px;">Search</button>
				</form>
				<br>
				<div align="center"><div class="divider"></div></div>
				<br>
   	<?

   	$squery=$_POST['squery'];
   	$userid=$_SESSION['noteuserid'];

	   	if($squery!="")
	   	{
	   		$squery=mysqli_real_escape_string($dbcon,$squery);

	   		$finder=mysqli_query($dbcon,"SELECT * FROM ".$subscript."notes WHERE userid='$userid' AND (title LIKE '%$squery%' OR content LIKE '%$squery%') ORDER BY note_date desc LIMIT 0,500");

	   		if(mysqli_num_rows($finder)==0)
	   		{
	   			echo "<br><br><div align='center'>No notes found.</div><br><br>";
	   		}
	   		else
	   		{
	   			while($note=mysqli_fetch_assoc($finder))
	   			{
	   				$notetext="<div class='note' noteid='".$note['noteid']."'>";

		            if($note['title']!="" && $note['content']!="")
		            {
		              $notetext.="<div class='notetitle' contenteditable='true' noteid='".$note['noteid']."' onkeyup=\"titlechange(this.getAttribute('noteid').toString(),this.getAttribute('userid').toString(),this.innerHTML.toString())\" onkeydown=\"titlechange(this.getAttribute('noteid').toString(),this.getAttribute('userid').toString(),this.innerHTML.toString())\" userid='".$note['userid']."'>".$note['title']."</div>";
		            }
		            else if($note['title']!="" && ($note['content']=="" || $note['content']==" "))
		            {
		              $notetext.="<div class='notetitle' contenteditable='true' noteid='".$note['noteid']."' onkeyup=\"titlechange(this.getAttribute('noteid').toString(),this.getAttribute('userid').toString(),this.innerHTML.toString())\" onkeydown=\"titlechange(this.getAttribute('noteid').toString(),this.getAttribute('userid').toString(),this.innerHTML.toString())\" userid='".$note['userid']."'>".$note['title']."</div>";
		            }

		            if($note['content']!="")
		            {
		              $notetext.="<div class='actnote' contenteditable='true' noteid='".$note['noteid']."' userid='".$note['userid']."' onkeyup=\"postchange(this.getAttribute('noteid').toString(),this.getAttribute('userid').toString(),this.innerHTML.toString())\" onkeydown=\"postchange(this.getAttribute('noteid').toString(),this.getAttribute('userid').toString(),this.innerHTML.toString())\">".$note['content']."</div>";
		            }

		            if($note['content']=="" && $note['title']=="")
		            {
		              $notetext="";    // Don't print anything if both the title and content are empty.
		            }
		            else
		            {
		              $notetext.="<div class='noteoptions'><div class='noteleft'>".$note['note_date']."</div><div class='delete' noteid='".$note['noteid']."' onclick=\"deletefunction(this.getAttribute('noteid'),".$_SESSION['noteuserid'].")\" title='Delete Note'><i class=\"material-icons md-18\">delete</i></div></div></div>";
		            }

		            echo $notetext;
	   			}
	   		}
	   	}
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