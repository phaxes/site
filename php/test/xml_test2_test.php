<?php

//Klassen einbinden...
require_once("../../inc/xml/XML_TEST2.inc.php");

//Objekte instanziieren...
$XML=new XML_TEST2();

$xml_string=utf8_encode(file_get_contents('../../xml/products/db_tyres.xml')); //Datei abrufen
$return=$XML->xml_object($xml_string); //Datei verarbeiten 
$return=$XML->object_array($return);  //Inhalt ausgeben 

//$array=$XML->load_products_array();

echo "<pre>";
print_r($return);
echo "</pre>";

?>

