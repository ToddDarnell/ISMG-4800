<?php 
 // Contains functions to check if logged in,
 // to require https be used and
 // to move between https & http
 require ('urlfunc.inc');
?> 
<html>
<head>
<link rel=stylesheet href="../vocab/styles/screen_check.css">
<script>
function validpw(form)
{
  if(form.passwd.value.length > 3 && form.username.value.length > 3)
    return true;
  alert("Invalid username/password");
  return false;
}
</script>

</head>
<body>
<div>
<form ACTION="password.php" onsubmit="return validpw(this);" METHOD="POST">
<input type="hidden" Name="txtH" value="ISMG 4800 Data">
  <center>
  <table>
    <tr>
      <td>Username:
      <td><input TYPE="text" NAME="username" SIZE="30">
    </tr>
    <tr>
      <td>Password:
      <td><input TYPE="password" NAME="passwd" SIZE="30">
    </tr>
    </tr>

    <tr>
      <td ALIGN="right"><input TYPE="submit" VALUE="Submit">
      <td><input TYPE="Reset" VALUE="Reset">
  </table>
  </center>
</form>
</div>
</body>
</html>
