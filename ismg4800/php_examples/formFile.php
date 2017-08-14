<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Form Output to File</TITLE>
<link rel="stylesheet" type="text/css" href="demo.css">
</HEAD>
<BODY>
<H1>Thank You</H1>
<UL>
<?php
  // If this was called from formDemo.html name & email will exist
  // if this is called accidentally name & email will be null
  echo "<!--";
  $name=$_GET[name];
  $email=$_GET[email];
  $comments=$_GET[comments];
  echo "-->";

  print ("<li>Name: " . $name . "</li>");
  print ("<li>Email: " . $email . "</li>");
  print ("<li>Comments: " . $comments . "</li>");

  // replace commas in comments so comma delimited file not messed up
  $c2 = str_replace(",", " ", $comments);

  // Open a file for append ("a"), since I want to add this data
  // to an existing data file. Must give full path to file:
  $myfile = fopen ("C:\Documents\Courses\ismg4800\php_examples\data.txt", "a");
  // write name, email & cooments to a file separated by commas
  fwrite($myfile,"$name,$email,$c2
");
?>
</UL>
</BODY>
</HTML>