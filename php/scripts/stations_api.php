<?php

//Klassen einbinden
spl_autoload_register(function($class_name) { // PHP 7.2
  include '../../cls/site/'.$class_name.'.cls.php';
});

$SITE=new SITE("","","");

if(isset($_POST['lat']) && isset($_POST['lon'])){ //POST aus xmlhttp-request
  $_SESSION['lat']=$_POST['lat'];
  $_SESSION['lon']=$_POST['lon'];
}

if(!empty($_SESSION['location']) && !empty($_SESSION['radius'])){
  $GAS_STATIONS=new GAS_STATIONS($_SESSION['location'],$_SESSION['radius']);
}else{
  $GAS_STATIONS=new GAS_STATIONS("","");
}

if(isset($_SESSION['search_tag'])){
  $SITE->card($content_array=$GAS_STATIONS->search_stations($_SESSION['search_tag']));
}else{
  $SITE->card($content_array=$GAS_STATIONS->all_stations());
}

?>

