<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>SetUP MySQL</TITLE>
</HEAD>
<BODY>
<?php 
      $username = 'ouray_username';
      $password = 'mysql11111111';
      echo "<H1>Begin Database Set-up</H1>";
      $conn = mysql_connect('localhost',$username, $password)
            or die( '<h2>Could not connect to mysql</h2></body></html>');
      echo 'Connected successfully<br>';


      if(!mysql_select_db($username))
      { echo ("Could not select database $username<br>");
        $query  = "CREATE DATABASE $username";
        $result = mysql_query($query);
        mysql_select_db($username) or die("Could not select database $username<br>"); 
      }
      echo "Selected $username successfully<br>";
    
      $query = 'Select * from ITEM';
      if(!$rs = mysql_query($query)) echo startup();

      if($rs = mysql_query($query)) {
      // Printing results in HTML
      echo "<table>\n";
      while ($line = mysql_fetch_array($rs)) {
           echo "\t<tr>\n";
           $i = 0;
           foreach ($line as $col_value) {
              if($i%2==0) echo "\t\t<td>$col_value</td>\n";
              $i++;
           }
           echo "\t</tr>\n";
     }
     echo "</table>\n";
     }
     // Free resultset
     mysql_free_result($rs);

     // Closing connection
    mysql_close($conn);      
      

?>
      
