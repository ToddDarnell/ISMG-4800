<HTML>
<HEAD>
  <TITLE>PHP Tester</TITLE>
  <link rel="stylesheet" type="text/css" href="od.css">
</HEAD>
<BODY>
<?php
$code = _POST['code'];
if($code != null)
{
  $myfile = fopen ("test.php", "w");
       // write name, email & cooments to a file separated by commas
  fwrite($myfile,"$code
");
  fclose($myfile);
  echo "<iframe width=90% height=500 src=test.php></iframe>/n";
  echo "<a href="phpTester.php">Input additional PHP code to test</a>";
}
else{
  echo "<form name=test action=phpTester method=post>\n";
  echo "<TextArea rows=30 cols=80 name=code>\n";
  echo "Paste PHP COde Here</TextArea>\n";
  echo "<input type=submit></form>";
}
?>
</BODY>
</HTML>