<?php

//Klassen einbinden PHP 7.2
spl_autoload_register(function ($class_name) { //muss alles in Klassenhierarchie
include '../../inc/'.$class_name.'.inc.php';
});

error_reporting(-1);
ini_set('display_errors', TRUE);

//Objekte instanziieren...
$PRODUCTS=new PRODUCTS();

$data_array=$PRODUCTS->load_norm_data_array();

$foo = array (
    0 => Array (
    "id" => 39676,
    "title" => "TOYO",
    "description" => "KUMHO 857 205/65R16C 107T",
    "image_link" => "http:media2.tyre24.de/images/tyre/857-R-w300-h300-br1.jpg",
    "price" => "99.99"
  ),
    1 => Array (
        "id" => 196835,
        "title" => "TOYO",
        "description" => "MARSHAL 857 235/65 R16 115R",
        "image_link" => "http:media2.tyre24.de/images/tyre/857-R-w300-h300-br1.jpg",
        "price" => "49.99"
    ),
    2 => Array (
        "id" => 251647,
        "title" => "TOYO",
        "description" => "MARSHAL 857 195/75R16C 107R 8PR",
        "image_link" => "http:media2.tyre24.de/images/tyre/857-R-w666-h300-br1.jpg",
        "price" => "59.99"
    )
);

//echo "<pre>";
//print_r($data_array);
//echo "</pre>";
//
//echo "<pre>";
//print_r($foo);
//echo "<pre>";


function searchMultiArray($search_string,$data_array,$search_key = ""){
  $result_array=array();
  
  foreach($data_array as $key=>$row){
    if($search_key === "" && in_array($search_string,$row)){
      $result_array[]=$row;
    }elseif(isset($row[$search_key]) && $row[$search_key] == $search_string){
      $result_array[]=$row;
    }
  }
  return $result_array;
}

echo "<pre>";
//print_r($data_array[array_search('59.99',array_column($data_array,'price'))]);
//print_r(array_filter($data_array,function($item){ return $item['title']==='TO';}));
//print_r(searchMultiArray("205/65", $data_array));
//print_r(searchMultiArray("134.78", $data_array));
print_r(array_filter($data_array, function($item){ return stristr( $item['description'], "205/65");}));  
echo "</pre>";
?>