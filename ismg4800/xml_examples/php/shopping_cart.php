<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Outdoor Depot Shopping Cart</TITLE>
<link rel="stylesheet" type="text/css" href="../od.css">
<META content="text/html; charset=windows-1252" http-equiv=Content-Type>
<script LANGUAGE="JavaScript" SRC="../scripts/odcart.js"></script>
</HEAD>
<BODY>
<?php require("../includes/header.inc"); ?>
<?php require("../includes/lmenu.inc"); ?>
   <TD ALIGN=center valign="top">	
<center>
<h1>Outdoor Depot<br>Shopping Cart</h1>
<?php
  $urlpath = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ;
  $file =    basename($urlpath); 
  $cout =    "https://" . substr ( $urlpath, 0, strlen($urlpath) - strlen($file)) . "checkout.php";
?>
<form name="cartform">

<SCRIPT Language = "JavaScript">
<!--
var head = '<table class="bg1" style="font-size: .917em;" cellpadding=2><tr class="bg2"><th>Product</th><th>Size</th><th>Color</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>';
writeCart('odCart', 1, 'cartform', '|', 5, head, '<?php echo $cout; ?>', '<?php echo $cout; ?>' );
// End -->
</SCRIPT>
</form>
</center>

<?php require("../includes/rmenu.inc"); ?>
<?php require("../includes/footer.inc"); ?>