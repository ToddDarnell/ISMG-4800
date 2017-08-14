<HTML>
<HEAD>
<TITLE>
PHP Simple Form Processing
</TITLE>
</HEAD>
<BODY>
<H1>PHP Parameter Tester</H1>
<?php
     $data = $_GET[searchText];

     // If this was called from itself searchText will exist
     // if this is the first time it is called $data will == ""
     if ($data=="")
     {
         // Ask the user for search text via a GET form
         echo "<form method='get' action='form1.php'>";
         echo "<input type=text name='searchText'>";
         echo "<input type=submit name='Submit'><br>";
         echo "</form>";
     }
     else // searchText exists
     { // Output the text box's text
         echo "You searched for: <b>$data</b>!";
     }
?>
</BODY>
</HTML>