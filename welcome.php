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

   
    

   // Hole den Benutzernamen aus der Session
    $LoggedInUser = $_SESSION['username'];

    // Container, der Bild und Willkommensnachricht umfasst
    echo "<div class='header-container'>";

    // Fügen Sie hier das Bild ein
    echo "<img src='logo.png' alt='Bundesliga Logo' class='bundesliga-logo' style='vertical-align: middle;'>";

    // Willkommensnachricht
    echo "<h1 style='display: inline; margin-left: 20px;'>Willkommen, $LoggedInUser!</h1>";

    echo "</div>";


    include("connection.php");

//Anzeigen des Letzten Spiels
   include("showGame.php");

//Anzeigen des Punktestands
    $query = "SELECT username, punktzahl FROM login ORDER BY punktzahl DESC LIMIT 6";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<h4>Top 5 Punktestand:</h4>";
        echo "<table border='3' id='table-container'>";
        echo "<tr><th>Name</th><th>Punkte</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['username'] != "admin") {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['punktzahl'] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }




//---------------------------------------------------------------------------------------Eintragen des Tipps---------------------------------------------------------------------------
include("connection.php");
// Überprüfe, ob das Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Hole die getippten Tore für Heim- und Auswärtsteam aus dem Formular
    $getippteToreHeimteam = $_POST['getippte_tore_heimteam'];
    $getippteToreAuswaertsteam = $_POST['getippte_tore_auswaertsteam'];
    $loggedInUser = $_POST['loggedInUser'];
    $spielid = $_POST['spielid'];

    //überprüfe ob das Spiel schon gespielt ist
    $sql_last_game_status = "SELECT spielStatus FROM spiel ORDER BY spielnummer DESC LIMIT 1";
    $result_last_game_status = mysqli_query($conn, $sql_last_game_status);

    if ($result_last_game_status) {
        $row_last_game_status = mysqli_fetch_assoc($result_last_game_status);
        $last_game_status = $row_last_game_status['spielStatus'];

        if ($last_game_status == "gespielt") {
            echo "Spiel wurde Bereits gespielt!";  
                   
        } 
    else{


    // Finde die Benutzer-ID anhand des Benutzernamens
    $sql_get_user_id = "SELECT id FROM login WHERE username = '$loggedInUser'";
    $result_get_user_id = mysqli_query($conn, $sql_get_user_id);

    if ($result_get_user_id && $row_get_user_id = mysqli_fetch_assoc($result_get_user_id)) {
        $userId = $row_get_user_id['id'];

        // Überprüfe, ob der Benutzer bereits für dieses Spiel getippt hat
        $sql_check_tipp = "SELECT * FROM tipp WHERE id = '$userId' AND spielid = '$spielid'";
        $result_check_tipp = mysqli_query($conn, $sql_check_tipp);

        if (mysqli_num_rows($result_check_tipp) > 0) {
            // Der Benutzer hat bereits für dieses Spiel getippt, zeige den vorhandenen Tipp an
            $row_check_tipp = mysqli_fetch_assoc($result_check_tipp);
            echo "<h4>Du hast bereits für dieses Spiel getippt!</h4>";
            echo "<p>Dein aktueller Tipp: $heimteam_name - " . $row_check_tipp['getippte_tore_heimteam'] . ", $auswaertsteam_name - " . $row_check_tipp['getippte_tore_auswaertsteam'] . "</p>";
        } else {
            // Der Benutzer hat noch nicht für dieses Spiel getippt, füge den Tipp hinzu
            $sql_insert_tipp = "INSERT INTO tipp (id, spielid, getippte_tore_heimteam, getippte_tore_auswaertsteam) VALUES ('$userId', '$spielid', '$getippteToreHeimteam', '$getippteToreAuswaertsteam')";
            
            if (mysqli_query($conn, $sql_insert_tipp)) {
                echo "<h3>Tipp erfolgreich eingetragen!</h3>";
            } else {
                echo "Fehler beim Eintragen des Tipps: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Fehler: Benutzer nicht gefunden.";
    }
}
}
}

    ?>
    
    <!DOCTYPE html>
    <html>
    <head>
        <title>Tipp eintragen</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@700&family=Fjalla+One&family=Josefin+Sans:wght@700&family=Kanit:wght@700&family=Kdam+Thmor+Pro&family=Roboto:ital,wght@1,900&family=Rubik:wght@500&family=Vina+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css" id="theme-link">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>
    <body>
    <button id="theme-toggle">Toggle Dark Mode</button>


        
            <h2 id="headline-Tipp">Jetzt tippen</h2>

            <div class="tabelle-box2">
                <p>Top-Spiel am Wochenende:</p>
                <ul>
                    
                    <li>Heimteam: <?php echo $heimteam_name; ?> </li>
                    <li>Auswärtsteam: <?php echo $auswaertsteam_name; ?> </li>
                </ul>
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="loggedInUser" value="<?php echo $LoggedInUser; ?>">
                <input type="hidden" name="spielid" value="<?php echo $latest_game_id; ?>">
                <label for="getippte_tore_heimteam"> <?php echo $heimteam_name?></label>
                <input type="text" name="getippte_tore_heimteam" required>

            <label for="getippte_tore_auswaertsteam"> <?php echo $auswaertsteam_name?></label>
            <input type="text" name="getippte_tore_auswaertsteam" required>

            <input type="submit" name="submit" value="Tipp eintragen">
            </form>

            <footer id="footer">
            <div class="footer-box">
                <span id="footer-nav">Website made by Berkay, Friedrich, Kevin </span>
            </div>
            </footer>

            <script>document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Verhindert die sofortige Weiterleitung
                const newUrl = this.href;

                // Zeigt das Logo an
                document.getElementById('logo-container').style.display = 'flex';

                

                // Verzögert die Weiterleitung
                setTimeout(function() {
                    window.location = newUrl;
                }, 1000); // Dauer der Animation
                    });
                });
            </script>
            <script src="theme-toggle.js"></script>


    </body>
    </html>



<?php
// Beende die Pufferung und sende den Pufferinhalt an den Browser
ob_end_flush();
// Beende das Skript hier und verhindere weitere Ausführung
exit();
?>