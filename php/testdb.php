<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

require "dbcon.php";

// de vars ophalen die via POST meegestuurd zijn
// $_POST werkt niet als de data via Volley gestuurd is :-(
// Dit is nodig wanneer je native Android gebruikt.

$body = file_get_contents('php://input');
$postvars = json_decode($body, true);
$id = $postvars["id"];
$table = $postvars["table"];
$bewerking = $postvars["bewerking"];

// de volgende lijnen zijn zodat we ook vanuit gewone
// ajax requests met POST kunnen werken.
//if($id == null || $id == ''){
    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }
//}
//if($table == null || $itable == ''){
    if(isset($_POST['table'])){
        $table = $_POST['table'];
    }
//}
//if($bewerking == null || $bewerking == ''){
    if(isset($_POST['bewerking'])){
        $bewerking = $_POST['bewerking'];
    }
//}


// De volgende tests dienen enkel om de php
// pagina te testen in de browser door er GET variabelen aan
// mee te geven. 
// Als alternatief kan je werken met een POST formulier dat
// deze pagina aanspreekt.
// Haal deze weg in productie omgevingen.

/*
if(!isset($postvars["id"])){
    $id = $_GET['id'];
}
if(!isset($postvars["table"])){
    $table = $_GET['table'];
}
if(!isset($postvars["bewerking"])){
    $bewerking = $_GET['bewerking'];
}
*/



if (isset($id) || isset($table) || isset($bewerking)) {
    //echo json_encode($_POST['id']);
} else {
    if (!empty($postvars)) {

    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           // die('{"POSTed":' . json_encode($_POST) . ',"postvars":'. json_encode($postvars) .'}');
        } else {
            die('{"error":"Geen POST"}');
        }

    }

}

/*if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = null;
}*/

if (isset($bewerking) && isset($table)) {
    $t = $table;
    if($t != 'producten' && $t != 'categorieen'){
        die('{"error":"forbidden table"}');
    }
} else {
    die('{"error":"missing data","table":"'. $table. '", "bewerking":"' . $bewerking . '"}');
}


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die(json_encode("Connection failed: " . mysqli_connect_error()));
} else {
    if ($bewerking == "get") {
        // vraag de data op
        $result = $conn -> query($id == null ? "SELECT * FROM $t" : "SELECT * FROM $t where PR_ID = $id");

        // maak van de inhoud van deze result een json object waarvan
        // ook in android de juiste gegeventypes herkend worden
        $return = getJsonObjFromResult($result);

        // maak geheugenresources vrij :
        mysqli_free_result($result);

        die($return);

    } elseif ($bewerking == "delete") {
        // verwijder data
        if ($conn -> query("delete FROM producten where PR_ID = $id") === TRUE) { // FROM $t
            die(json_encode("Record deleted successfully"));
        } else {
            die(json_encode("Error deleting record: " . $conn -> error));
        }
        //echo "$id zou moeten verwijderd zijn uit $t";
        
    } elseif ($bewerking == "add") {
        if (isset($_POST['PR_naam']) && isset($_POST['PR_CT_ID'])
        && isset($_POST['prijs'])) {
            // hier MOET je controle plaatsen om o.a. SQL injection 
            // te voorkomen.
            $PR_naam = $_POST['PR_naam'];
            $PR_CT_ID = $_POST['PR_CT_ID'];
            $prijs = $_POST['prijs'];
        } else {
            die(json_encode("missing data"));
        }

        // product toevoegen

       
        if ($conn -> query("insert into producten (PR_naam, PR_CT_ID, prijs) values('"
        .$PR_naam."','".$PRCT_ID."','".$prijs."')") === TRUE) { // into $t
            die(json_encode("Record added successfully"));
        } else {
            die(json_encode("Error adding record: " . $conn -> error));
        }
    } else {
        die(json_encode("Oops, hier zou ik normaal niet mogen komen..."));
    }

}

function getJsonObjFromResult(&$result){
    // de & voor de parameter zorgt er voor dat we de de parameter
    // by reference doorgeven, waardoor deze niet gekopieerd word
    // naar een nieuwe variabele voor deze functie.

    $fixed = array();
    
    $typeArray = array(
                    MYSQLI_TYPE_TINY, MYSQLI_TYPE_SHORT, MYSQLI_TYPE_INT24,    
                    MYSQLI_TYPE_LONG, MYSQLI_TYPE_LONGLONG,
                    MYSQLI_TYPE_DECIMAL, 
                    MYSQLI_TYPE_FLOAT, MYSQLI_TYPE_DOUBLE );
    $fieldList = array();
    // haal de veldinformatie van de velden in deze resultset op
    while($info = $result->fetch_field()){
        $fieldList[] = $info;
    }
    // haal de data uit de result en pas deze aan als het veld een
    // getaltype zou moeten bevatten
    while ($row = $result -> fetch_assoc()) {
        $fixedRow = array();
        $teller = 0;

        foreach ($row as $key => $value) {
            if (in_array($fieldList[$teller] -> type, $typeArray )) {
                $fixedRow[$key] = 0 + $value;
            } else {
                $fixedRow[$key] = $value;
            }
            $teller++;
        }
        $fixed[] = $fixedRow;
    }

    // geef een json object terug
    return '{"data":'.json_encode($fixed).'}';
}
?>