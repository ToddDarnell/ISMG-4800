<?php 
   $cname  = $_GET["cat"];
   $item   = $_GET["item"];
   if(!$cname) { $cname="WC"; $item=1;}
 
   // open the XML document
   $doc = domxml_open_file("../outdoor.xml");

   //get the item element with the correct ID
   $oneitem = really_get_element_by_id($item, $doc) or die("no element found");

   $nameE   = $oneitem->get_elements_by_tagname("name");
   $iname   = $nameE[0]->get_content();
   $imageE  = $oneitem->get_elements_by_tagname("image");
   $iimage  = $imageE[0]->get_content();
   $descE   = $oneitem->get_elements_by_tagname("description");
   $idesc   = $descE[0]->get_content();
?>
<H2><span><?php echo $cname; ?></span></H2>
<TABLE WIDTH="80%" ALIGN=CENTER>
  <TR>
    <TD><IMG SRC='../images/<?php echo $iimage; ?>'
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
 //get all inventory elements found in the item
 $invs = $oneitem->get_elements_by_tagname('inventory');

 // loop through the item elements
 foreach($invs as $inv) 
 {
    $counter++;
    $szE  = $inv->get_elements_by_tagname("size");
    $sz   = $szE[0]->get_content();
    $colE = $inv->get_elements_by_tagname("color");
    $col  = $colE[0]->get_content();
    $prE  = $inv->get_elements_by_tagname("price");
    $pr   = $prE[0]->get_content();
    $quE  = $inv->get_elements_by_tagname("qoh");
    $quan = $quE[0]->get_content();
?>
    <TR ALIGN=CENTER>
<?php
    if($counter == 1) {
       echo "<TD><INPUT TYPE=RADIO CHECKED NAME=item VALUE='$iname|$sz|$col|$pr' onclick='this.form.data.value=this.value;'>
<input type=hidden name=data value='$iname|$sz|$col|$pr'</TD>";
    } // end if 
    else { 
       echo "<TD><INPUT TYPE=RADIO NAME=item VALUE='$iname|$sz|$col|$pr' onclick='this.form.data.value=this.value;'></TD>";
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
    <TD ALIGN=RIGHT WIDTH="15%"><INPUT TYPE=BUTTON VALUE="Order Now"  
      onclick="appendCookie('odCart', this.form.data.value + '|' + this.form.quantity.value, .125,'|');"></TD>
  </TR>
</TABLE></P>
</FORM>

<?php
/**
 * Get a node by its id 'attribute' value
 * The attribute name id has to be spelled lowercase in xml file
 * @return node on success and null in failure.
 * @param string An id to look for.
 */
function really_get_element_by_id( $str_id, $doc ){
  $node_with_id = null;
  $xpath = xpath_new_context($doc);
  $xpresult = xpath_eval($xpath, "//@id");
  foreach( $xpresult->nodeset as $node ){
  if ($node->value == $str_id)
  return $node->parent_node( );
}
return $node_with_id;
}
?>

