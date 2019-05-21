geoFindMe();

function geoFindMe(){

    if(!navigator.geolocation){
        alert("Geolocation wird von ihrem Browser nicht unterstützt");
    }

    function success(position){
        setTimeout(function(){window.location.replace("https://fs.rattleomv.net/site/php/scripts/stations_user_accept.php")},500);

        function interpretRequest(){
            var content=request.responseText;
            console.log(position);
            console.log(content);
        }
    }

    function error(error) {
        console.log(error.code);
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("Gelocation konnte nicht bestimmt werden.")
                document.getElementById("card_deck_start").innerHTML="Sie werden weitergeleitet... . Standort verwenden: erneut www.oikoshome.de aufrufen.";
                setTimeout(function(){window.location.replace("https://fs.rattleomv.net/site/php/scripts/stations_user_denied.php")},3000);
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById("card_deck_start").innerHTML="Standortdaten sind nicht verfügbar.";
                break;
            case error.TIMEOUT:
                document.getElementById("card_deck_start").innerHTML="Die Standortabfrage dauerte zu lange (Time-out).";
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById("card_deck_start").innerHTML="unbekannter Fehler.";
                break;
        }
    }
    navigator.geolocation.getCurrentPosition(success,error);
}

