<?php

//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
    include '../../cls/site/'.$class_name.'.cls.php';
});

//Debug-Tool
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Objekte instanziieren...
$SITE=new SITE("Suchergebnisse anzeigen","Suchergebnisse","Kategorie: Reifen");
$PRODUCTS=new PRODUCTS();

$data_array=$PRODUCTS->load_norm_data_array();

isset($_POST["search_string"]) ? $_SESSION["search_string"]=$_POST["search_string"] : $_POST["search_string"]="";

$SITE->header();
$SITE->navbar_start("products_page.php");
$SITE->navbar_end();
$match_array=$PRODUCTS->product_search($_SESSION["search_string"],$data_array);
$SITE->table($match_array);
$SITE->footer();

?>