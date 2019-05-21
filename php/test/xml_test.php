<?php

//Klassen einbinden...
require_once("../../inc/xml/XML.inc.php");

//Objekte instanziieren...
$XML=new XML();

//$array=$XML->xml_file_read("../../xml/products/db_tyres.xml");

//$array=$XML->xml_object("../../xml/products/db_tyres.xml");
//$array=$XML->object_array($array);

$array=$XML->load_products_array();

echo "<pre>";
print_r($array);
echo "</pre>";

?>

