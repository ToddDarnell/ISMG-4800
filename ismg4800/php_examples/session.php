<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Session PHP Page</TITLE>
</HEAD>
<BODY>
<H1>Start User Session</h1>
<?php
  session_start();
  $name = $_POST["name"];
  $email = $_POST["email"];
  $person = array($name, $email);

  $_SESSION["person"] = $person;
  if(!isset($_SESSION['start']))
      $_SESSION["start"]  = date("m-d-20y h:i:s a");
?>
<H1>User Data Processed</H1>
<?php // if called with a form
  if ($name!=null)
  { ?>
   <h2>You input the following data:</h2>
   <ul>
   <li><b>Name:</b><?php echo $name ?></li>
   <li><b>Email:</b><?php echo $email ?></li></ul>
   <br><a href="session2.php">Continue</a>
<?php } else echo("<p>Error in the form data. Go to <a href=session.html>session.html</a></p>"); ?>

</BODY>
</HTML>