<?php

//Klassen einbinden...
require_once("../../inc/xml/XMLPARSE.inc.php");

//Objekte instanziieren...
$XMLPARSE=new XMLPARSE();

//$array=$CSV->csv_file_read("../../csv/products/db_tyres.csv");

$array=$XMLPARSE->load_products_array();

echo "<pre>";
print_r($array);
echo "</pre>";

?>

