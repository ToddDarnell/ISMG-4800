<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>PHP Strings</TITLE>
</HEAD>
<BODY>
<H1>PHP Single Quoted Strings</h1>
<?php 
  //A literal string displayed in the browser window 
  echo 'PHP was developed in 1994 by Rasmus Lerdorf'; 
  //A literal string assigned to a variable 
  $string = 'Since its development, PHP has become a popular scripting language.'; 
  echo $string; 
  //escaping single quotes 
  echo 'The array contains the values \'2,5,3,4\'.'; 
  //invalid attempt to expand a variable inside of a single quote string 
  $name = 'John Smith'; 
  echo 'The user's name is $name'; 
?> 
</BODY>
</HTML>