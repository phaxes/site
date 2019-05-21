<!DOCTYPE html>
<html>
<head>
  <title>Geocoding service</title>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 80%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #floating-panel {
      position: absolute;
      top: 10px;
      left: 25%;
      z-index: 5;
      background-color: #fff;
      padding: 5px;
      border: 1px solid #999;
      text-align: center;
      font-family: 'Roboto','sans-serif';
      line-height: 30px;
      padding-left: 10px;
    }
  </style>
</head>
<body>


<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: 49.432500, lng: 7.753639}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
    }

    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwve0J7oyMYy8-fXugM058JNEcuNOQWG0&callback=initMap">
</script>
<?php

$strasse="Hauptstraße";
$plz="67706";
$ort="Krickenbach";

$adresse=strval($strasse.",".$plz." ".$ort);

echo "<div id='floating-panel'>";
  echo "<input id='address' type='textbox' value='$adresse'>";
  echo "<input id='submit' type='button' value='Adresse Anzeigen'>";
  echo "<form action=customers.php method='post'><button type='submit'> Zurueck zu den Kunden </button> </form>";
  echo "</div>";
echo "<div id='map'></div>"; //Karte einfügen
$json=file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=krickenbach&key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc");
$json_array=json_decode($json,true);
$coords=array_column($json_array['results'][0], 'location'); //array column does not support 1D Arrays!!!
echo "<pre>"; print_r($coords); echo "</pre>";
$url="https://creativecommons.tankerkoenig.de/json/list.php?lat={$coords[0]['lat']}&lng={$coords[0]['lng']}&rad=10&sort=dist&type=all&apikey=655a5591-c017-ceb1-93ad-fbae0174af2b";
echo "<pre>"; print_r($url); echo "</pre>";
?>
</body>
</html>