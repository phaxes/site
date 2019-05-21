<?php
////Klassen einbinden
//spl_autoload_register(function($class_name) { // PHP 7.2
//    include '../../cls/site/'.$class_name.'.cls.php';
//});
//
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//
////Objekte instanziieren...
//$SITE=new SITE("OIKOS Login","Anmeldeformular","");
//
//$SITE->header();
//$SITE->navbar_start();
//echo "</ul>";
//$SITE->navbar_end();
//$SITE->container_start();
//$SITE->form("login.php");
//$SITE->col_input("8","OIKOS Login:");
//$SITE->input_type("text","username","Benutzerdaten eingeben");
//$SITE->input_type("password","password","Kennwort eingeben");
//$SITE->input_button("submit","secondary","login","Login");
//$SITE->container_end();
//$SITE->footer();
//

header('Location: /php/scripts/stations.php');

?>