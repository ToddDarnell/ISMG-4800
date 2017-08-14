<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>PHP Date</TITLE>
</HEAD>
<BODY>
<H1>PHP Date</h1>
<?php
  //Prints something like: Monday
  echo date("l") . "<br>";
  //Prints something like: Monday 15th of March 2006 05:51:38 AM 
  echo date("l dS \\o\f F Y h:i:s A"). "<br>";
  //Prints something like: Monday the 15th 
  echo date("l \\t\h\e jS"). "<br>";
?> 
</BODY>
</HTML>