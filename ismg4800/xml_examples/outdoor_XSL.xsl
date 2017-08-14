<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl">

<xsl:template match="/"> 
     <xsl:apply-templates/>
</xsl:template>             

<xsl:template match="catalog">
     <table border="0"><xsl:apply-templates/></table>
</xsl:template>                    

<xsl:template match="item">
  <tr>
  <td>
   <img width="80" height="80">
     <xsl:attribute name="src">../images/<xsl:value-of select="thumbnail"/></xsl:attribute>
      </img>
   </td>
   <td> 
     <a> <xsl:attribute name="href">outdoorprod.xml?item=<xsl:value-of select="@id"/></xsl:attribute>
              <xsl:value-of select="name"/>
     </a> 
  </td>
  </tr>
</xsl:template>

</xsl:stylesheet>