<?php

//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
  include '../../cls/site/'.$class_name.'.cls.php';
});

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);

//Objekte instanziieren...
$SITE=new SITE("Benzinpreise","Regionale Benzinpreise","");

echo "<pre>"; print_r($SITE); echo "</pre>";
echo "<pre>"; print_r($GAS_STATIONS); echo "</pre>";
echo "<pre>"; print_r($_SESSION); echo "</pre>";
echo "<pre>"; print_r($_POST); echo "</pre>";

$SITE->header();
$SITE->add_javascript("../../js/site/gas_stations_api_ajax.js");
$SITE->add_javascript("../../js/site/geolocation_api.js");
$SITE->navbar_start();
$SITE->form("stations.php");
$SITE->input_type("text","location","Ort (Deutschland)");
$SITE->input_type("text","radius","Umkreis");
$SITE->input_button("submit","light","station_location","Tankstellen anzeigen");
$SITE->form_end();
$SITE->navbar_link("Näheste","nearest_station.php");
$SITE->navbar_link("Günstigste","cheapest_station.php");
$SITE->form_search("stations.php","search_tag","search_tag");
$SITE->navbar_end();
$SITE->jumbotron_start();
$SITE->card_deck_start();
$SITE->card_deck_end();
$SITE->jumbotron_end();
$SITE->footer();
?>