<?php
session_start();
$_SESSION['noteuserid']="";
$_SESSION['notelog']=false;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logging Out..</title>
</head>
<body>
<?php
session_unset();
session_destroy();
header("refresh:0;url=index.php");
exit();
?>
</body>
</html>