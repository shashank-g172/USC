<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8"/>
<xsl:template match="/">
<html>
<head><title>BookStore</title>
</head>
<body>
<p style="font-family:Arial;font-size:12px;"><u><i>Authors</i></u></p>
<table  border="2px" style="background-color:grey;" >
  <THEAD>
	<TR align="center" >
	   <TD  style="font-family:Arial;font-size:12px;"><B>ID</B></TD>
 	   <TD  style="font-family:Arial;font-size:12px;"><B>Name</B></TD>
	   <TD  style="font-family:Arial;font-size:12px;"><B>Email</B></TD>
	   <TD  style="font-family:Arial;font-size:12px;"><B>Phone</B></TD>
	</TR>
  </THEAD> 
   <TBODY>
	<xsl:for-each select="BookStore/Authors/Author">
	<TR align="center">	
	   <TD  style="font-family:Arial;font-size:12px;"><xsl:value-of select="authorID" /></TD>
 	   <TD  style="font-family:Arial;font-size:12px;"><xsl:value-of select="authName" /></TD>
	   <TD  style="font-family:Arial;font-size:12px;"><xsl:value-of select="authEmail" /></TD>
	   <TD  style="font-family:Arial;font-size:12px;"><xsl:value-of select="authPhone" /></TD>
	</TR>
    </xsl:for-each>
  </TBODY>
</table>
<p style="font-family:Sans-Serif;font-size:14px;"><u><i>Books</i></u></p>
<table  border="1px" style="background-color:blue;">
  <THEAD>
	<TR align="center">
	<TD  rowspan="2" style="font-family:Sans-Serif;font-size:14px;"><B>ISBN</B></TD>
 	   <TD  rowspan="2" style="font-family:Sans-Serif;font-size:14px;"><B>Title</B></TD>
	   <TD   rowspan="2" style="font-family:Sans-Serif;font-size:14px;"><B>Author</B></TD>
	   <TD   colspan="2" style="font-family:Sans-Serif;font-size:14px;"><B>Formats</B></TD>
	   <TD   rowspan="2" style="font-family:Sans-Serif;font-size:14px;"><B>Weeks on Bestseller List</B></TD>
	</TR>
	<TR align="center">
		<TD style="font-family:Sans-Serif;font-size:14px;"><B>Format</B></TD>
		<TD style="font-family:Sans-Serif;font-size:14px;"><B>MSRP</B></TD>
	</TR>
   </THEAD>
   <TBODY>
   <xsl:for-each select="BookStore/Books/Book">
	<TR align="center">
	   <xsl:variable name="cellsPerRow" select="count(TotalBookFormat/bookFormats)"/>	
	   <TD  rowspan = "{$cellsPerRow}" style="font-family:Times;font-size:12px;"><xsl:value-of select="bookISBN" /></TD>
	   <TD  rowspan = "{$cellsPerRow}" style="font-family:Times;font-size:12px;"><xsl:value-of select="bookName" /></TD>
	   <TD  rowspan ="{$cellsPerRow}" style="font-family:Times;font-size:12px;">
	   <xsl:for-each select="TotalID/ID">
	   <xsl:value-of select="text()" /> 
	   
	   <xsl:if test="not(position() = last())">, 
	   </xsl:if>
	   
	   </xsl:for-each>
	   </TD>
		<xsl:for-each select="TotalBookFormat/bookFormats[1]">
		
			<TD  rowspan= "1" style="font-family:Times;font-size:12px;"><xsl:value-of select="bookFormat" /></TD> 
			<TD  rowspan= "1" style="font-family:Times;font-size:12px;"><xsl:value-of select="bookMSRP" /></TD>
			
		
		</xsl:for-each>
   	   <TD  rowspan = "{$cellsPerRow}" style="font-family:Times;font-size:12px;"><xsl:value-of select="bookWeeksBSL" /></TD>
	</TR>
	
	<xsl:for-each select="TotalBookFormat/bookFormats">
		<xsl:if test = "position() != 1" >
		<TR align="center">
			<TD  rowspan= "1" style="font-family:Times;font-size:12px;"><xsl:value-of select="bookFormat" /></TD> 
			<TD  rowspan= "1" style="font-family:Times;font-size:12px;"><xsl:value-of select="bookMSRP" /></TD>
		</TR>
		</xsl:if>
		</xsl:for-each>
	</xsl:for-each>
    </TBODY>
 </table>
 
 <p style="font-family:Times;font-size:11px;"><u><i>SalesInfo</i></u></p> 
 <table  border="2px" style="background-color:pink;">
  <THEAD>
	<TR align="center">
	<TD  rowspan="3" style="font-family:Times;font-size:11px;"><B>Book</B></TD>
 	   <TD  colspan="4" style="font-family:Times;font-size:11px;"><B>BookSales</B></TD>
	</TR>
	<TR align="center">
	   <TD   rowspan="2" style="font-family:Times;font-size:11px;"><B>Format</B></TD>
	   <TD   colspan="3" style="font-family:Times;font-size:11px;"><B>Sales</B></TD>
	</TR>
	<TR align="center">
	   <TD   style="font-family:Times;font-size:11px;"><B>Retailer</B></TD>
	    <TD   style="font-family:Times;font-size:11px;"><B>Price</B></TD>
		 <TD   style="font-family:Times;font-size:11px;"><B>Units Sold</B></TD>
	</TR>
</THEAD>
<TBODY>
<xsl:for-each select="BookStore/SalesInfo/Sale">
<TR align="center">
	   <xsl:variable name="cellsPerRow" select="count(BookSales/Everything/sales)"/>	
	   <TD  rowspan = "{$cellsPerRow}" style="font-family:Times;font-size:14px;"><xsl:value-of select="bookISBN" /></TD> 
	   
	  <xsl:for-each select="BookSales/Everything[1]" >
	   <TD rowspan="cellsPerRow" style="font-family:Times;font-size:11px;"><xsl:value-of select="bookFormat" /></TD>
	  </xsl:for-each>

	   <xsl:for-each select="BookSales/Everything[1]/sales[1]">
	   <TD rowspan="1" style="font-family:Times;font-size:11px;"><xsl:value-of select="Retailer" /></TD>
	   <TD rowspan="1" style="font-family:Times;font-size:11px;"><xsl:value-of select="Price" /></TD>
	   <TD rowspan="1" style="font-family:Times;font-size:11px;"><xsl:value-of select="UnitsSold" /></TD>
	   </xsl:for-each>
	   </TR>
		<xsl:for-each select="BookSales/Everything/sales">
		<xsl:if test = "position() != 1" >
		<TR align="center">
			
			<TD  rowspan= "1" style="font-family:Times;font-size:11px;"><xsl:value-of select="Retailer" /></TD> 
			<TD rowspan="1" style="font-family:Times;font-size:11px;"><xsl:value-of select="Price" /></TD>
	        <TD rowspan="1" style="font-family:Times;font-size:11px;"><xsl:value-of select="UnitsSold" /></TD>
		</TR>
		</xsl:if>
	   
		</xsl:for-each>
	</xsl:for-each>
</TBODY> 
</table> 
 </body>
 </html>
</xsl:template>
</xsl:stylesheet>
