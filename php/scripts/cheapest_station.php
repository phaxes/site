<?php

//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
  include '../../cls/site/'.$class_name.'.cls.php';
});

//Objekte instanziieren...
$SITE=new SITE("Benzinpreise","Günstigste","");

if(!empty($_SESSION['location']) && !empty($_SESSION['radius'])){
  $GAS_STATIONS=new GAS_STATIONS($_SESSION['location'],$_SESSION['radius']);
}else{
  $GAS_STATIONS=new GAS_STATIONS("","");
}

$SITE->header();
$SITE->navbar_start("stations.php");
$SITE->navbar_end();
$SITE->jumbotron_start();
$SITE->card_deck_start();
if(isset($_SESSION['search_tag']) && isset($_SESSION['lat']) && isset($_SESSION['lon'])){
  $SITE->card($content_array=$GAS_STATIONS->cheapest_station($_SESSION['search_tag']));
  unset($_SESSION['search_tag']);
}elseif(isset($_SESSION['lat']) && isset($_SESSION['lon'])){
  $SITE->card($content_array=$GAS_STATIONS->cheapest_station(""));
}
$SITE->card_deck_end();
$SITE->jumbotron_end();
$SITE->footer();
echo "<pre>"; print_r($GLOBALS); echo "</pre>";
?>