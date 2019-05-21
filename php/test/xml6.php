
<?php

class AminoAcid {
    var $titel;  // aa name
    var $band;    // three letter symbol
    var $laenge;  // one letter code
    var $preis;  // hydrophobic, charged or neutral
    
    function AminoAcid ($aa) 
    {
        foreach ($aa as $k=>$v)
            $this->$k = $aa[$k];
    }
}

function readDatabase($filename) 
{
    // read the XML database of aminoacids
    $data = implode("", file($filename));
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, $data, $values, $tags);
    xml_parser_free($parser);

    // loop through the structures
    foreach ($tags as $key=>$val) {
      if ($key == "row") {
        $molranges = $val;
        // each contiguous pair of array entries are the 
        // lower and upper range for each molecule definition
        for ($i=0; $i < count($molranges); $i+=2) {
            $offset = $molranges[$i] + 1;
            $len = $molranges[$i + 1] - $offset;
            $tdb[] = parseMol(array_slice($values, $offset, $len));
        }
      } else {
        continue;
      }
    }
    return $tdb;
}

function parseMol($mvalues) 
{
    for ($i=0; $i < count($mvalues); $i++) {
        $mol[$mvalues[$i]["tag"]] = $mvalues[$i]["value"];
    }
    return new AminoAcid($mol);
}

$db = readDatabase("amino.xml");
echo "** Database of AminoAcid objects:\n";
echo "<pre>";
print_r($db);
echo "</pre>";

?>
