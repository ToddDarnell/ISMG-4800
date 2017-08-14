<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>Outdoor Depot: Product Selection Page</TITLE>
  <link rel="stylesheet" type="text/css" href="od.css">
</HEAD>
<BODY>
<?php $cat  = $_GET['cat']; 
      if(!$cat) $cat=5; ?>
<?php require("includes/header.inc"); ?>
<?php require("includes/lmenu.inc"); ?>
<?php   
  require("includes/db.inc");
  $qry = "Select * from CATEGORY Where CATID = " . $cat . ";";   
  $rs = mysql_query($qry)
      or die('Query1 failed: ' . mysql_error() . '<br>');
  echo "<H2 align=left><span>" . mysql_result($rs, 0,"CATNAME") . "</span></H2>";
   
  $qry = "Select * from ITEM Where CATID=" . $cat .";";
  //echo $qry;
  //$query = 'Select * from ITEM';
  //echo $query;
  $rs = mysql_query($qry)
      or die('Query failed: ' . mysql_error() . '<br>');
      
   echo "<table border=0 cellpadding=5 cellspacing=0 >";
   $x=0; 
   
   $num = mysql_num_rows($rs);
   while($row = mysql_fetch_array($rs))
   {   
      echo "<tr><td width=80><img src='";
      //echo "images/" . mysql_result($rs, $x,"ITEMTHUMB")  . "'";
      echo "images/" . $row['ITEMTHUMB']  . "'";
      echo " width=80 height=80></td>";
      //echo "<td><a href='product.php?cat=5&item=" . mysql_result($rs, $x,"ITEMID") . "'>";
      echo "<td><a href='product.php?cat=" . $cat . "&item=" . $row['ITEMID'] . "'>";
      //echo mysql_result($rs, $x,"ITEMNAME") . "</a></td></tr>" ;
      echo $row['ITEMNAME'] . "</a></td></tr>" ; 
      $x++;
      if($x > $num) break;
  }
  echo "</table>"; 
?>

<?php require("includes/rmenu.inc"); ?>
<?php require("includes/footer.inc"); ?>

</BODY>
</HTML>
