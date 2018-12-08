<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	version="1.0">
	<xsl:template match="DIRETORIO">
		<DIRETORIO>
			<PATH>
				<xsl:value-of select="PATH" />
			</PATH>
			<xsl:for-each select="PASTA">
				<xsl:if test="starts-with(NOME,/DIRETORIO/CRITERIO)">
					<PASTA>
						<CAMINHO>
							<xsl:value-of select="CAMINHO" />
						</CAMINHO>
						<NOME>
							<xsl:value-of select="NOME" />
						</NOME>
						<QUANTIDADEITENS>
							<xsl:value-of select="QUANTIDADEITENS" />
						</QUANTIDADEITENS>
					</PASTA>
				</xsl:if>
			</xsl:for-each>
		</DIRETORIO>
	</xsl:template>
</xsl:stylesheet>
