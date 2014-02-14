xquery version "1.0";
<query3>
{
for $x in doc("booksales.xml")/BookStore/SalesInfo/Sale
for $y in doc("booksales.xml")/BookStore/Books/Book
where $x/bookISBN = $y/bookISBN
return(<bookName> {data($y/bookName)}</bookName>,
<Sum> {sum($x/BookSales/Everything/sales/UnitsSold)}</Sum>)
}
</query3>