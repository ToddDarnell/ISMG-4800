<?php $param = $_REQUEST["item"]; ?>
<?php
   header("Content-type: text/xsl");
   echo '<?xml version="1.0"?>'; ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="catalog">
   <HTML>
    <HEAD>
        <link rel="stylesheet" type="text/css" href="../od.css" />
        <script language="JavaScript" src="../scripts/odcart.js"></script>
    </HEAD>
    <BODY>
      <FORM NAME="frmOrderItems">
      <xsl:apply-templates select="item[@id=<?php echo $param; ?>]"/>
 
      <H4 ALIGN="CENTER">Order Items</H4>
      <TABLE WIDTH="80%" BORDER="5" CELLSPACING="2" CELLPADDING="2" ALIGN="CENTER">
         <TR>
            <TH WIDTH="20%">Selection</TH><TH WIDTH="20%">Size</TH>
            <TH WIDTH="20%">Color</TH><TH WIDTH="20%">Price</TH><TH WIDTH="20%">In Stock?</TH></TR>
            <xsl:apply-templates select="item[@id=<?php echo $param; ?>]/inventory"/>
      </TABLE>
      <P> 
      <!--table displaying form controls -->
      <TABLE WIDTH="80%" CELLSPACING="3" CELLPADDING="5" ALIGN="CENTER">
      <TR>
         <TD WIDTH="70%"><BIG>Desired Quantity</BIG>
         <INPUT TYPE="TEXT" NAME="quantity" SIZE="10"/></TD>
         <TD ALIGN="RIGHT" WIDTH="15%"><INPUT TYPE="hidden" NAME="details" VALUE="S|Black|1.00"/>
         <INPUT TYPE="BUTTON" VALUE="Order Now"  onclick="appendCookie('odCart',this.form.name.value + '|' + this.form.details.value + '|' + this.form.quantity.value,.125,'|');"/></TD>
       </TR>
       </TABLE></P>
     </FORM>
     </BODY>
     </HTML>
    </xsl:template>

    <xsl:template match="item">
      <TABLE WIDTH="80%" ALIGN="CENTER">
      <TR><TD><IMG SRC="../images/{image}" WIDTH="240" HEIGHT="180" ALIGN="RIGHT"/></TD>
      <TD><H2><xsl:value-of select="name"/></H2>
      <INPUT TYPE="hidden" NAME="name" VALUE="{name}"/>
      <xsl:value-of select="description"/></TD></TR></TABLE>

    </xsl:template>
    
    <xsl:template match="inventory">
                <tr>
                    <td><input type="radio" name="x" onclick="this.form.details.value='{size}|{color}|{price}';"/></td>
                    <td><xsl:value-of select="size"/></td>
                    <td><xsl:value-of select="color"/></td>
                    <td>$<xsl:value-of select="price"/></td>
                    <td><xsl:value-of select="qoh"/></td>
                </tr>
     </xsl:template>
    
</xsl:stylesheet>
