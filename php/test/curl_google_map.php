<?php

$apiKey = "AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc";

$url = "https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=".$apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);
curl_close($ch);

$data = json_decode($result,true);

//Ausgabe
echo "<pre>"; print_r($data); echo "</pre>";

$components = $data["results"][0]["address_components"];

// filter the address_components field for type : $type
function filter($components, $type){
  return array_filter($components, function($component) use ($type) {
    return array_filter($component["types"], function($data) use ($type) {
      return $data == $type;
    });
  });
}

$zipcode = array_values(filter($components, "postal_code"))[0]["long_name"];
$citystate = array_values(filter($components, "administrative_area_level_1"))[0]["long_name"];

var_dump($zipcode);
var_dump($citystate);

?>