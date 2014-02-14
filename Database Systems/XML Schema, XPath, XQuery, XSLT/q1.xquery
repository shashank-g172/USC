xquery version "1.0";
<query1>
{
for $x in doc("booksales.xml") /BookStore/Books/Book
for $y in doc("booksales.xml") /BookStore/Authors/Author
where $y/authorID = $x/TotalID/ID
order by number($x/bookWeeksBSL) descending
return <BookStore><bookISBN>{ data($x/bookISBN) }</bookISBN> <bookName> { data($x/bookName) } </bookName> <authName> {data($y/authName) }</authName></BookStore>
}
</query1>