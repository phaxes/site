<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Ajax Beispiel 004</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>

$("button").click(function(event) {
  $.ajax({
    url : 'https://fs.rattleomv.net/site/php/test/geolocation_api4.php',
    type : 'post',
    data : {
      "key-eins": value-1,
      "key-zwei": value-2,
    }
  }).done(function (feedback) {//in feedback ist die HTML ausgabe des Scripts

  console.log(feedback);

  // Bei Erfolg
  alert("Erfolgreich:" + feedback);
  }).fail(function() {

  // Bei Fehler
  alert("Fehler!");
  }).always(function() {

  // Immer
  alert("Beendet!");
  });

});

</script>

</head>
<body>
<button>Button</button>
</body>
</html>

<?php echo 'variable eins ist: '.$_POST['key-eins']; ?>


