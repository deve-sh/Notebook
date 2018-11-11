<?php
  session_start();
  $_SESSION['installing']=false;
  include 'inc/config.php';
  include 'inc/checker.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Notebook!</title>
  <?php include 'inc/style.php'; ?>

</head>
<body>
  <div id='installcontainer' align="center">
    <div id='left'>
      <span class='introducetext'>Notebook!</span>
    </div>
    <div id='homepagecont'>
    <div id='installer' align="center">
      <?php
         if($_SESSION['notelog']==false || $_SESSION['noteuserid']=="")     // If user is not logged in.
         {
            ?>
                <form action="" method="post" id='mongo'>
                  <br>
                  <h2>Login</h2>
                  <br>
                  <input type="email" name="email" placeholder="Email Address" required/>
                  <br><br>
                  <input type="password" name="password" placeholder="Password" required/>
                  <br><br>
                  <button type="submit" class="successfulinstall">LOGIN</button>
                  <br>
                  <br>
                <div id='correctorwrong'>
            <?

            $email=$_POST['email'];
            $password=$_POST['password'];

            if($email!="" && $password!="")
            {
              // Stopping Malicious Inputs
              
              $email=mysqli_real_escape_string($dbcon,$email);
              $password=mysqli_real_escape_string($dbcon,$password);

              $check1=mysqli_query($dbcon,"SELECT * FROM ".$subscript."users WHERE email='".$email."'");

              if(mysqli_num_rows($check1)==0)
              {
                echo "<br>No such user found.<br><br>";
              }
              else
              {
                $check1=mysqli_query($dbcon,"SELECT * FROM ".$subscript."users WHERE email='$email'");

                $user=mysqli_fetch_assoc($check1);

                $salter=$user['salt'];

                $password=crypt($password,$salter);

                $password=md5($password);

                $retquery="SELECT * FROM ".$subscript."users WHERE email='".$email."' AND password='".$password."'";

                $retq=mysqli_query($dbcon,$retquery);
                
                if(mysqli_num_rows($retq)==0)
                {
                  echo "<br>Invalid Credentials Entered.<br><br>";
                }
                else
                {
                  $user=mysqli_fetch_assoc($retq);

                  $_SESSION['notelog']=true; // User logged in.
                  $_SESSION['noteuserid']=$user['userid'];  // User ID registered for later use.
                  
                  echo "<br><br>Successfully logged in.<br><br>";
                  
                  // Redirect the user if login successful.
                  
                  header("refresh:1;url=userloggedin.php");
                  exit();
                }
              }
            }
         }
         else
         {
          header("refresh:0;url=userloggedin.php");
          exit();
         }
      ?>
                </div>
                <span class='smalltext'>Need a new account? <a href='register.php'>Register</a>.</span>
              </form>
    </div>
    </div>
  </div>
</body>
</html>
