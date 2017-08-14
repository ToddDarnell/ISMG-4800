<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-16" indent="yes"/>
    <xsl:param name="file"/>
    <xsl:template match="pages">
      <xsl:copy-of  select="page[@name=$file]"/>
    </xsl:template>
</xsl:stylesheet>
