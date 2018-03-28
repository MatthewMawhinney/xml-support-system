<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:param name="userId"/>
  <xsl:output method="xml" omit-xml-declaration="yes" />
  <xsl:template match="/">
    <div class="tickets">
      <h2>Support Tickets</h2>
      <xsl:apply-templates select="tickets"/>
    </div>
  </xsl:template>
  <xsl:template match="tickets">
    <table>
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Date Opened</th>
          <th>Status</th>
          <th>Client ID</th>
        </tr>
      </thead>
      <tbody>
        <xsl:for-each select="ticket">
          <xsl:variable name="ticketId"><xsl:value-of select="@id"/></xsl:variable>
          <xsl:if test="clientId=$userId">
            <tr>
              <td>
                <xsl:value-of select="@id"/>
              </td>
              <td>
                <xsl:value-of select="@date"/>
              </td>
              <td>
                <xsl:value-of select="@status"/>
              </td>
              <td>
                <xsl:value-of select="clientId/text()"/>
              </td>
              <xsl:if test="@status='Open'">
                <td>
                  <form action="ticketDetails.php" method="POST">
                    <input type="hidden" name="viewId" value="{$ticketId}"/>
                    <input type="submit" name="view" class="viewBtn" value="View Ticket"/>
                  </form>
                </td>
              </xsl:if>
            </tr>
          </xsl:if>
        </xsl:for-each>
      </tbody>
    </table>
  </xsl:template>
</xsl:stylesheet>