<?php
  function startup()
  {
    $message = "<p>Begin table creation</p>\n";  

    $cqry = array(
    "CREATE TABLE ITEM (ITEMID int primary key, CATID int, ITEMNAME char(50)," .
      "ITEMDESC char(255), ITEMIMAGE  char(50), ITEMTHUMB char(50));",
    "CREATE Table CATEGORY (CATID int primary key, CATNAME char(50));",
    "CREATE Table INVENTORY(INVID int primary key, ITEMID int, CATID int, " .
       "ITEMSIZE char(20), COLOR char(50), CURR_PRICE decimal(10,2), QOH int);",
    );
    
    $message = $message . executeUpdatePHP($cqry);
  
    $iqryA = array(
     "Insert into INVENTORY values(1,10,1,'Rectangular','Blue',259.99,16);",
     "Insert into INVENTORY values(2,10,1,'Mummy','Blue',359.99,12);",
     "Insert into INVENTORY values(3,1,5,'S','Khaki',29.95,150);",
     "Insert into INVENTORY values(4,1,5,'M','Khaki',29.95,147);",
     "Insert into INVENTORY values(5,1,5,'L','Khaki',29.95,0);",
     "Insert into INVENTORY values(6,1,5,'S','Navy',29.95,139);",
     "Insert into INVENTORY values(7,1,5,'M','Navy',29.95,137);",
     "Insert into INVENTORY values(8,1,5,'L','Navy',29.95,115);",
     "Insert into INVENTORY values(9,2,5,'S','Twilight',59.95,135);",
     "Insert into INVENTORY values(10,2,5,'M','Twilight',59.95,0);",
     "Insert into INVENTORY values(11,2,5,'L','Twilight',59.95,187);",
     "Insert into INVENTORY values(12,2,5,'S','Hunter',59.95,133);",
     "Insert into INVENTORY values(13,2,5,'M','Hunter',59.95,124);",
     "Insert into INVENTORY values(14,2,5,'L','Hunter',59.95,112);",
     "Insert into INVENTORY values(15,2,5,'S','Red',59.95,102);",
     "Insert into INVENTORY values(16,2,5,'M','Red',59.95,83);",
     "Insert into INVENTORY values(17,2,5,'L','Red',59.95,95);",
     "Insert into INVENTORY values(18,3,5,'6 1/2','Navy',39.99,121);",
     "Insert into INVENTORY values(19,3,5,7,'Navy',39.99,81);",
     "Insert into INVENTORY values(20,3,5,'7 1/2','Navy',39.99,53);",
     "Insert into INVENTORY values(21,3,5,'8','Navy',39.99,61);",
     "Insert into INVENTORY values(22,3,5,'9','Navy',39.99,48);",
     "Insert into INVENTORY values(23,3,5,'6 1/2','Black',39.99,107);",
     "Insert into INVENTORY values(24,3,5,7,'Black',39.99,134);",
     "Insert into INVENTORY values(25,3,5,'7 1/2','Black',39.99,123);",
     "Insert into INVENTORY values(26,3,5,'8','Black',39.99,94);",
     "Insert into INVENTORY values(27,3,5,'9','Black',39.99,35);",
     "Insert into INVENTORY values(28,4,5,'S','Spruce',199.95,114);",
     "Insert into INVENTORY values(29,4,5,'M','Spruce',199.95,17);",
     "Insert into INVENTORY values(30,4,5,'L','Spruce',209.95,0);",
     "Insert into INVENTORY values(31,4,5,'XL','Spruce',209.95,12);",
     "Insert into INVENTORY values(32,4,5,'S','Black',199.95,101);",
     "Insert into INVENTORY values(33,4,5,'M','Black',199.95,4);",
     "Insert into INVENTORY values(34,4,5,'L','Black',209.95,2);",
     "Insert into INVENTORY values(35,4,5,'XL','Black',209.95,75);",
     "Insert into INVENTORY values(36,4,5,'S','Red',199.95,79);",
     "Insert into INVENTORY values(37,4,5,'M','Red',199.95,5);",
     "Insert into INVENTORY values(38,4,5,'L','Red',209.95,13);",
     "Insert into INVENTORY values(39,4,5,'XL','Red',209.95,56);",
     "Insert into INVENTORY values(40,8,7,'CM','Twilight',39.95,0);",
     "Insert into INVENTORY values(41,8,7,'CL','Twilight',39.95,187);",
     "Insert into INVENTORY values(43,8,7,'CM','Hunter',39.95,124);",
     "Insert into INVENTORY values(44,8,7,'CL','Hunter',39.95,112);",
     "Insert into INVENTORY values(46,8,7,'CM','Red',39.95,83);",
     "Insert into INVENTORY values(47,8,7,'CL','Red',39.95,95);",
     "Insert into INVENTORY values(48,9,7,'3 1/2','Navy',19.99,121);",
     "Insert into INVENTORY values(49,9,7,'4','Navy',19.99,81);",
     "Insert into INVENTORY values(50,9,7,'4 1/2','Navy',19.99,53);",
     "Insert into INVENTORY values(51,9,7,5,'Navy',19.99,61);",
     "Insert into INVENTORY values(52,9,7,6,'Navy',19.99,48);",
     "Insert into INVENTORY values(53,9,7,'3 1/2','Black',19.99,107);",
     "Insert into INVENTORY values(54,9,7,'4','Black',19.99,134);",
     "Insert into INVENTORY values(55,9,7,'4 1/2','Black',19.99,123);",
     "Insert into INVENTORY values(56,9,7,5,'Black',19.99,94);",
     "Insert into INVENTORY values(57,9,7,6,'Black',19.99,35);",
     "Insert into INVENTORY values(58,5,6,'M','Khaki',29.95,150);",
     "Insert into INVENTORY values(59,5,6,'L','Khaki',29.95,147);",
     "Insert into INVENTORY values(60,5,6,'XL','Khaki',29.95,0);",
     "Insert into INVENTORY values(61,5,6,'M','Navy',29.95,139);",
     "Insert into INVENTORY values(62,5,6,'L','Navy',29.95,137);",
     "Insert into INVENTORY values(63,5,6,'XL','Navy',29.95,115);",
     "Insert into INVENTORY values(64,6,6,'M','Twilight',59.95,135);",
     "Insert into INVENTORY values(65,6,6,'L','Twilight',59.95,135);", 
     "Insert into INVENTORY values(66,6,6,'XL','Twilight',59.95,135);",
     "Insert into INVENTORY values(67,7,6,'L','Spruce',209.95,0);",
     "Insert into INVENTORY values(68,7,6,'XL','Spruce',209.95,12);",
     "Insert into INVENTORY values(69,7,6,'XXL','Spruce',219.95,17);",
     "Insert into INVENTORY values(70,7,6,'L','Black',209.95,2);",
     "Insert into INVENTORY values(71,7,6,'XL','Black',209.95,75);",
     "Insert into INVENTORY values(72,7,6,'XXL','Black',219.95,10);",  
     "Insert into INVENTORY values(73,10,11,'Mummy','Blue',359.99,12);"
     );

     $message = $message . executeUpdatePHP($iqryA);
     
    $iqryB = array(
     "Insert into ITEM values(1,5,'Hiking Shorts','Soft, comfortable, lightweight cotton twill fabric and a classic fit highlight these shorts','shorts.jpg','shorts_thumb.jpg');",
     "Insert into ITEM values(2,5,'Fleece Pullover','A superb springtime layering choice - the Fleece Pullover has excellent wind resistance and warmth in a streamlined package.','fleece.jpg','fleece_thumb.jpg');",
     "Insert into ITEM values(3,5,'Airstream Canvas Shoes','These comfortable shoes tackle outdoor activities in all kinds of weather!','shoes.jpg','shoes_thumb.jpg');",
     "Insert into ITEM values(4,5,'All-Weather Mountain Parka','This two-layer parka offers rugged, waterproof protection and excellent breathability.','parka.jpg','parka_thumb.jpg');",
     "Insert into ITEM values(5,6,'Hiking Shorts','Soft, comfortable, lightweight cotton twill fabric and a classic fit highlight these shorts','shorts.jpg','shorts_thumb.jpg');",
     "Insert into ITEM values(6,6,'Fleece Pullover','A superb springtime layering choice - the Fleece Pullover has excellent wind resistance and warmth in a streamlined package.','fleece.jpg','fleece_thumb.jpg');",
     "Insert into ITEM values(7,6,'All-Weather Mountain Parka','This two-layer parka offers rugged, waterproof protection and excellent breathability.','parka.jpg','parka_thumb.jpg');",
     "Insert into ITEM values(8,7,'Fleece Pullover','A superb springtime layering choice - the Fleece Pullover has excellent wind resistance and warmth in a streamlined package.','fleece.jpg','fleece_thumb.jpg');",
     "Insert into ITEM values(9,7,'Airstream Canvas Shoes','These comfortable shoes tackle outdoor activities in all kinds of weather!','shoes.jpg','shoes_thumb.jpg');",
     "Insert into ITEM values(10,1,'Goose Down Sleeping Bag','Ideal for those cold transitional months, this lofty, goose down bag will keep you warm when the temperature makes an unexpected drop.','bags.jpg','bags_thumb.jpg');",
     "Insert into ITEM values(11,4,'Goose Down Sleeping Bag','Ideal for those cold transitional months, this lofty, goose down bag will keep you warm when the temperature makes an unexpected drop.','bags.jpg','bags_thumb.jpg');",
     "Insert into CATEGORY values(1,'Camping Gear');",
     "Insert into CATEGORY values(2,'Hiking Gear');",
     "Insert into CATEGORY values(3,'Biking Gear');",
     "Insert into CATEGORY values(4,'Backpacking Gear');",
     "Insert into CATEGORY values(5,'Women''s Clothing');",
     "Insert into CATEGORY values(6,'Men''s Clothing');",
     "Insert into CATEGORY values(7,'Kid''s Clothing');"  );
   
     $message = $message . executeUpdatePHP($iqryB);

     return $message;

  } 
  
    function executeUpdatePHP($as)
    {   
        $m = "";
        foreach($as as $value) {
           mysql_query($value) or die('Query failed: ' . mysql_error() . '<br>' . $m);
           $m = $m . $value . "<br>";
        }
        return $m;
    }
  
        
?>
</BODY>
</HTML>


