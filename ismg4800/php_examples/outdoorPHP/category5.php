<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Women's Clothing</TITLE>
  <link rel="stylesheet" type="text/css" href="od.css">
</HEAD>
<BODY>
<?php require("includes/header.inc"); ?>
<?php require("includes/lmenu.inc"); ?>
<?php   

  require("includes/db.inc");
  echo "<H2 align=left><span>Women's Clothing</span></H2>";
   
  $qry = "Select * from ITEM Where CATID=5;";

  $rs = mysql_query($qry)
      or die('Query failed: ' . mysql_error() . '<br>');
      
   echo "<table border=0 cellpadding=5 cellspacing=0 >";
   $x=0; 
   
   while($row = mysql_fetch_array($rs))
   {   
      echo "<tr><td width=80><img src='";
      echo "images/" . $row['ITEMTHUMB']  . "'";
      echo " width=80 height=80></td>";
      echo "<td><a href='product.php?cat=5&item=" . $row['ITEMID'] . "'>";
      echo $row['ITEMNAME'] . "</a></td></tr>" ;
  }
  echo "</table>"; 
?>

<?php require("includes/rmenu.inc"); ?>
<?php require("includes/footer.inc"); ?>

</BODY>
</HTML>
