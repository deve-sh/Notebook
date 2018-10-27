<?php
session_start(); // Make Sure You Have PHP SESSIONS PROPERLY ENABLED IN THE php.ini file.
include 'inc/config.php';
$noteid=$_GET['noteid'];
$userid=$_GET['userid'];
$string=$_GET['string'];

$string=mysqli_real_escape_string($dbcon,$string);
// ESCAPING ANY SINGLE QUOTES OR DOUBLE QUOTES

if($_SESSION['notelog']==true && $userid==$_SESSION['noteuserid'] && $noteid!="" && $userid!="")
{
	$updater=mysqli_query($dbcon,"UPDATE ".$subscript."notes SET content='".$string."' WHERE noteid='$noteid' AND userid='$userid'"); // Timestamp updated automatically.
}

// END

?>