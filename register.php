<?php 
include("connection.php");
?>

<html>
    <head>
        <title>Registrierung</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Fügen Sie hier die gleichen Styles wie auf der Login-Seite hinzu -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@700&family=Fjalla+One&family=Josefin+Sans:wght@700&family=Kanit:wght@700&family=Kdam+Thmor+Pro&family=Roboto:ital,wght@1,900&family=Rubik:wght@500&family=Vina+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css" id="theme-link">
    </head>
    <body>

        <!-- Ihr Logo und Überschrift -->
        <a href="index.php">
            <img src="logo.png" alt="Bundesliga Logo" class="bundesliga-logo" id="small-logo">
        </a>
        <button id="theme-toggle">Toggle Dark Mode</button>


        <div id="form">
            <h1>Registrierung für das Tippspiel</h1>
            <form name="registerForm" action="signup.php" method="POST">
            <label>Username: </label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Passwort: </label>
            <input type="password" id="pass" name="pass" required><br><br>
            <label>Passwort bestätigen: </label>
            <input type="password" id="pass_confirm" name="pass_confirm" required><br><br>
            <input type="submit" id="btn" value="Registrieren" name="register"/>
            </form>
            <p>Schon Benutzer? <a href="index2.php">Anmelden</a></p>
        </div>

        <!-- Optional: JavaScript-Validierung -->
        <script>

        </script>
        
        <script src="theme-toggle.js"></script>

    </body>
</html>
