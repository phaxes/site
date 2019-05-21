<?php

//parse into struct

$xml_filename="../../xml/products/db_tyres.xml";

$xml_parser_handle = xml_parser_create(); //Handle für Parser erstellen

if(!($parse_handle=fopen($xml_filename,'r'))){ 
  die("FEHLER: Datei $xml_filename nicht gefunden.");
}

$xml_string=utf8_encode(file_get_contents($xml_filename));
xml_parse_into_struct($xml_parser_handle,$xml_string,$werte,$index);
xml_parser_free($xml_parser_handle);

foreach($index as $val){
  $xml_data_array[]=array($werte[$index["ID"][0]]["value"],
                          $werte[$index["MANUFACTURER"][0]]["value"],
                          $werte[$index["NAME"][0]]["value"],
                          $werte[$index["ADDITIONAL"][0]["value"]],
                          $werte[$index["PRICE"][0]]["value"],
                          $werte[$index["AVAILABILITY"][0]]["value"],
                          $werte[$index["PRODUCT_IMAGE"][0]]["value"]);
}

echo "<pre>";
print_r($xml_data_array);
echo "</pre>";

?>