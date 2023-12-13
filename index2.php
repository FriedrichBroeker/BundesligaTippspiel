<?php
    include("connection.php");
    include("login.php")
    ?>
    
<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@700&family=Fjalla+One&family=Josefin+Sans:wght@700&family=Kanit:wght@700&family=Kdam+Thmor+Pro&family=Roboto:ital,wght@1,900&family=Rubik:wght@500&family=Vina+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css" id="theme-link">
    </head>
    <body>
        
        <a href="index.php">
            <img src="logo.png" alt="Bundesliga Logo" class="bundesliga-logo" id="small-logo">
        </a>

        <div id="logo-container" style="display:none">
        <img src="logo.png" alt="Logo">
        </div>
        <button id="theme-toggle">Toggle Dark Mode</button>

        <div id="form">
     
            <h1>Tippspiel - Anmeldung</h1>
            <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
                <label>Username: </label>
                <input type="text" id="user" name="user"></br></br>
                <label>Passwort: </label>
                <input type="password" id="pass" name="pass"></br></br>
                <input type="submit" id="btn" value="Login" name = "submit"/>
            </form>
            <p>Noch kein Benutzer? <a href="register.php">Jetzt registrieren</a></p>
        </div>
        <script>
            function isvalid(){
                var user = document.form.user.value;
                var pass = document.form.pass.value;
                if(user.length=="" && pass.length==""){
                    alert("Benutzername und Passwortfeld muss ausgefüllt werden!!!");
                    return false;
                }
                else if(user.length==""){
                    alert("Benutzername-Feld musss ausgefüllt sein!!!");
                    return false;
                }
                else if(pass.length==""){
                    alert("Passwort-Feld muss ausgefüllt sein!!!");
                    return false;
                }
                
            }
        </script>
        <script src="script.js"></script>
        <script src="theme-toggle.js"></script>

    </body>
</html>

?>