<?php

//Klassen einbinden...
require_once("../../inc/csv/CSV_TEST.inc.php");

// Klassen einbinden...
//require_once("../../inc/csv/CSV.inc.php");

// Objekte instanziieren...
//$CSV=new CSV();

//$array=$CSV->csv_object("../../csv/products/db_tyres.csv");

//echo "<pre>";
//print_r($array);
//echo "</pre>";
 
file_put_contents('../../csv/products/db_tyres.csv', str_replace(["\xEF\xBB\xBF", "\r"],'', file_get_contents('../../csv/products/db_tyres.csv'))); //BOM und CR+LF entfernen!
$csv = new CSV_TEST('../../csv/products/db_tyres.csv', ';');
$csv->setSelectedCols(['id','manufacturer','name','additional','price','availability','product_image']);  //optional
$data_array=$csv->toArray();
$array=$csv->load_products_array($data_array);
echo "<pre>";
print_r($array);
echo "</pre>";

?>