<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" version="1.0" encoding="UTF-16" indent="yes"/>
  <xsl:template match="catalog">
    <script language="JScript"><xsl:comment><![CDATA[
           // Create an Version 3 XML DOMDocument and load the category source document into it
           var xmlDoc = new ActiveXObject("Msxml2.DomDocument");
           //xmlDoc.loadXML(document.XMLDocument.xml)
           xmlDoc.load("outdoordepot.xml")
                    
           var xslDoc = new ActiveXObject("Msxml2.FreeThreadedDOMDocument");
           xslDoc.async = false;
           xslDoc.validateOnParse = false;
           xslDoc.load("outdoordepot_item.xsl")
        
           var xslTemplate = new ActiveXObject("Msxml2.XSLTemplate");
           xslTemplate.stylesheet = xslDoc;


           function transformDetail(s)
           {
                 xslProc = xslTemplate.createProcessor();
                 xslProc.input = xmlDoc;
                 xslProc.addParameter("pItemID", s);
                 xslProc.transform;
                 detailTarget.innerHTML = xslProc.output;
           }
             
     ]]></xsl:comment></script>
          <div id="detailTarget">
              <table border="0" cellpadding="15">
                  <xsl:apply-templates select="item"/>
             </table>
          </div>
 </xsl:template>
 
  <xsl:template match="item">
    <tr>
    <td>
      <img width="80" height="80">
      <xsl:attribute name="src">../images/<xsl:value-of select="thumbnail"/></xsl:attribute>
      </img>
    </td>
    <td> 
       <a href="#" onclick="transformDetail('{@id}')"><xsl:value-of select="name"/></a></td>
    </tr>
  </xsl:template>
</xsl:stylesheet>