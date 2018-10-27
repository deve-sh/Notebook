<?php
session_start();
include 'inc/config.php';
$userid=$_GET['userid'];
$content=$_GET['content'];
$title=$_GET['title'];
  // Timestamp

$title=mysqli_real_escape_string($dbcon,$title);
$content=mysqli_real_escape_string($dbcon,$content);

if($userid==$_SESSION['noteuserid'] && $_SESSION['notelog']==true && $userid!="")
{
    $insert=mysqli_query($dbcon,"INSERT INTO ".$subscript."notes(userid,title,content) VALUES('$userid','".$title."','".$content."')");

}

?>