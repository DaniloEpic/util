<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
 <xsl:template match="ARQUIVOS">
 
 <xsl:for-each select="ARQUIVO">
 <span style="margin:5px;padding:3px;cursor:pointer;text-decoration:none;">
 <xsl:attribute name="onclick">selecionar_arquivo('<xsl:value-of select="CAMINHO"/>')</xsl:attribute>
 <xsl:attribute name="onmouseover">this.style.textDecoration = "underline";</xsl:attribute>
 <xsl:attribute name="onmouseout">this.style.textDecoration = "";</xsl:attribute>
 <xsl:value-of select="NOME"/>
 </span><xsl:text> </xsl:text>
 </xsl:for-each>
 
 </xsl:template>
</xsl:stylesheet>