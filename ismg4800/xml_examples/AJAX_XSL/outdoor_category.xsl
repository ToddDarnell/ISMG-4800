<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="catalog">
   <HTML>
    <HEAD>
        <link rel="stylesheet" type="text/css" href="../od.css" />
    </HEAD>
    <BODY>
      <table border="0" cellpadding="15">
          <xsl:apply-templates select="item"/>
      </table>
    </BODY>
    </HTML>
 </xsl:template>
  <xsl:template match="item">
    <tr>
    <td>
      <img width="80" height="80">
      <xsl:attribute name="src">../images/<xsl:value-of select="thumbnail"/></xsl:attribute>
      </img>
    </td>
    <td> 
       <a href="outdoor_item.xml" onmouseover="document.cookie='item={@id}';"><xsl:value-of select="name"/></a></td>
    </tr>
  </xsl:template>
</xsl:stylesheet>