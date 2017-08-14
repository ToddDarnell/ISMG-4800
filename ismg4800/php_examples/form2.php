<HTML>
<HEAD>
<TITLE>Processing Form Data Part 2</TITLE>
<link rel="stylesheet" type="text/css" href="demo.css">
</HEAD>
<BODY>
<H1>Form Data Processed</H1>
<img src="buffs.gif" style="float:left;">  <!--
<?php
    echo "<!--";
    // get the form parameters
    $name    = $_POST[txtName];
    $email   = $_POST[txtEmail];
    $rating  = $_POST[optRate];
    $desc    = $_POST[lstDesc];
    $sug = array($_POST[chk1], $_POST[chk2], $_POST[chk3], $_POST[chk4]);
    $comment = $_POST[comment];
    echo "-->" ;

    // if called with a form
    if ($name!="")
    {
      print ("<br><p>You input the following data:</p><br>");
      print ("<ul>");
      print ("<li><span>Name:</span> $name</li>");
      print ("<li><span>Email:</span> " . $email . "</li>");
      print ("<li><span>Rating:</span> $rating</li>");
      print ("<li><span>Student Description:</span> " . $desc . "</li>");
      print ("<li><span>Suggestions:</span></li><ul>");

      foreach ($sug as $x)
        if($x != "") print ("<li>$x</li>");

      print ("</ul><li><span>Comments:</span>$comment</li></ul>");

    }
    else
      print ("<p>Error in the form data</p>");
?>
</BODY>
</HTML>