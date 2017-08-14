<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>File Read and Echo</TITLE>
</HEAD>
<BODY>
<H1>PHP File Read and Echo</h1>

<?php
  if (!($filein=fopen("data.txt","r"))) 
     exit("Unable to open file.");
  while (!feof($filein)) 
  { 
     $x=fgets($filein); 
     echo $x . "<br>\n";
  }
  fclose($filein);
?>

</BODY>
</HTML>