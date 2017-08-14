<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>PHP Strings</TITLE>
</HEAD>
<BODY>
<H1>Strings</h1>
<?php
$string = "Hello World";
$another_string = "Welcome to PHP";

echo strlen($string) . "<br>";
echo strtoupper($another_string) . "<br>";
echo strrev($another_string) . "<br>";
echo strpos($string, "W") . "<br>";
?>
</BODY>
</HTML>