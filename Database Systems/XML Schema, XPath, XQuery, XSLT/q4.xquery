xquery version "1.0";
<query4>
{
let $a:=/Bookstore
for $book in $a/Books/Book, $author in $a/Authors/Author
where  $book/TotalID/ID = $author/authorID and not($book intersect(
for $book1 in $a/Books/Book, $b_order in $a/Sales/Sale
where $book1/bookISBN = $b_order/bookISBN
return $book1
))
order by $author/authorID
return 
<t1><name>{data($author/authorID)}</name>
<ISBN>{data($book/bookISBN)}</ISBN>
<Format>{data($book/TotalBookFormat/bookFormats/bookFormat)}</Format>
<BookName>{data($book/bookName)}</BookName></t1>
}
</query4>