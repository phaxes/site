<?php

//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
  include '../../cls/site/'.$class_name.'.cls.php';
});

//Objekte instanziieren...
$SITE=new SITE("Benzinpreise","Regionale Benzinpreise","");

if(isset($_POST['location']) && isset($_POST['radius'])){
  session_unset();
  $_SESSION['location']=$_POST['location'];
  $_SESSION['radius']=$_POST['radius'];
}

if(isset($_POST['search_tag'])){
    $_SESSION['search_tag']=$_POST['search_tag'];
}

$SITE->header();
$SITE->add_javascript("../../js/site/geo_api_quest.js");
$SITE->navbar_start();
$SITE->form("stations.php");
$SITE->input_type("text","location","Ort (Deutschland)");
$SITE->input_type("text","radius","Umkreis");
$SITE->input_button("submit","light","station_location","Tankstellen anzeigen");
$SITE->form_end();
$SITE->navbar_end();
$SITE->jumbotron_start();
$SITE->card_deck_start();
//AJAX http-response
$SITE->card_deck_end();
$SITE->jumbotron_end();
$SITE->footer();

?>