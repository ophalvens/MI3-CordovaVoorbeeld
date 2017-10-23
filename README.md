# MI3-CordovaVoorbeeld
### Voorbeeld voor Cordova - MI3

Branch **stap-5-DATA** is het voorbeeld van **les 5**.

Download of fork deze branch om te starten.
### Je project zelf aanmaken
Ga naar een map waar je projecten kan aanmaken en maak daar je Cordova project aan :
```
cordova create -d MI3-CordovaVoorbeeld be.odisee.jouwfamilienaam.hokuspokus HokusPokus
```
De parameters in dit voorbeeld waren :
* **MI3-CordovaVoorbeeld** : de naam van de map voor het project
* **be.odisee.jouwfamilienaam.hokuspokus** :  de unieke referentienaam voor je project. Bij voorkeur een reverse-domein notatie met op het einde de naam van je project
* **HokusPokus** : de naam waarmee je app te herkennen is wanneer die op een toestel geïnstalleerd is.

Ga in de net aangemaakte map (*MI3-CordovaVoorbeeld* in dit voorbeeld):
```
cd MI3-CordovaVoorbeeld
```
Voeg een platform (*Android* in dit voorbeeld) toe aan je project:
```
cordova platform add android
```
Voeg een plugin toe (*cordova-plugin-geolocation* in dit voorbeeld) :
```
cordova plugin add cordova-plugin-geolocation
```
Je project builden en laten starten in de *android* emulator :
```
cordova emulate android
```
Enkele caveats :
* Test eerst of je emulator wel kan opstarten
* Op sommige versies van je emulator moet je
  * in het virtuele toestel de developers options unlocken
  * USB debugging aanzetten (SETTINGS > DEVELOPER OPTIONS)
  * toestemming geven aan je computer wanneer je virtuele toestel een melding geeft ivm het toestaan van adb toegang naar jouw computer
  
Je project builden en laten starten op een met de kabel verbonden android toestel :
```
cordova run android
```  
Enkele caveats :
* Test eerst of je jouw toestel wel ziet via het commando `adb devices -l`
* Zet USB debugging aan op jouw gsm (of tablet)
* Geef toestemming aan jouw PC/Laptop wanneer daar om gevraagd wordt

Als je dit voorbeeld in jouw project wil laten werken, moet je enkel de inhoud van de `/www` map plaatsen in de map met dezelfde naam op jouw computer.


  
### Structuur project
* **`/www/`** 
  * de code van je Cordova project 
* **`/php/`** 
  * 2 php bestanden die je eigen online webserver moet plaatsen
  * 2 sql dumps die je in PHPMyAdmin kan importeren om de tabellen van het voorbeeld aan te maken
  
De overige mappen zijn aangemaakt toen je jouw project aanmaakte met `cordova create`


### Geen php bestanden in je Cordova app
Een php pagina wordt enkel verwerkt als die vanop een webserver met php wordt bevraagd.
Hoewel er in het voorbeeld 2 php bestanden in de map `/php` zitten, maken deze bestanden geen deel
uit van je Cordova project.

### Je eigen server
Hoewel je met het voorbeeld van de les kan werken, wil je waarschijnlijk met je eigen code 
experimenteren voor jouw project.

* Zoek een eigen php/mysql server.
* Plaats een aangepaste versie van `/php/testdb.php` en `/php/dbcon.php` op jouw server. Let daarbij vooral op de aangepaste connectiegegevens in het bestand `/php/dbcon.php`.
* Voeg de tabellen _categorieen_ en _producten_ toe aan je online databank. In PHPMyAdmin kan je sql bestanden importeren.
* Pas het bestand my-app.js aan, zodat de ajax requests verwijzen naar het bestand `testdb.php` op **jouw** server.

### Meer beveiliging
Het bestand `/php/testdb.php` is wat langer en meer complex geworden dan de versie in de les. Hoewel het bestand nu iets meer complex is om te begrijpen, is deze versie wel iets beter bestand tegen o.a. sqlinjection.

De aanpassingen zouden voldoende gedocumenteerd moeten zijn. Als de aanpassingen niet duidelijk zijn, laat dan gerust iets weten.