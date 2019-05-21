<?php

$arr_start=array(
  "MUSIK" => "<table border=1>n",
  "CD" => "<tr>n",
  "TITEL" => "<td>",
  "BAND" => "<td>",
  "LAENGE" => "<td>",
  "PREIS" => "<td>"
);

$arr_end=array(
  "MUSIK" => "</table>n",
  "CD" => "</tr>n",
  "TITEL" => "</td>",
  "BAND" => "</td>",
  "LAENGE" => " min.</td>",
  "PREIS" => "</td>"
);

$xml_filename="musik.xml";

$xml_parser_handle=xml_parser_create();

function startTag($parser,$name,$attrs){
  echo "Anfangs-Tag <$name><br>";
}

function endTag($parser,$name){
  echo "Abschluss-Tag </$name><br>";
}

xml_set_element_handler($xml_parser_handle, "startTag", "endTag");

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