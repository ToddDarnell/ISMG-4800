<HTML>
<HEAD>
<TITLE>Outdoor Depot: Check-Out Complete</TITLE>
<link rel="stylesheet" type="text/css" href="od.css">
<script LANGUAGE="JavaScript" SRC="scripts/odcart.js"></script>
<script LANGUAGE="JavaScript" SRC="scripts/validate.js"></script>
</HEAD>
<BODY>
<?php require("includes/header.html"); ?>
<?php require("includes/lmenu.html"); ?>
<center>
<?php
  echo "<H1>Order Complete</H1>";
  echo "<h2>" . date("l dS \\o\f F Y h:i:s A") . "</h2></font>";

  $conn = mysql_connect('localhost','username','password')
       or die( '<h2>Could not connect to mysql</h2></body></html>');

  mysql_select_db('username') or die('<h2>Could not select database</h2></body></html>');

  // The following code will write the order to the orders table
  // and the order details to the order details table.
  // First need to find the maximum order number and create a new order number
  // that is that number plus 1, I ordered them DESC so maximum is 1st record
  $qry = "SELECT MAX(OrderID) as max1 FROM Orders;";

  // Send the SQL statement to the database to be executed
   $rs = mysql_query($qry) or die('Query1 failed: ' . mysql_error() . '<br>');

   // only one item in ResultSet use ?_fetch_array() to move to it
   $row = mysql_fetch_array($rs);
   $oid = (int)$row["max1"];
   // Calculate the new order id
   //echo "Last OrderID:" . $oid "<br>";
   $oid++;

   //Create the SQL Statement to create a new order 
   $qry = "INSERT INTO Orders (OrderID, CName, ";
   $qry = $qry . "Address, City, State, PostalCode, Country, Phone, Email,";
   $qry = $qry . "PaymentMethod, PaymentNumber, ExpDate, OrderDate, Ship, Total)";
   $qry = $qry . " Values(" . $oid . ",";
   $qry = $qry . "'" . $_REQUEST["CName"] . "',";
   $qry = $qry . "'" . $_REQUEST["Address"] . "',";
   $qry = $qry . "'" . $_REQUEST["City"] . "',";
   $qry = $qry . "'" . $_REQUEST["State"] . "',";
   $qry = $qry . "'" . $_REQUEST["Postcode"] . "',";
   $qry = $qry . "'" . $_REQUEST["Country"] . "',";
   $qry = $qry . "'" . $_REQUEST["Phone"] . "',";
   $qry = $qry . "'" . $_REQUEST["Email"] . "',";
   $qry = $qry . "'" . $_REQUEST["CreditCard"] . "',";
   $qry = $qry . "'" . $_REQUEST["CCN"] . "',";
   $qry = $qry . "'" . $_REQUEST["CCExpMM"] . "/" . $_REQUEST["CCExpYY"] . "',";
   $qry = $qry . date('YmdHis')  . ",";
   $qry = $qry .  $_REQUEST["ship"] . ",";
   $qry = $qry .  $_REQUEST["total"] . ");";

   //Send the SQL statement to the database to be executed
   mysql_query($qry) or die('Query2 failed: ' . mysql_error() . '<br>');

  // Next I need to write each item to the OrderDetails table.
  // Since my cookie stuff is in JavaScript and I am at the server
  // I am going to get my data from the form. I had a
  // a hidden element "numprod" telling me how may products
  // I have in my table.

  // Loop through cart and add each item to the OrderDetails Table
  for($i = 0 ; $i < $_REQUEST["numprod"]; $i++)
  {
     $qry = "INSERT INTO OrderDetails ";
     $qry = $qry . "(OrderID, Product, ItemSize, Color, Price, Quantity)";
     $qry = $qry . " Values(" . $oid . ",";
     $qry = $qry . "'" . $_REQUEST["field0$i"] . "',";
     $qry = $qry . "'" . $_REQUEST["field1$i"] . "',";
     $qry = $qry . "'" . $_REQUEST["field2$i"] . "',";
     $qry = $qry . (float)$_REQUEST["field3$i"] . ",";
     $qry = $qry . (int)$_REQUEST["field4$i"] . ");";
    //echo $qry . "<br>";
    mysql_query($qry) or die("Query3 $i failed: " . mysql_error() . "<br>");

  }
  echo "<p>Your Order Number: $oid <br>(Please save for your records)</p>";

?>
<SCRIPT Language = "JavaScript">
<!--
var head = '<table class="bg1" style="font-size: .917em;" cellpadding=2><tr class="bg2"><th>Product</th><th>Size</th><th>Color</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>';
writeCart('odCart', 2, 'cartform', '|', 5, head, 'checkout.html'  );
// End -->
</SCRIPT>
<center>
<p>Your order will be shipped within the next 48 hours</p>
<br><br><a href='index.php'>Click here to return to our homepage!</a>
</center>

<?php
  // now we will close the connection to the database
  mysql_close($conn); 
  mysql_free_result($rs); 
 
?>

<hr>

<?php require("includes/rmenu.html"); ?>
<?php require("includes/footer.html"); ?>
</body>
</html>