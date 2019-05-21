<?php


$strCSV = '"id";"manufacturer";"name";"additional";"price ";"a vailability";"product_image"
"39676";"TOYO";"KUMHO 857 205/65R16C 107T";;"59.99";"32";"http://media2.tyre24.de/images/tyre/857-R-w300-h300-br1.jpg"
"196835";"TOYO";"MARSHAL 857 235/65 R16 115R";"DOT 2008";"87.40";"1";"http://media2.tyre24.de/images/tyre/857-R-w300-h300-br1.jpg"';

$csv =SplFileObject::createFromString($strCSV);

$selectedCols = array(
  0 => "id",
  1 => "title",
  6 => "img",
  4 => "price"
);
$csv->setSelectedCols($selectedCols);

debug::write($csv->toArray());



?>  