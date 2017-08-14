<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl">

<xsl:template match="/"> 
     <xsl:apply-templates/>
</xsl:template>             

<xsl:template match="catalog">
     <xsl:apply-templates/>
</xsl:template>                    

<xsl:template match="item">
     <span style="background-color=lightyellow;margin-left:200"><xsl:apply-templates /></span>
</xsl:template>

<xsl:template match="category"><xsl:value-of/></xsl:template>

<xsl:template match="name">
     <font color="red"><xsl:value-of/></font>
</xsl:template>

<xsl:template match="description">
     <font color="green"><xsl:value-of/></font>
</xsl:template>

<xsl:template match="image"><xsl:value-of/></xsl:template>

<xsl:template match="thumbnail"><xsl:value-of/></xsl:template>

<xsl:template match="inventory">
     <font color="blue"><xsl:value-of/></font>
</xsl:template>
</xsl:stylesheet>