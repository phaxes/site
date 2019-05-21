<?php
//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
  include '../../cls/site/'.$class_name.'.cls.php';
});

//Objekte instanziieren...
$SITE=new SITE("Benzinpreise","Näheste Tankstelle","");
if(!empty($_SESSION['location']) && !empty($_SESSION['radius'])){
  $GAS_STATIONS=new GAS_STATIONS($_SESSION['location'],$_SESSION['radius']);
}else{
  $GAS_STATIONS=new GAS_STATIONS();
}

$SITE->header();
$SITE->navbar_start("stations.php");
$SITE->navbar_link("Günstigste","cheapest_station.php");
$SITE->navbar_end();
$SITE->jumbotron_start();
$SITE->card_deck_start();
if(isset($_SESSION['search_tag'])){
  $SITE->card($content_array=$GAS_STATIONS->nearest_station($_SESSION['search_tag']));
}elseif(!isset($_SESSION['search_tag'])){
  $SITE->card($content_array=$GAS_STATIONS->nearest_station());
}
$SITE->card_deck_end();
$SITE->jumbotron_end();
$SITE->footer();
?>