<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<TITLE>SetUP MySQL</TITLE>
</HEAD>
<BODY>
<?php 
      require("includes/db.inc");
      echo 'Connected successfully<br>';
      echo "Selected $username successfully<br>";
      
      echo startup();

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
    "CREATE TABLE Orders (OrderID int primary key, CName char(50)," .
      " Address char(100), City  char(50), State char(2), PostalCode char(10), Country char(50), " .
	  " Phone char(15), Email char(50), PaymentMethod char(10), PaymentNumber char(16)," .
	  " ExpDate char(10), OrderDate TIMESTAMP, Ship decimal(10,2), Total decimal(10,2));",
    "CREATE Table OrderDetails(OrderID int, Product char(50), " .
        "ItemSize char(20), Color char(50), Price decimal(10,2), Quantity int);"
    );
    
    $message = $message . executeUpdatePHP($cqry);

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


