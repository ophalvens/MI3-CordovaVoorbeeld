"use strict";
/*global navigator, document, Framework7, Dom7 */
// opgelet: app = cordova initialisatie
//          myApp : F7 initialisatie

// ----------- Cordova basis initialisatie ---------------- //
var app = {
    // Application Constructor
    initialize: function() {
        document.addEventListener('deviceready', this.onDeviceReady.bind(this), false);
    },

    // deviceready Event Handler
    //
    // Bind any cordova events here. Common events are:
    // 'pause', 'resume', etc.
    onDeviceReady: function() {
        this.receivedEvent('deviceready');
    },

    // Update DOM on a Received Event
    receivedEvent: function(id) {
        console.log('Received Event: ' + id);
    }
};

app.initialize();

// ----------- Framework7 basis initialisatie ---------------- //
// Initialize your app
var myApp = new Framework7({
    material: true,
    animatePages: false,
    swipeout: false
});

// Export selectors engine
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: false,
    noAnimate: true,
    domCache: true // enable inline pages
});

// Callbacks to run specific code for specific pages, for example for About page:
myApp.onPageInit('locatie', function (page) {
    // run createContentPage func after link was clicked
    $$('#btnLocatie').on('click', function () {
        getLocation();
    });
});


// ---------- uitbreiding voorbeeld les 4 ---------------- //
function getLocation() {
    
    if (navigator.geolocation) {
        var fast = $$("#cbPosAccurate").prop("checked");
        if(app.watchPositionID !== null){
            // de vorige watch eerst stoppen, of we hebben meerdere
            // simultane lopen.
            navigator.geolocation.clearWatch(app.watchPositionID);
            
        }
        
        app.watchPositionID = navigator.geolocation.watchPosition(
            showPosition,
            positionError, 
            { 
                enableHighAccuracy: fast,
                maximumAge: 10 * 1000}
        );
        
    } else {
       myApp.alert('Het spijt me, maar geolocatie wordt niet ondersteund door deze browser.', 'Geen geolocatie ondersteuning');
    }
}
function showPosition(position) {
    app.position = position;
    //updateMap();
    
    switch ($$(".view-main").attr("data-page")) {
        case "locatie": 
            //updateMap();
            var tText = "";
            tText += "latitude: " + position.coords.latitude +"</br>";
            
            let esText = `Latitude: ${position.coords.latitude}<br>Longitude: ${position.coords.longitude}<br>Accuracy: ${position.coords.accuracy}m.<br>Timestamp: ${new Date(position.timestamp)}<br>`;
            
            $$("#locatieResultaat").html(esText);
            break;
        case "index": 
            alert(position); 
            break;
    }
}
function positionError(error) {
    console.log('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from location provider)
    //   3: timed out
    switch(error.code){
        case 0:
            // unknown error
             myApp.alert('Onbekend probleem bij het bepalen van je positie. Zorg er voor dat de positiebepaling van je toestel actief is.', 'Positie probleem');
        case 1:
            // permission denied
            myApp.alert('Het spijt me, maar ik ga je moeten blijven pesten als je geen toestemming geeft om je positie te zien. Als je wilt, kan je de pagina herladen en eventueel de geschiedenis van je browser wissen. Het laatste uur is meer dan voldoende. <b>iPhone</b> : zorg er voor dat je locatie toestemming in het algemeen EN locatie toestemming aan Safari geeft.', 'Positie toelating probleem');
        case 2:
            // position unavailable (error response from location provider)
            myApp.alert('Je positie is niet beschikbaar. Zorg er voor dat de positiebepaling van je toestel actief is.', 'Positie niet beschikbaar');
        case 3:
            // timed out
            myApp.alert('Het duurt te lang om je positie te vinden. Zit je in een tunnel? Of zit je nog in de school? Op een heel aantal toestellen kan de positie sneller bepaald worden als je ook je wifi aanzet.', 'Positie timeout');
    }
    
  };
