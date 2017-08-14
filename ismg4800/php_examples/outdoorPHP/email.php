<?php
 // Code to get the order id in case this is not
 // included in the checkout2.php page
 if(!isset($oid)) 
 { $oid = 8; 
    if(isset($_REQUEST["oid"])) $oid = $_REQUEST["oid"];
    $solo=true; 
 }

 // include the database connection file
 require("includes/db.inc");

 // Select the order informaiton from the database
 $qry = "Select * from Orders Where OrderID=" . $oid . ";"; 
 $rs = mysql_query($qry) 
        or die('Query1 failed: ' . mysql_error() . '<br>');

 // only one item in ResultSet use ?_fetch_array() to move to it
 $row = mysql_fetch_array($rs);
 $ship = $row["Ship"];
 $total = $row["Total"];

 // Set the the "to" for the email to the customer email
 $to = $row["Email"];
 $subject = "Outdoor Depot - Order Confirmation (OrderID: $oid)";

 // To send HTML mail, the Content-type header must be set
 $headers = 'MIME-Version: 1.0' . "\r\n";
 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

 // Additional headers just want to set from
 // as a fake outdoor depot email address
 $headers .= "From: orders@outdoordepot.com" . "\r\n";

 // set message to include database data PLUS text and html tags
 // carriage returns embedded between "" will appear in file sent
 $message = 
"<html><head><title>Order Confirmation Outdoor Depot</title>
  <style>
    h3 { color: green; text-decoration: underline overline;}
    th { background-color: #FFFFCC; color: darkgreen; }
  </style>
 </head><body>
   <p>Dear " . $row['CName'] . ",
   <p>Below are your order details. 
   <h3>CUSTOMER INFORMATION / BILLING INFORMATION</h3>
   <p>" . $row['CName'] . "<br>" . $row['Address'] . "
     <br>" . $row['City'] . ", " . $row['State'] . " " . $row['PostalCode'] . "
     <br>" . $row['Country'] . "

   <p><b>Paid using:</b> " . $row['PaymentMethod'] . "
   <br><b>Credit Card Number:</b> XXXX-XXXX-XXXX-" . substr($row['PaymentNumber'], 12, 4) . "
   <br><b>Credit Card Expiration Date:</b> " . $row['ExpDate'] . "

   <h3>ORDER INFORMATION</h3>
   <p><b>Order number:</b> $oid
   <br><b>Order Date:</b> " . $row['OrderDate'] . "</p>
   <!-- Start of order table displaying product purchased -->
   <table border=0>
   <tr><th>Product</th><th>Size</th><th>Color</th>
         <th>Price</th><th>Quantity</th><th>Total Price</th></tr>";
 // ended message string (above), will add to it later.

 // query to select products purchased from the order details table
 $qry = "Select * from OrderDetails Where OrderID=" . $oid . ";";
 $rs = mysql_query($qry)
        or die('Query2 failed: ' . mysql_error() . '<br>');
 $stotal = 0; 

 // loop to display products to a table
 // just like the JavaScript Shopping cart
 while($row = mysql_fetch_array($rs))
 {
   $itotal = (float)$row['Price']*(int)$row['Quantity'];
   $stotal += $itotal;
   // Continue message string with table rows
   $message .= "<tr>
   <td>" . $row['Product'] . "</td>
   <td align=center>" . $row['ItemSize'] . "</td>
   <td align=center>" . $row['Color'] . "</td>
   <td align=right>$" . $row['Price'] . "</td>
   <td align=center>" . $row['Quantity'] . "</td>
   <td align=right>$$itotal</td></tr>"; 
 }

 $message .= // continue message string
  "<tr><td colspan=5 align=right>Subtotal:</td>
         <td align=right>$$stotal</td></tr>
    <tr><td colspan=5 align=right>Shipping:</td>
          <td align=right>$$ship</td></tr>
    <tr><td colspan=5 align=right>Total Order:</td>
           <td align=right>$$total</td></tr></table>

  <h3>SHIPPING INFORMATION</h3>
  <p>A shipping tracking number will be sent with your shipping confirmation e-mail.
  <p>Outdoor Depot Online Sales<br>sales@OutdoorDepot.com<br>1-800-555-1212";
                                 // end of message string

 // Send the email & display a confirmation message
 // if this page was not included in a previous page 
 if(mail($to, $subject, $message, $headers) && $solo=true)
 {
    echo "<p>The following confirmation message has been successfully sent:</p>" ;
    echo "To: $to<br>Subject: $subject<br>$message";
 } else {
    echo "<p>The following confirmation message delivery failed...</p>" ;
    echo "To: $to<br>Subject: $subject<br>$message";
 }
?>