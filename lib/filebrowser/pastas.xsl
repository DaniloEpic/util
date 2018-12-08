<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:template match="PASTAS">
 
 <xsl:for-each select="PASTA">
 <span style="text-decoration:underline;color:blue;cursor:pointer;font-family:monospace;">
 <xsl:attribute name="onclick">ir_para_pasta("<xsl:value-of select="CAMINHO"/>")</xsl:attribute>
 <xsl:value-of select="NOME"/>
 </span><br/>
 </xsl:for-each>
 
 </xsl:template>
</xsl:stylesheet>