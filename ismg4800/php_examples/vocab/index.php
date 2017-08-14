<?php
session_start();
if(isset($_SESSION['auth']))
{  ?> 
<HTML>
<HEAD>
<META TTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<link rel=stylesheet href="styles/screen_check.css">

<TITLE>Vocabulary Study Program</TITLE>
</HEAD>
<BODY>
<div>
<H1>Vocabulary Study Program</h1>

<form ACTION="test.php" METHOD="GET" NAME="frmInput">

  <table>
    <tr>
      <td>Enter List Numbers to Study (e.g. 1,2,5):
      <td><input TYPE="text" NAME="list" SIZE="30">
    </tr>
    <tr>
      <td>Enter number of words to test at a time:
      <td><input TYPE="text" NAME="number" SIZE="5">
    </tr>
    <tr>
      <td ALIGN="right"><input TYPE="submit" VALUE="Submit">
      <td><input TYPE="Reset" VALUE="Reset">
  </table>

</form>
</div>
</BODY>
</HTML>
<?php } else
 header("Location: password.html"); 
?>