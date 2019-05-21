<?php

/**
 * @copyright Philip Schulz
 */

//Klassen einbinden PHP 7.2
spl_autoload_register(function ($class_name) { //muss alles in Klassenhierarchie
include '../../inc/'.$class_name.'.inc.php';
});

error_reporting(-1);
ini_set('display_errors', TRUE);

//Objekte instanziieren...
$PRODUCTS=new PRODUCTS();

$data_array=$PRODUCTS->load_norm_data_array();
//echo "<pre>";
//var_dump($_POST['search_string']);
//echo "</pre>";

//$result_array=$PRODUCTS->product_search($_POST['search_string'],$data_array);


$stockVehiclesJSON = <<<EOF
[{"marke":"BMW","typ":"520d","baujahr":2017,"preis":10000},
{"marke":"BMW","typ":"325d","baujahr":2016, "preis":19000},
{"marke":"Audi","typ":"A3","baujahr":2015, "preis":18000},
{"marke":"Audi","typ":"Q5","baujahr":2017, "preis":27000},
{"marke":"Mercedes","typ":"C220D","baujahr":2016, "preis":28000},
{"marke":"Mercedes","typ":"E300D","baujahr":2015, "preis":12000}]
EOF;

$stockVehicles = json_decode($stockVehiclesJSON, TRUE);
//$stockVehicles=json_encode($stockVehiclesJSON);

//echo "<pre>";
//print_r($stockVehicles);
//echo "</pre>";

//class myFilter {
//  private $key;
//  private $value;
//  
//  function __construct($key, $value){
//    $this->key = $key;
//    $this->value = $value;
//  }
//  function isEqual($item){
//    $myKey = $this->key;
//    return $item->$myKey == $this->value;
//  }
//  function isGreater($item){
//    $myKey = $this->key;
//    return $item->$myKey > $this->value;
//  }
//  function isGreaterOrEqual($item){
//    $myKey = $this->key;
//    return $item->$myKey >= $this->value;
//  }
//  function isLower($item){
//    $myKey = $this->key;
//    return $item->$myKey < $this->value;
//  }
//  function isLowerOrEqual($item){
//    $myKey = $this->key;
//    return $item->$myKey <= $this->value;
//  }
//  function contain($item){
//    $myKey = $this->key;
//    return (strpos(strtolower($item[$myKey],strtolower($this->value))!==false));
//  }
//}
//foreach($data_array as $index=>$row){
//  var_dump(array_filter($row, array(new myFilter("name", "KUMHO 205/65"), 'contain')));
//}
////zeige alle Fahrzeuge mit einem BM im Markennamen
//
////zeige alle Fahrzeuge Preis höher 20000
//echo "<pre>";
////var_dump(array_filter($stockVehicles, array(new myFilter('preis', "20000"), 'isGreater')));
//echo "</pre>";  

$myData = "Mercedes C 220 D silbergrau";
$mySearch = "C220D";

var_dump ( stristr(preg_replace('/\s+/', '', $myData), preg_replace('/\s+/', '',$mySearch)) ? $myData : null);

$mySearch = "X220D";
var_dump ( stristr(preg_replace('/\s+/', '', $myData), preg_replace('/\s+/', '',$mySearch)) ? $myData : null);  


?>