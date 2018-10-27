<?php
session_start();
include 'inc/config.php';
$userid=$_GET['userid'];
$noteid=$_GET['noteid'];

if($_SESSION['notelog']==true && $_SESSION['noteuserid']==$userid && $userid!="" && $noteid!="")
{
	$deleter=mysqli_query($dbcon,"DELETE FROM ".$subscript."notes WHERE userid='$userid' AND noteid='$noteid'");
}
// End
?>