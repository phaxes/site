<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Get Visitor Location using</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

  <script>

      $(window).on("load",function(){
          if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);
          }else{
            $('#location').html('Geolocation is not supported by this browser.');
          }
      });

      function showLocation(position) {
        var lat=encodeURIComponent(position.coords.latitude);
        var lng=encodeURIComponent(position.coords.longitude);
        var data_container=document.createElement("div");
        data_container.setAttribute("id","geolocation");
        document.getElementById("location").appendChild(data_container);

          $.ajax({
              url: 'https://fs.rattleomv.net/site/php/test/geolocation_api.php?lng='+lng+'&lat='+lat,
              type: 'GET',
              dataType: "text",
              json: "callback",
              success: function callback(data){
                  data_container.innerHTML=data;
                  console.log(position);
              }
          });
      }

  </script>
</head>
<body>
  <p>
    <span id="location"></span>
  </p>
</body>
</html>
<?php

    //Send request and receive json data by latitude and longitude
    $url='https://maps.googleapis.com/maps/api/geocode/json?latlng=50.0841829,8.4432295&key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc';
    $json=file_get_contents($url);
    $data=json_decode($json);
    $status=$data->status;
    if($status=="OK"){
      //Get address from json data
      $location=$data->results[0]->formatted_address;
    }else{
      $location='';
    }
    //Print address
    echo $location;

echo "<pre>"; var_dump($_POST); echo "</pre>";
?>