<?php

//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
  include '../../cls/site/'.$class_name.'.cls.php';
});

error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Objekte instanziieren...
$SITE=new SITE("Benzinpreise","Regionale Benzinpreise","");

if(!empty($_SESSION['location']) && !empty($_SESSION['radius'])){
  $GAS_STATIONS=new GAS_STATIONS($_SESSION['location'],$_SESSION['radius']);
}else{
  $GAS_STATIONS=new GAS_STATIONS();
}

if(isset($_POST['search_tag'])){
  $_SESSION['search_tag']=$_POST['search_tag'];
}

echo "<pre>"; print_r($_POST); echo "</pre>";
echo "<pre>"; print_r($_SESSION); echo "</pre>";

$SITE->header();
$SITE->navbar_start("stations.php");
$SITE->navbar_link("Günstigste","cheapest_station.php");
$SITE->navbar_end();
$SITE->jumbotron_start();
$SITE->card_deck_start();
$SITE->card($content_array=$GAS_STATIONS->search_station($_SESSION['search_tag']));
$SITE->card_deck_end();
$SITE->jumbotron_end();
$SITE->footer();
?>