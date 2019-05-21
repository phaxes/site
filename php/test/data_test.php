<?php

//Klassen einbinden...
spl_autoload_register(function($class_name) { // PHP 7.2
    include '../../inc/'.$class_name.'.inc.php';
});

//Objekte instanziieren...
$DATA=new DATA();

//$array=$CSV->csv_file_read("../../csv/products/db_tyres.csv");

$array=$DATA->load_normalized_data();

echo "<pre>";
echo count($array);
echo "</pre>";

?>