<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>PHP Counter</TITLE>
</HEAD>
<BODY>
<H1>PHP Counter</h1>
<?php
  if (!($filein=fopen("counter.txt","r+"))) 
     exit("Unable to open file.");
  $count=(int)fgets($filein);
  $start=fgets($filein);
  echo "<p><i>You are the " . $count++ . " visitor to this site since $start</i></p>\n";
  // move back to the beginning of the file
  // same as rewind($filein);
  fseek($filein, 0);
  fwrite($filein,"$count
$start");
  fclose($filein);
?>
</BODY>
</HTML>