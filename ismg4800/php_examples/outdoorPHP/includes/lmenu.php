<?php require("db.inc"); ?>
<TABLE BORDER="0" width=100% CELLPADDING=3 cellspacing="0">	
  <TR>	
   <TD valign="top" class=linklist>
  <div id=linklist1><ul>
<?php  
      $qry = "Select * from CATEGORY";  
      $rs = mysql_query($qry) or die('Query failed: ' . mysql_error() . '<br>');
  
  while($row = mysql_fetch_array($rs))
  { 
    echo  "  <li><a href='category.php?cat=" . $row[CATID] . "'>" . $row[CATNAME] . "</a></li>";
  } 
?>
</ul>
<br>
<ul>
        <li><a href="AboutUs.php">About Us</a></li>
        <li><a href="feedback.php">Contact Us</a></li>
        <li><p>Site Map</li>
        <li><p>Customer Service</li>	
        <ul>
          <li><p>How to Order</li>
          <li><p>Shipping and Returns</li>
          <li><p>Check on Your Order</li>
        </ul></ul>
        </div>
   </TD>
   <TD valign="top" id=content>