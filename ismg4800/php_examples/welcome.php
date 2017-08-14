<?php setcookie("uname", $_POST["name"], time()+36000); ?>
<html>
<body>
  <p>Welcome <?php echo $_REQUEST["name"]; ?>.<br />
     You are <?php echo $_REQUEST["age"]; ?> years old!</p>

  <p>A cookie was set on this page! The cookie will be active when 
     the client has sent the cookie back to the server.</p>
  <p>The cookie test page is <a href="cookie_get.php">here.</a></p>
</body>
</html>