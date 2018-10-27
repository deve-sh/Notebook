<?php
   session_start();
   $handle1=fopen("../inc/confirm.txt","r");

   $string1=fread($handle1,filesize("../inc/confirm.txt"));

   fclose($handle1);

   $handle2=fopen("../inc/config.php","r");

   $string2=fread($handle2,filesize("../inc/config.php"));

   fclose($handle2);

   if($string1!="0" && $string2!="0")
   {
   	$_SESSION['installing']=false;
   	header("refresh:0;url=../index.php");
   }
?>