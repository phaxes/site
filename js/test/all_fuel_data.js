$.ajax({
    url: "https://creativecommons.tankerkoenig.de/json/list.php",
    data: {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
        rad: 2,
        type: "all",
        apikey: "eb4608a6-89bb-5993-6ec6-029781875f90"
    },
    success: function(response) {
        if (!response.ok) {
            // TODO: Fehlerbehandlung
            console.error(response.message);
        } else {
            // TODO: Anzeige der Informationen
            console.log(response);
        }
    },
    error: function(p){
        that.showError('AJAX-Problem', 'status: ' + p.status + ' statusText: ' + p.statusText);
    }
});