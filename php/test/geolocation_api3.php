<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Ajax Beispiel 003</title>
  <script type="text/javascript">

      var request = false;
      // Request senden
      function setRequest(id) {
          // Request erzeugen
          if (window.XMLHttpRequest) {
              request = new XMLHttpRequest(); // Mozilla, Safari, Opera
          } else if (window.ActiveXObject) {
              try {
                  request = new ActiveXObject('Msxml2.XMLHTTP'); // IE 5
              } catch (e) {
                  try {
                      request = new ActiveXObject('Microsoft.XMLHTTP'); // IE 6
                  } catch (e) {}
              }
          }
          // überprüfen, ob Request erzeugt wurde
          if (!request) {
              alert("Kann keine XMLHTTP-Instanz erzeugen");
              return false;
          } else {
              var url = "https://fs.rattleomv.net/site/php/test/geolocation_api3.php";
              // Name auslesen
              var value = document.getElementById('source_'+id).innerHTML;
              // Request öffnen
              request.open('post', url, true);
              // Requestheader senden
              request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              // Request senden
              request.send('name='+value+'&pos='+id);
              // Request auswerten
              request.onreadystatechange = interpretRequest;
          }
      }
      // Request auswerten
      function interpretRequest() {
          switch (request.readyState) {
              // wenn der readyState 4 und der request.status 200 ist, dann ist alles korrekt gelaufen
              case 4:
                  if (request.status != 200) {
                      alert("Der Request wurde abgeschlossen, ist aber nicht OK\nFehler:"+request.status);
                  } else {
                      var content = request.responseText;
                      // den Inhalt des Requests in das <div> schreiben
                      document.getElementById('content').innerHTML = content;
                      console.log(content);
                  }
                  break;
              default:
                  break;
          }
      }

  </script>
</head>
<body>
<ul>
  <li><a id="source_01" href="javascript:setRequest('01')">Max</a></li>
  <li><a id="source_02" href="javascript:setRequest('02')">Susi</a></li>
  <li><a id="source_03" href="javascript:setRequest('03')">Charly</a></li>
</ul>
<br />
<div id="content"></div>
</body>
</html>