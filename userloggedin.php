<?php
   session_start();
   include 'inc/config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Notes - Notebook</title>
  <?php include 'inc/style.php'; ?>
</head>
<body>
<div id='notemain'>
  <?php
  
   // Rechecking

   if($_SESSION['notelog']==true && $_SESSION['noteuserid']!="")
   {
    include 'menu.php';
    include 'sidenav.php';
     echo "<div id='notes'>
     <div id='noteset'>
        <div align='center'>
          <div id='notepad'>
            <div id='newtitle' contenteditable='true' data-text='Title'></div>
            <div id='newcontent'contenteditable='true' data-text='Note'></div>
            <div class='noteoptions' style='padding: 15px;'><span class='addbutton' onclick=\"addnote(".$_SESSION['noteuserid'].",document.getElementById('newtitle').innerHTML.toString(),document.getElementById('newcontent').innerHTML.toString())\">ADD</span></div>
          </div>
        </div>
        <br/>
        <div align='center'><div class='divider'></div></div>
        <br/>
     ";

     $retrieve=mysqli_query($dbcon,"SELECT * FROM ".$subscript."notes WHERE userid=".$_SESSION['noteuserid']." ORDER BY note_date desc LIMIT 0,500");   // Retreive 500 Notes. No one creates 500 Notes in the first place.

     if(mysqli_num_rows($retrieve)!=0)  // If the user does have notes.
     {
         while($note=mysqli_fetch_assoc($retrieve))
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
     else
     {
        echo("<br><br><div align='center'><div class='nonotes'><i class=\"material-icons md-72\">note_add</i></div><br><br>No Notes found! Create One Above!</div>");
     }

     // Printed every single note of the user. 
      echo "</div></div>";
  }
  else
  {
    header("refresh:0;url=index.php");
    exit();
  }

  ?>
</div>
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