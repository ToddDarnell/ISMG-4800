<html>
<body>
<?php
   echo "Referer: " . $_SERVER["HTTP_REFERER"] . "<br />";
   echo "Browser: " . $_SERVER["HTTP_USER_AGENT"] . "<br />";
   echo "User's IP address: " . $_SERVER["REMOTE_ADDR"];
?>
</body>
</html>