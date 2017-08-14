<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="../od.css">
<TITLE>Search Results</TITLE>
</HEAD>
<BODY>
<?php require("../includes/header.inc"); ?>
<?php require("../includes/lmenu.inc"); ?>

<H2><span>Search Results:</span></H2>

<?php  
   $keyword = $_POST['search'];
   $k = explode(" ", $keyword);
   for($i=0; $i < count($k); $i++)
   {   echo "<h3>Search Term: " . $k[$i] . "</h3>";
       echo "<p>XML Search Not Implemented";
   } 
?>
<?php require("../includes/rmenu.inc"); ?>
<?php require("../includes/footer.inc"); ?>
</BODY>
</HTML>