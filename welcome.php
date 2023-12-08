<!DOCTYPE html>
<html>
<head>
    <title>Meine Webseite</title>
    <!-- Verknüpfung zur CSS-Datei -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!-- Ihr PHP-Code geht hier -->

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
    echo "<h1>Willkommen, $LoggedInUser</h1>";

    include("connection.php");
    
    // Abfrage, um alle Benutzer aus der Datenbank abzurufen
    $query = "SELECT * FROM login";
    $result = mysqli_query($conn, $query);

    // Überprüfe, ob die Abfrage erfolgreich war
    if ($result) {
        // Zeige alle Benutzer in einer Tabelle an
        echo "<h2>All Users:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Error fetching users: " . mysqli_error($conn);
    }

    $query = "SELECT * FROM mannschaften";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<h3>Mannschaften:</h3>";
        echo "<table border='3'>";
        echo "<tr><th>ID</th><th>Mannschaft</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['mannschaftsid'] . "</td>";
            echo "<td>" . $row['mannschaftsname'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

    }  
    else {
        echo "Error fetching teams: ". mysqli_error($conn);
    }




    // Schließe die Verbindung zur Datenbank
    mysqli_close($conn);

    // Beende die Pufferung und sende den Pufferinhalt an den Browser
    ob_end_flush();
    // Beende das Skript hier und verhindere weitere Ausführung
    exit();
?>

</body>
</html>
