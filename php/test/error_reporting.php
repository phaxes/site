<?php
// E_NOTICE ist sinnvoll um uninitialisierte oder
// falsch geschriebene Variablen zu entdecken
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set("display_errors", 1);
include("csv_test.php");
?>