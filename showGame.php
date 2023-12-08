<?php
//----------------------------------------------------------------------Aktuelles Spiel anzeigen--------------------------------------------------------------------
$sql_latest_game = "SELECT * FROM spiel ORDER BY spielnummer DESC LIMIT 1";
$result_latest_game = mysqli_query($conn, $sql_latest_game);

if ($result_latest_game) {
    $row_latest_game = mysqli_fetch_assoc($result_latest_game);
    $latest_game_id = $row_latest_game['spielnummer'];
    $heimteam_id = $row_latest_game['heimmannschaftsid'];
    $auswaertsteam_id = $row_latest_game['auswaertsmannschaftsid'];

    // Holen Sie die Namen der Heim- und Auswärtsteams
    $sql_heimteam = "SELECT mannschaftsname FROM mannschaften WHERE mannschaftsid = $heimteam_id";
    $result_heimteam = mysqli_query($conn, $sql_heimteam);

    $sql_auswaertsteam = "SELECT mannschaftsname FROM mannschaften WHERE mannschaftsid = $auswaertsteam_id";
    $result_auswaertsteam = mysqli_query($conn, $sql_auswaertsteam);

    // Überprüfe, ob die Abfragen erfolgreich waren
    if ($result_heimteam && $result_auswaertsteam) {
        $row_heimteam = mysqli_fetch_assoc($result_heimteam);
        $row_auswaertsteam = mysqli_fetch_assoc($result_auswaertsteam);

        $heimteam_name = $row_heimteam['mannschaftsname'];
        $auswaertsteam_name = $row_auswaertsteam['mannschaftsname'];
    } else {
        echo "Fehler beim Abrufen der Mannschaftsnamen: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Fehler beim Abrufen des neuesten Spiels: " . mysqli_error($conn);
    exit();
}
?>
