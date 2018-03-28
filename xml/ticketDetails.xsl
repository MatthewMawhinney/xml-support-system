<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:param name="ticketId"/><!-- STORING TICKET ID# FOR CLICKED TICKET-->
  <xsl:param name="userRole"/>
  <xsl:output method="xml" omit-xml-declaration="yes" />
  <xsl:template match="/">
    <div class="tickets">
      <xsl:apply-templates select="tickets"/>
    </div>
  </xsl:template>
  <xsl:template match="tickets">
      <xsl:for-each select="ticket">
        <xsl:if test="@id=$ticketId"><!-- IF TICKET ID MATCHES TICKET ID CLICKED ON -->
          <div class="messages">
            <h3>Ticket #<xsl:value-of select="@id"/></h3>
            <p>
              Date Opened: <xsl:value-of select="@date"/>
            </p>
            <p>
              Category: <xsl:value-of select="category/text()"/>
            </p>
            <xsl:for-each select="messages/supportMsg">
              <div class="msgGroup">
                User ID: <xsl:value-of select="@userId"/>
                Posted: <xsl:value-of select="@dateTime"/>
                <div class="msgText">
                  <xsl:value-of select="text()"/>
                </div>
              </div>
            </xsl:for-each>
          </div>
        </xsl:if>
      </xsl:for-each>
  </xsl:template>
</xsl:stylesheet>
