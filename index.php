<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bundesliga Tabelle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@700&family=Fjalla+One&family=Josefin+Sans:wght@700&family=Kanit:wght@700&family=Kdam+Thmor+Pro&family=Roboto:ital,wght@1,900&family=Rubik:wght@500&family=Vina+Sans&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" id="theme-link">
</head>
<body>
        <div id="logo-container" style="display:none">
            <img src="logo.png" alt="Logo">
        </div>
    <!-- Header Section -->
    <header class="d-flex justify-content-between align-items-center p-3">
        <div class="header-left d-flex align-items-center"> <!-- Adjusted for alignment -->
            <img src="logo.png" alt="Bundesliga Logo" class="bundesliga-logo" id="small-logo">
            <h1 class="mb-0" style="margin-left: 15px;">Bundesliga Tabelle</h1>
        </div>
        <div class="header-right"> <!-- Unchanged -->
            <a href="index2.php" class="btn btn-primary mr-2">Tippen</a>
            <button id="theme-toggle" class="btn btn-secondary">Mode</button>
        </div>
    </header>

    <div id="table-container">
        <!-- Table content goes here -->
    </div>
    
    <script src="script.js"></script>
    <script src="theme-toggle.js"></script>
    <script async data-id="8618761453" id="chatling-embed-script" type="text/javascript" src="https://chatling.ai/js/embed.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <footer id="footer">
        <div class="footer-box">
            <span id="footer-nav">Website made by Friedrich, Kevin, Berkay </span>
        </div>
    </footer>
</body>
</html>
