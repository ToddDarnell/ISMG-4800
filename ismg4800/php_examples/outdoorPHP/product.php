<HTML><HEAD>
<link rel="stylesheet" type="text/css" href="od.css">
<script src="scripts/odcart.js"></script>
<?php 
   require("includes/db.inc");
   $cat  = $_GET["cat"];
   $item = $_GET["item"];
   if(!$cat) { $cat=5; $item=1;}

   $qry = "Select * from CATEGORY Where CATID like '" . $cat . "';";   
   $rs = mysql_query($qry)
      or die('Query1 failed: ' . mysql_error() . '<br>');

   // only one item in ResultSet use ?_fetch_array() to move to it
   $row = mysql_fetch_array($rs);
   $cname = $row["CATNAME"];
  
   $qry = "Select * from ITEM Where ITEMID=" . $item . ";";   
   $rs = mysql_query($qry)
      or die('Query2 failed: ' . mysql_error() . '<br>');
  
   // only one item in ResultSet use ?_fetch_array() to move to it
   $row = mysql_fetch_array($rs);
   $iname = $row["ITEMNAME"];
   $iimag = $row["ITEMIMAGE"];
   $idesc = $row["ITEMDESC"];

   echo "<TITLE>" . $cname . ": " . $iname . "</TITLE>"; 
?>
<SCRIPT LANGUAGE = "Javascript">
<!-- 
var name="<?php 
          echo $iname ; 
          ?>";
function createCookie(form)
{ var cookiestr, data;
  // this is necessary to get data from radio
  for (var i=0; i < form.item.length; i++) 
    if(form.item[i].checked) data=form.item[i].value;
  cookiestr = name + '|' + data + '|' + form.quantity.value;
  if(form.quantity.value.length < 1) alert("Specify a quantity");
  else appendCookie('odCart', cookiestr , .125,'|'); 
} // -->
</SCRIPT>
</HEAD>
<BODY>
<?php require("includes/header.inc"); ?>
<?php require("includes/lmenu.inc"); ?>
<H2><span><?php echo $cname; ?></span></H2>
<TABLE WIDTH="80%" ALIGN=CENTER>
  <TR>
    <TD><IMG SRC=images/<?php echo $iimag; ?>
         WIDTH=240 HEIGHT=180 ALIGN=RIGHT></TD>
    <!-- insert retrieved item description into page heading -->
    <TD><H2><?php echo $iname; ?></H2>
    <?php echo $$idesc; ?></TD>
  </TR>
</TABLE>
<!--table and form displaying inventory data -->
<FORM NAME=frmOrderItems>
<H4 ALIGN=CENTER>Order Items</H4>
<TABLE WIDTH="80%" BORDER=5 CELLSPACING=2 CELLPADDING=2 ALIGN=CENTER>
  <TR>
    <TH WIDTH=20 ALIGN=CENTER>Selection</TH>
    <TH WIDTH=20 ALIGN=CENTER>Size</TH>
    <TH WIDTH=20 ALIGN=CENTER>Color</TH>
    <TH WIDTH=20 ALIGN=CENTER>Price</TH>
    <TH WIDTH=20 ALIGN=CENTER>In Stock?</TH>
  </TR>
<?php 
  $qry = "Select * from INVENTORY Where ITEMID=" . $item . " AND CATID = " . $cat . ";";
  $rs = mysql_query($qry)
      or die('Query3 failed: ' . mysql_error() . '<br>');
  $counter = 0; 
  while($row = mysql_fetch_array($rs))
  {
    $counter++;
    $sz  = $row["ITEMSIZE"];
    $col = $row["COLOR"];
    $pr  = $row["CURR_PRICE"];
    $quan = $row["QOH"];
?>
    <TR ALIGN=CENTER>
<?php
    if($counter == 1) {
       echo "<TD><INPUT TYPE=RADIO CHECKED NAME=item VALUE='" . $sz . "|" . $col . " |" . $pr . "'></TD>";
    } // end if 
    else { 
       echo "<TD><INPUT TYPE=RADIO NAME=item VALUE='" . $sz . " |" . $col . " |" . $pr . "'></TD>";
   } // end else
   
   echo "<TD>$sz</TD>";
   echo "<TD>$col</TD>";
   echo "<TD>$" . number_format($pr, 2, '.', ',') . "</TD>";

   if($quan > 0) { 
           echo "<TD>Yes</TD></TR>";
        } // end if
        else { 
            echo "<TD>No</TD></TR>";
        } // end else

   } // end of while loop 
?>
</TABLE></P><P>
<!--table displaying form controls -->
<TABLE WIDTH="80%" CELLSPACING=3 CELLPADDING=5 ALIGN=CENTER>
  <TR>
    <TD WIDTH="70%"><BIG>Desired Quantity</BIG>
    <INPUT TYPE=TEXT NAME=quantity SIZE=10></TD>
    <TD ALIGN=RIGHT WIDTH="15%"><INPUT TYPE=BUTTON VALUE="Order Now"  onclick="createCookie(this.form);"></TD>
  </TR>
</TABLE></P>
</FORM>
<?php require("includes/rmenu.inc"); ?>
<?php require("includes/footer.inc"); ?>
</body>
</html>
