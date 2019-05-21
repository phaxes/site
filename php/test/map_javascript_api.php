<div id="wrapper">
  <div id="map_canvas"></div>

  <!-- STARTING MAP DEFINITION -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc"></script>
  <script type="text/javascript">
      var rendererOptions = {
          draggable: true
      };
      var map;
      var start = new google.maps.LatLng(0.0, 0.0);
      var geocoder;
      geocoder = new google.maps.Geocoder();

      // Initalize your map
      function initialize() {
          var myOptions = {
              zoom:zoom,
              mapTypeId: google.maps.MapTypeId.TERRAIN,
              center: start
          };
          map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      }

      // Collect entered data and open Google Maps in a new browser tab
      function showRoute() {
          var start = document.getElementById("address").value;
          var dest_url = "http://maps.google.de/maps?saddr="+start+"&daddr="+destination;
          window.open(dest_url, '_blank');
      }
  </script>

  <script>
      // Define infobox widget
      function codeAddress() {
          var address = destination;
          geocoder.geocode( { 'address': address }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  map.setCenter(results[0].geometry.location);
                  var coordInfoWindow = new google.maps.InfoWindow({
                      content: "" +
                          "<h2>Route planning</h2>" +
                          "<p>Enter your address<br>and press the Start button</p>" +
                          "<input id='address' type='textbox' value='' style='border: 1px solid #f0f0f0;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'> " +
                          "<input type='button' value='Start' onClick='showRoute();'>",
                      map: map,
                      position: results[0].geometry.location
                  });
              } else {
                  alert("Geocode not available: " + status);
              }
          });
      }

      // Automatic geo localisation
      function codeLatLng() {
          if(navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = new google.maps.LatLng(position.coords.latitude,
                      position.coords.longitude);

                  geocoder.geocode({'latLng': pos}, function(results, status) {

                      if (status == google.maps.GeocoderStatus.OK) {
                          if (results[1]) {
                              document.getElementById("address").value = results[1].formatted_address;
                          } else {
                              // alert("No results found");
                          }
                      } else {
                          // alert("Geocoder failed due to: " + status);
                      }
                  });

              }, function() {
                  //
              });
          }
      }

  </script>

  <script>
      // DO NOT CHANGE CODE ABOVE!

      // Change custom parameters starting from here:
      var zoom = 13; // map zoom
      var destination = "Alexanderplatz 7, Berlin"; // destination, your address
      document.getElementById('map_canvas').style.width = '400px'; // map width
      document.getElementById('map_canvas').style.height = '400px'; // map height
      initialize();
      codeAddress();
      codeLatLng();
  </script>
  <!-- END OF MAP DEFINITION -->

</div>

<!--<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc'></script>
<div
  style='overflow:hidden;
  height:400px;width:520px;'>
  <div id='gmap_canvas'
       style='height:400px;
       width:520px;'></div>
  <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
</div>
<a href='https://www.eigenheimversicherungen.at/'>https://www.EigenheimVersicherungen.at</a>
<script type='text/javascript'
        src='https://embedmaps.com/google-maps-authorization/script.js?id=3d0d89d8fce414fafec01ef7429dff81fb44dd1a'>

</script>
<script type='text/javascript'>
    function init_map(){
        var myOptions = {zoom:12,center:new google.maps.LatLng(49.3611264,7.670809899999995),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
        marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(49.3611264,7.670809899999995)});
        infowindow = new google.maps.InfoWindow({content:'' +
                '<strong>Test</strong>' +
                '<br>Bergstraße' +
                '<br>67706 Krickenbach' +
                '<br>'});
        google.maps.event.addListener(marker, 'click', function(){
            infowindow.open(map,marker);});
        infowindow.open(map,marker);
    }
    google.maps.event.addDomListener(window, 'load', init_map);
</script>

<iframe width="600" height="450" frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/directions?origin=place_id:ChIJiXbATNNzlkcRposTZJ8W6_o&destination=place_id:EjdCYXJiYXJvc3Nhc3RyYcOfZSAzNSwgNjc2NTUgS2Fpc2Vyc2xhdXRlcm4sIERldXRzY2hsYW5kIjASLgoUChIJFahYbs8SlkcRHqxtNZuMK1UQIyoUChIJ50rh9s8SlkcR01bTu-Eme8c&key=..." allowfullscreen></iframe>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <style type="text/css">
    html { height: 100% }
    body { height: 90%; margin: 0; padding: 0 }
    #map-canvas { height: 100% }
  </style>
  <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&sensor=false">
  </script>
  <script type="text/javascript">
      function initialize() {
          var mapOptions = {
              center: new google.maps.LatLng(-34.397, 150.644),
              zoom: 8,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("map-canvas"),
              mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</head>
<body>
<div id="map-canvas"/>
</body>
</html>-->




