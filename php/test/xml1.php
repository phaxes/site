<?php

$xml_filename="musik.xml";

$xml_parser_handle = xml_parser_create();

if (!($parse_handle = fopen($xml_filename,'r'))){
  die("FEHLER: Datei $xml_filename nicht gefunden.");
}

while($xml_data = fread($parse_handle, 4096)){
  if(!xml_parse($xml_parser_handle, $xml_data, feof($parse_handle))){
    die(sprintf('XML error: %s at line %d',xml_error_string(xml_get_error_code($xml_parser_handle)),xml_get_current_line_number($xml_parser_handle)));
  }
}
xml_parser_free($xml_parser_handle);

?>