<?php
   // Starte die Pufferung
ob_start();

// Starte die Session, um auf Benutzerdaten zuzugreifen
session_start();

// Überprüfe, ob der Benutzer angemeldet ist
if (!isset($_SESSION['username'])) {
    // Falls nicht, leite auf die Login-Seite weiter
    header('Location: index.php');
    ob_end_flush(); // Beende die Pufferung und sende den Pufferinhalt an den Browser
    exit(); // Beende das Skript hier und verhindere weitere Ausführung
}

include('connection.php');
//Eintragen eines neuen Spiels
// Überprüfe, ob das Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $heimteam_id = $_POST['heimteam'];
    $auswaertsteam_id = $_POST['auswaertsteam'];
    
    // Überprüfe, ob das vorherige Spiel "gespielt" ist
    $sql_last_game_status = "SELECT spielStatus FROM spiel ORDER BY spielnummer DESC LIMIT 1";
    $result_last_game_status = mysqli_query($conn, $sql_last_game_status);

    if ($result_last_game_status) {
        $row_last_game_status = mysqli_fetch_assoc($result_last_game_status);
        $last_game_status = $row_last_game_status['spielStatus'];

        if ($last_game_status != "gespielt") {
            $errorMsg = "Erst Ergebnis eintragen";
        }
        if($heimteam_id == $auswaertsteam_id){
            $errorMsg = "Unterschiedliche Teams eintragen!";
        }
        else {
            // Hier kannst du die Spielinformationen in die Datenbank eintragen
            $sql_insert_spiel = "INSERT INTO spiel (heimmannschaftsid, auswaertsmannschaftsid) VALUES ('$heimteam_id', '$auswaertsteam_id')";

            if (mysqli_query($conn, $sql_insert_spiel)) {
                $confirmationMessage = "Spiel erfolgreich eingetragen";

                // Holen Sie die Namen der Heim- und Auswärtsteams für die Anzeige
                $sql_heimteam_name = "SELECT mannschaftsname FROM mannschaften WHERE mannschaftsid = $heimteam_id";
                $result_heimteam_name = mysqli_query($conn, $sql_heimteam_name);

                $sql_auswaertsteam_name = "SELECT mannschaftsname FROM mannschaften WHERE mannschaftsid = $auswaertsteam_id";
                $result_auswaertsteam_name = mysqli_query($conn, $sql_auswaertsteam_name);

                if ($result_heimteam_name && $result_auswaertsteam_name) {
                    $row_heimteam_name = mysqli_fetch_assoc($result_heimteam_name);
                    $row_auswaertsteam_name = mysqli_fetch_assoc($result_auswaertsteam_name);

                    $heimteam_name = $row_heimteam_name['mannschaftsname'];
                    $auswaertsteam_name = $row_auswaertsteam_name['mannschaftsname'];
                } else {
                    echo "Fehler beim Abrufen der Mannschaftsnamen: " . mysqli_error($conn);
                    exit();
                }
            } else {
                $errorMsg = "Fehler beim Eintragen des Spiels: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Fehler beim Abrufen des Spielstatus des letzten Spiels: " . mysqli_error($conn);
        exit();
    }
    
}
 
include("showGame.php"); 



//Eintragen der Ergebnisse 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitErgebnisse'])) {
    // Hole die Werte aus den Formulareingaben
    $ToreHeimteam = $_POST['ergebnis_heimteam'];
    $ToreAuswaertsteam = $_POST['ergebnis_auswaertsteam'];

    // Überprüfe, ob das vorherige Spiel "gespielt" ist
    $sql_last_game_status = "SELECT spielnummer, spielStatus FROM spiel ORDER BY spielnummer DESC LIMIT 1";
    $result_last_game_status = mysqli_query($conn, $sql_last_game_status);

    if ($result_last_game_status) {
        $row_last_game_status = mysqli_fetch_assoc($result_last_game_status);
        $last_game_status = $row_last_game_status['spielStatus'];
        $latest_game_id = $row_last_game_status['spielnummer'];

        if ($last_game_status == "gespielt") {
            echo "Bitte nächstes Spiel eintragen!";
            
        } else {
            //Spielinformationen der Datenbank aktualisieren
            $sql_update_spiel = "UPDATE spiel SET toreHeim = '$ToreHeimteam', toreAuswaerts = '$ToreAuswaertsteam', spielStatus = 'gespielt' WHERE spielnummer = '$latest_game_id' AND spielStatus = 'nicht gespielt'";

            if (mysqli_query($conn, $sql_update_spiel)) {
                $confirmationMessage = "Ergebnis erfolgreich eingetragen";


                // Berechne die Punkte für jeden Benutzer
                $sql_get_user_tips = "SELECT tipp.id, tipp.getippte_tore_heimteam, tipp.getippte_tore_auswaertsteam FROM tipp INNER JOIN login ON tipp.id = login.id";
                $result_user_tips = mysqli_query($conn, $sql_get_user_tips);

                while ($row_user_tips = mysqli_fetch_assoc($result_user_tips)) {
                    $getippteToreHeim = $row_user_tips['getippte_tore_heimteam'];
                    $getippteToreAuswaerts = $row_user_tips['getippte_tore_auswaertsteam'];
                    $id = $row_user_tips['id'];

                    // Berechne Punkte
                    $punkte = 0;
                    if ($ToreHeimteam == $getippteToreHeim && $ToreAuswaertsteam == $getippteToreAuswaerts) {
                        $punkte = 4;
                    } elseif (($ToreHeimteam - $ToreAuswaertsteam) == ($getippteToreHeim - $getippteToreAuswaerts)) {
                        $punkte = 2;
                    }

                    // Aktualisiere die Punkte in der Tabelle login
                    $sql_update_points = "UPDATE login SET punktzahl = punktzahl + $punkte WHERE id = '$id'";
                   mysqli_query($conn, $sql_update_points);       
                }
            } else {
                $errorMsg = "Fehler beim Eintragen des Ergebnisses: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Fehler beim Abrufen des Spielstatus des letzten Spiels: " . mysqli_error($conn);
        exit();
    }
}


?>



<!DOCTYPE html>
<html>
<head>
    <title>Spiel eintragen</title>
</head>
<body>

<h2>Spiel eintragen</h2>


<?php
    if (isset($confirmationMessage)) {
        echo $confirmationMessage;
    }

    if (isset($errorMsg)) {
        echo $errorMsg;
    }
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="heimteam">Heimteam:</label>
    <select name="heimteam" required>
        <?php
        // Abfrage für alle Mannschaften aus der Datenbank
        $query_mannschaften = "SELECT * FROM mannschaften";
        $result_mannschaften = mysqli_query($conn, $query_mannschaften);

        // Überprüfe, ob die Abfrage erfolgreich war
        if ($result_mannschaften) {
            // Fülle das Dropdown-Menü mit den Mannschaftsnamen
            while ($row_mannschaft = mysqli_fetch_assoc($result_mannschaften)) {
                echo "<option value='" . $row_mannschaft['mannschaftsid'] . "'>" . $row_mannschaft['mannschaftsname'] . "</option>";
            }
        } else {
            echo "Fehler beim Abrufen der Mannschaften: " . mysqli_error($conn);
        }
        ?>
    </select>

    <label for="auswaertsteam">Auswärtsteam:</label>
    <select name="auswaertsteam" required>
        <?php
        // Wiederhole den gleichen Prozess für das Auswärtsteam
        if ($result_mannschaften) {
            mysqli_data_seek($result_mannschaften, 0); // Setze den Zeiger zurück
            while ($row_mannschaft = mysqli_fetch_assoc($result_mannschaften)) {
                echo "<option value='" . $row_mannschaft['mannschaftsid'] . "'>" . $row_mannschaft['mannschaftsname'] . "</option>";
            }
        }
        ?>
    </select>

    <input type="submit" name="submit" value="Spiel eintragen">
    
    <br> <br>

    <label for="ergebnis_heimteam">Tore: <?php echo $heimteam_name?></label>
    <input type="number" name="ergebnis_heimteam" min="0" max="12">

    <label for="ergebnis_auswaertsteam">Tore: <?php echo $auswaertsteam_name?></label>
    <input type="number" name="ergebnis_auswaertsteam" min="0" max="12">

    <input type="submit" name="submitErgebnisse" value="Ergebnis eintragen">





</form>
</body>
</html>
<?php
     // Beende die Pufferung und sende den Pufferinhalt an den Browser
     ob_end_flush();
     // Beende das Skript hier und verhindere weitere Ausführung
     exit();

?>