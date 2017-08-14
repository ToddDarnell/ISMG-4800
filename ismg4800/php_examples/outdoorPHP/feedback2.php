<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Form Output to File</TITLE>
<link rel="stylesheet" type="text/css" href="od.css">
</HEAD>
<BODY>
<?php require("includes/header.inc"); ?>
<?php require("includes/lmenu.inc"); ?>
<H2><span>Thank You</span></H2>
<ul>
<?php  
      // If this was called from feedback.html name & email will exist
      // if this is called accidentally name & email will be null
      $name=$_GET['name'];
      $email=$_GET['email'];
      $comments=$_GET['comments'];

      print ("<li>Name: " . $name . "</li>");
      print ("<li>Email: " . $email . "</li>");
      print ("<li>Comments: " . $comments . "</li>");
      
      $comments = strtr($comments,","," ");
      $comments = strtr($comments,"  "," ");

      $myfile = fopen ("data.txt", "a");
       // write name, email & cooments to a file separated by commas
      fwrite($myfile,"$name,$email,$comments
");
      fclose($myfile);
?>
     
</ul>
<p>Has been sent to customer support.</p>
<?php require("includes/rmenu.inc"); ?>
<?php require("includes/footer.inc"); ?>
