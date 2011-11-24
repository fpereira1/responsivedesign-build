<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="xml" indent="yes" omit-xml-declaration="yes" />

	<xsl:template match="/root">
		<div class="container">

			<xsl:for-each select="div[@class='new']">
				<div class="clearfix">
					<xsl:for-each select="span">
            <div class="{@class}">Insert your content here.</div>
					</xsl:for-each>
				</div>
			</xsl:for-each>

		</div>
	</xsl:template>

</xsl:stylesheet>
