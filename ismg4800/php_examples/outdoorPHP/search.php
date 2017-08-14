<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="od.css">
<TITLE>Search Results</TITLE>
</HEAD>
<BODY>
<!--?php require("test.php"); ?-->
<?php require("includes/header.inc"); ?>
<?php require("includes/lmenu.inc"); ?>

<H2><span>Search Results:</span></H2>

<?php  
   $keyword = $_POST['search'];
   $k = explode(" ", $keyword);
   $s = new Search();
   for($i=0; $i < count($k); $i++)
   {   $s->setKeyword($k[$i]);
       echo "<h3>Search Term: " . $s->getKeyword() . "</h3>";
       //echo "<h3>Search Term: " . $k[$i] . "</h3>";
       echo $s->find();
   } 
?>
<?php require("includes/rmenu.inc"); ?>
<?php require("includes/footer.inc"); ?>
</BODY>
</HTML>

<?php

class Search
{       
   // member declaration
   var $keyword ;
   var $conn ;

   function Search()
   { 
     $keyword = 'shoe';
     require("includes/db.inc");
   }
   
   // method declaration
   function getKeyword() {
       return $this->keyword;
   }

   // method declaration
   function setKeyword($k) {
       $this->keyword = $k;
   }
   
   function find() 
   {
      $results = "";
      
      $qry = "SELECT * FROM ITEM WHERE (ITEMNAME Like '%" . $this->keyword . "%') OR (ITEMDESC Like '%". $this->keyword . "%')";
      $rs = mysql_query($qry)
          or die('Search Query failed: ' . mysql_error() . '<br>');

      // Loop through results set
      while($row = mysql_fetch_array($rs))
      { // Display Specific Data values to screen
          $results = $results . "<p><a href='product.php?cat=" . $row['CATID'] . "&item=" . $row["ITEMID"] . "'>";
          $results = $results . $row["ITEMNAME"] . "</a><br>";
          $results = $results . $row["ITEMDESC"] . "</p>\n";
      }
      
      if($results == "") $results = "<p>No results found</p>";
      
      return $results;
   } 
}   
?> 
