<?php
   $handle1=fopen("inc/confirm.txt","r");

   $string1=fread($handle1,filesize("inc/confirm.txt"));

   $handle2=fopen("inc/config.php","r");

   $string2=fread($handle1,filesize("inc/config.php"));

   if($string1=="0" || $string2=="0")
   {
   	header("refresh:0;url=install");
   }
?>