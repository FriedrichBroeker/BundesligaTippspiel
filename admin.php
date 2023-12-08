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
     
?>




<!DOCTYPE html>
<html>
<head>
    <title>Spiel eintragen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@700&family=Fjalla+One&family=Josefin+Sans:wght@700&family=Kanit:wght@700&family=Kdam+Thmor+Pro&family=Roboto:ital,wght@1,900&family=Rubik:wght@500&family=Vina+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Spiel eintragen</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="heimteam">Heimteam ID:</label>
    <input type="text" name="heimteam" required>

    <label for="auswaertsteam">Auswärtsteam ID:</label>
    <input type="text" name="auswaertsteam" required>

    <input type="submit" value="Spiel eintragen">
</form>

</body>
</html>

<?php
     // Beende die Pufferung und sende den Pufferinhalt an den Browser
     ob_end_flush();
     // Beende das Skript hier und verhindere weitere Ausführung
     exit();

?>