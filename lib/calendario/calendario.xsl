<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="MES">
	
	<xsl:variable name="hoje">
	<xsl:value-of select="HOJE/@dia"/>/<xsl:value-of select="HOJE/@mes"/>/<xsl:value-of select="HOJE/@ano"/>
	</xsl:variable>
	
	<xsl:variable name="selecionada">
	<xsl:value-of select="@dia"/>/<xsl:value-of select="@mes"/>/<xsl:value-of select="@ano"/>
	</xsl:variable>
	
	<table border="1">
	<tr>
	<th>
	<a>
	<xsl:attribute name="href">javascript:widgetCalendario.mes_anterior('<xsl:value-of select="$selecionada"/>')</xsl:attribute>
	&lt;
	</a>
	</th>
	<th colspan="5"><xsl:value-of select="@nome"/> de <xsl:value-of select="@ano"/></th>
	<th>
	<a>
	<xsl:attribute name="href">javascript:widgetCalendario.proximo_mes('<xsl:value-of select="$selecionada"/>')</xsl:attribute>
	&gt;
	</a>
	</th>
	</tr>
	<tr>
	<th><span>Dom</span></th>
	<th><span>Seg</span></th>
	<th><span>Ter</span></th>
	<th><span>Qua</span></th>
	<th><span>Qui</span></th>
	<th><span>Sex</span></th>
	<th><span>Sáb</span></th>
	</tr>
	<xsl:for-each select="SEMANA">
	<tr>
	<xsl:for-each select="DATA">
	<td>
	<xsl:choose>
	 <xsl:when test="MES = /MES/@mes">
	 <xsl:attribute name="class">mesatual</xsl:attribute>
	 </xsl:when>
	</xsl:choose>
	<span>
	<xsl:attribute name="onclick">widgetCalendario.selecionar('<xsl:value-of select="concat(DIADOMES,'/',MES,'/',ANO)"/>')</xsl:attribute>
	 <xsl:choose>
	  <xsl:when test="concat(DIADOMES,'/',MES,'/',ANO) = $hoje">
	  <xsl:attribute name="class">hoje</xsl:attribute>
	  </xsl:when>
	  <xsl:when test="concat(DIADOMES,'/',MES,'/',ANO) = $selecionada">
	  <xsl:attribute name="class">selecionada</xsl:attribute>
	  </xsl:when>
	 </xsl:choose>
	<xsl:value-of select="DIADOMES"/>
	</span>
	</td>
	</xsl:for-each>
	</tr>
	</xsl:for-each>
	</table>
	
	</xsl:template>
</xsl:stylesheet>