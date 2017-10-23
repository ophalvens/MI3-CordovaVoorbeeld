<?php
    $servername = "xxxxxxxxxxxxx"; // vervang dit door de servernaam die je van je hosting firma hebt ontvangen
    $username   = "xxxxxxxxxxxxx"; // vervang dit door de gebruikersnaam die je van je hosting firma hebt ontvangen
    $password   = "xxxxxxxxxxxxx"; // vervang dit door het paswoord dat je van je hosting firma hebt ontvangen
    $dbname     = "xxxxxxxxxxxxx"; // vervang dit door de naam van de databank die je van je hosting firma hebt ontvangen
    
    // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname) or die('{"error":"Connection failed","status":"fail"}');   
?>