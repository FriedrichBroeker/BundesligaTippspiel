<?php
include('connection.php');

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $password_confirm = mysqli_real_escape_string($conn, $_POST['pass_confirm']);

    $username = strtolower($username);

    if ($password != $password_confirm) {
        echo '<script>
                  alert("Die Passwörter stimmen nicht überein. Bitte versuche es noch einmal.");
                  window.location.href = "register.php";
              </script>';
    } else {

    // Überprüfen, ob der Benutzername bereits existiert
    $sql = "select * from login where username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<script>
                  alert("Benutzername bereits vergeben. Bitte wählen Sie einen anderen.");
                  window.location.href = "register.php";
              </script>';
    } else {
        // Benutzer in die Datenbank eintragen
        $sql = "insert into login (username, password) values ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo '<script>
                      alert("Registrierung erfolgreich. Sie können sich jetzt anmelden.");
                      window.location.href = "index.php";
                  </script>';
        } else {
            echo '<script>
                      alert("Fehler bei der Registrierung.");
                      window.location.href = "register.php";
                  </script>';
        }
    }
    
    }
}
?>
