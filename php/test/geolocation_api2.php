<html>
<body>
<button onclick="getLocation()">Try to get it</button>
<p id="demo">GPS Location:</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    var x = document.getElementById("demo");
    var data_container=document.createElement("div");
    data_container.setAttribute("id","geolocation");
    document.getElementById("demo").appendChild(data_container);

    function getLocation() {
      if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
      }else{
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;

        $.post("https://fs.rattleomv.net/site/php/test/geolocation_api2.php", {
          latitude: position.coords.latitude,
          longitude: position.coords.longitude
        },

        function (position) {
          data_container.innerHTML=position;
          console.log(position);
        });
    }
</script>

<?php
$latitude = $longitude = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $latitude=input_test($_POST["latitude"]);
  $longitude=input_test($_POST["longitude"]);
  echo "<pre>"; echo "hier"; echo "</pre>";
}
function input_test($daten){
  $daten=trim($daten);
  $daten=stripslashes($daten);
  $daten=htmlspecialchars($daten);
  echo "<pre>"; echo "nein hier"; echo "</pre>";
  return $daten;
}
echo "<pre>"; print_r($latitude); echo "</pre>";
echo "<pre>"; print_r($longitude); echo "</pre>";
echo "<pre>"; print_r($_SERVER); echo "</pre>";
echo "<pre>"; print_r($_POST); echo "</pre>";
echo "<pre>"; print_r($_GET); echo "</pre>";
?>
<br>
</body>
</html>

