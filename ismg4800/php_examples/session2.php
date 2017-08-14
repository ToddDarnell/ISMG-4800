<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Second Session PHP Page</TITLE>
</HEAD>
<BODY>
<H1>Continuing User Session</h1>
<?php
  session_start();

  if (isset($_SESSION['person']))
  {
    $p = $_SESSION["person"];
    $now = $_SESSION["start"];
    echo("<h2>You are:</h2>");
    echo("<ul>");
    echo("<li><b>Name:</b> " . $p[0] . "</li>");
    echo("<li><b>Email:</b> " . $p[1] . "</li>");
    echo("<li><b>Your Session Started:</b> $now");
  }
  else
    echo("<p>Error in the session data</p>");
?>
</BODY>
</HTML>