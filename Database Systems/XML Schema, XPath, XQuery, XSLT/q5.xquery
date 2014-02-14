xquery version "1.0";
<query5>
{
for $sales in doc("booksales.xml")/BookStore/SalesInfo/Sale/BookSales/Everything/sales
let $Saleretailer := $sales/Retailer
let $Saleprice := $sales/Price

let $numericTwo :='2'
for $attempt in doc("booksales.xml")/BookStore/SalesInfo/Sale
let $book :=$attempt/bookISBN
for $bookSales in doc("booksales.xml")/BookStore/SalesInfo/Sale/BookSales
let $bookFormat := $bookSales/Everything/bookFormat

return data($Saleprice)
}
</query5>