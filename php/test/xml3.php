<?php

$arr_start=array(
  "ROOT" => "ROOT",
  "ROW" => "ROW",
  "ID" => "<table border=1>n",
  "MANUFACTURER" => "<tr>n",
  "NAME" => "<td>",
  "ADDITIONAL" => "<td>",
  "PRICE" => "<td>",
  "AVAILABILITY" => "<td>",
  "PRODUCT_IMAGE" => "<td>"
);

$arr_end=array(
  "ROOT" => "ROOT",
  "ROW" => "ROW",
  "ID" => "</table>n",
  "MANUFACTURER" => "</tr>n",
  "NAME" => "</td>",
  "ADDITIONAL" => "</td>",
  "PRICE" => " min.</td>",
  "AVAILABILITY" => "</td>",
  "PRODUCT_IMAGE" => "</td>"
);

function startTag($parser,$name,$attrs){
  
  global $arr_start;
  
  if($arr_start[$name]){
    echo $arr_start[$name];
  }else{
    echo "<$name>???<br>";
  }
}

function endTag($parser,$name){
  
  global $arr_end;
  
  if($arr_end[$name]){
    echo $arr_end[$name];
  }else{
    echo "</$name>???<br>";
  }
}

function zeigeDaten($parser,$data){
  echo $data;
}

$xml_filename="../../xml/products/db_tyres.xml";

$xml_parser_handle=xml_parser_create();

xml_set_element_handler($xml_parser_handle, "startTag", "endTag");
xml_set_character_data_handler($xml_parser_handle,"zeigeDaten");

if(!($parse_handle=fopen($xml_filename,'r'))){
  die("FEHLER: Datei $xml_filename nicht gefunden.");
}

while($xml_data=fread($parse_handle,4096)){
  if(!xml_parse($xml_parser_handle,$xml_data,feof($parse_handle))){
    die(sprintf('XML error: %s at line %d',xml_error_string(xml_get_error_code($xml_parser_handle)),xml_get_current_line_number($xml_parser_handle)));
  }
}

xml_parser_free($xml_parser_handle);

?>