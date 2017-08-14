<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="catalog">
      <table border="0" cellpadding="15">
          <xsl:apply-templates select="item"/>
      </table>
 </xsl:template>
  <xsl:template match="item">
    <tr>
    <td>
      <img width="80" height="80">
      <xsl:attribute name="src">images/<xsl:value-of select="thumbnail"/></xsl:attribute>
      </img>
    </td>
    <td> 
       <a href="#" onclick="transformDetail('{@id}')"><xsl:value-of select="name"/></a></td>
    </tr>
  </xsl:template>
</xsl:stylesheet>