<?php

session_start();
session_unset();

header("Location: https://fs.rattleomv.net/site/php/scripts/stations_user_denied.php");
exit;

?>