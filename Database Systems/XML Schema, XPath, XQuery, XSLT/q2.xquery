xquery version "1.0";
<query2>
{
let $eBook1:=
(
  for  $y in doc("booksales.xml")/BookStore/Books/Book
  where $y/TotalBookFormat/bookFormats/bookFormat = "eBook"
  return min($y/TotalBookFormat/bookFormats/bookMSRP)
)
let $eBook2:=
(
   for  $y1 in doc("booksales.xml")/BookStore/Books/Book
   where $y1/TotalBookFormat/bookFormats/bookFormat = "eBook"
   and min($eBook1)= $y1/TotalBookFormat/bookFormats/bookMSRP 
    return $y1
)
let $eAuthor:=
(
  for  $z1 in doc("booksales.xml")/BookStore/Authors/Author
  where $z1/authorID = $eBook2/TotalID/ID
  return $z1
)
return $eAuthor
}
</query2>