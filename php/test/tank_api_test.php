<?php

/**
 * @copyright Philip Schulz
 */

$json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php?lat=49.3698735&lng=7.6796421&rad=10&sort=dist&type=all&apikey=eb4608a6-89bb-5993-6ec6-029781875f90');   // Demo-Key ersetzen!
$data = json_decode($json,true);
echo "<pre>";;
print_r($data);
echo "</pre>";

?>