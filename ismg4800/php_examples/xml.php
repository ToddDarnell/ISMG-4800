<?php
   header("Content-type: text/xml");
   echo "<?xml version=\"1.0\"?>\n";
   echo "<catalog>\n" ;

   // Include db connection file 
   require("db.inc") ;
   $itm = array("itemID", "catID", "name", "description", "image", "thumbnail" );
   $col = array("ITEMID", "CATID", "ITEMNAME", "ITEMDESC", "ITEMIMAGE", "ITEMTHUMB" );


   // select all items from the database
   $qry = "Select * from ITEM ;"; 
   $rs = mysql_query($qry) 
     or die('Query1 failed: ' . mysql_error() . '<br>');

   // loop through the item retrieved
  while($row = mysql_fetch_array($rs))
  {
     // open item tag including id attribute
     echo '<item id="' . $row["ITEMID"] . "\">\n" ;

     // use item tag id & database column number 
     // efficiently write database columns to XML
     for($j = 1; $j < count($itm); $j++) {
     //  echo '<' . $itm[$j] . '>' . 
     //        $row[$col[$j]] . '</' . $itm[$j] . ">\n" ;
       $data = htmlentities( $row[$col[$j]], ENT_QUOTES );
       echo "<$itm[$j]>$data</$itm[$j]>\n" ;
     }  
     echo "</item>\n" ; //close item
  } 
  mysql_close($conn); 
  mysql_free_result($rs);
?>
</catalog>