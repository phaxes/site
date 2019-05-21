<?php
//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
    include '../../cls/site/'.$class_name.'.cls.php';
});

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Objekte instanziieren...
$SITE=new SITE("Artikel anzeigen","Artikelübersicht","Kategorie: Reifen");
$PRODUCTS=new PRODUCTS();

$data_array=$PRODUCTS->load_norm_data_array();

$SITE->header();
$SITE->navbar_start("products_page.php");
$SITE->form_search("result_page.php","search_string","search_string");
$SITE->navbar_end();
$SITE->table($data_array);
$SITE->footer();
?>